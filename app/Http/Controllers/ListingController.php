<?php

namespace App\Http\Controllers;

use SplFileObject;
use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Job;
use App\Models\Listing;
use App\Models\Category;
use App\Models\FailedJob;
use App\Models\ListingTag;
use App\Jobs\ImportDataJob;
use App\Jobs\ImportExcelJob;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use App\Models\ImportJobStatus;
use App\Imports\ListingsImport;
use App\Imports\ExcelImport;
use App\Models\ExportImportLog;
use App\Exports\ListingsExport;
use App\Models\ExportDataGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;


class ListingController extends Controller
{
    protected $_action;

    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            $tags = ListingTag::all();
            $columnGroup = ExportDataGroup::all();
            foreach ($columnGroup as $column) {
                $column->column_names = explode(',', $column->column_names);
            }
            $tableName = 'listings';
            $dropdownColumnNames = Schema::getColumnListing($tableName);
            $ColumnNames = $dropdownColumnNames;
            $dropdownData = GeneralHelper::getDropdowns();
            $listings = Listing::paginate(10);
            return view('backend.listings.index', compact('listings', 'tags', 'dropdownData', 'ColumnNames', 'dropdownColumnNames', 'columnGroup'));
        } else {
            return redirect()->route('dashboard')->with('error', 'User is not authorized for access.');
        };
    }

    public function show($id)
    {
        try {
            $listing = Listing::findOrFail($id);
            return view('backend.listings.show', compact('listing'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('listings.index')->with('error', 'No record found with id: ' . $id . ' (' . $e->getMessage() . ')');
        } catch (\Throwable $th) {
            return redirect()->route('listings.index')->with('error', $th->getMessage());
        }
    }

    public function edit(string $id)
    {
        try {
            $tableName = 'listings';
            $columnNames = Schema::getColumnListing($tableName);
            $listing = Listing::find($id);
            $categories = Category::all();
            $tags = Tag::all();
            if (!$columnNames) {
                return redirect()->route('listings.index')->with('error', "Not able to get column's name.");
            }
            if (!$listing) {
                return redirect()->route('listings.index')->with('error', "Not able to get the listing details.");
            }
            if ($categories->isEmpty()) {
                return redirect()->route('listings.index')->with('error', "Not able to get the categories.");
            }
            if ($tags->isEmpty()) {
                return redirect()->route('listings.index')->with('error', 'Not able to get the tags.');
            }
            return view('backend.listings.edit', compact('listing', 'categories', 'tags', 'columnNames'));
        } catch (\Throwable $th) {
            return redirect()->route('listings.index')->with('error', $th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'category' => 'required',
            'tags' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $listing = Listing::find($id);
            $requestData = $request->all();
            foreach ($requestData as $column => $data) {
                if ($column !== '_token' && $column !== '_method' && $column !== 'tags') {
                    $listing->$column = $data;
                }
            }
            $listing->update();
            if ($requestData['tags']) {
                foreach ($requestData['tags'] as $tag) {
                    $listingTag = new ListingTag();
                    $listingTag->listing_id = $listing->id;
                    $listingTag->tag_id = $tag;
                    $listingTag->save();
                }
            }
            DB::commit();
            return redirect()->route('listings.index')->with('message', 'Listing updated successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('listings.edit')->with('error', 'Not able to update listing.');
        }
    }

    public function destroy(Listing $listing)
    {
        try {
            $listing->delete();
            return redirect()->route('listings.index')->with('message', 'Listing deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->route('listings.index')->with('error', 'Not able to delete the listing.');
        }
    }

    public function export()
    {
        $tableName = 'listings';
        $columnNames = Schema::getColumnListing($tableName);
        $columnGroup = ExportDataGroup::all();
        foreach ($columnGroup as $column) {
            $column->column_names = explode(',', $column->column_names);
        }

        $dropdownData = GeneralHelper::getDropdowns();
        if (!$columnNames) {
            return redirect()->back()->with('error', 'Not able to fetch the column names.');
        }
        if ($columnGroup->isNotEmpty()) {
            return redirect()->back()->with('error', 'Not able to fetch the column groups.');
        }
        if (!$dropdownData) {
            return redirect()->back()->with('error', 'Not able to fetch the general dropdown data.');
        }
        return view('backend.listings.export', compact('dropdownData', 'columnGroup', 'columnNames'));
    }

    public function handelExport()
    {
        $listings = Listing::all();
        if ($listings->isEmpty()) {
            return redirect()->back()->with('error', 'Not able to fetch the listings.');
        }
        $this->exportImportLogs(1);
        return Excel::download(new ListingsExport($listings), 'listings.xlsx');
    }

    public function import()
    {
        return view('backend.listings.import');
    }

    public function handelImport(Request $request)
    {
        $filePath = $request->file('data');
        if ($filePath) {
            // Get the file extension
            $fileExtension = $filePath->getClientOriginalExtension();
        }
        if ($request->filled('headers')) {
            $headers = $request['headers'];
            switch ($fileExtension) {
                case 'xlsx':
                    $import = new ImportExcelJob($headers, auth()->user());
                    Excel::queueImport($import, $request->file('data'));
                    $this->exportImportLogs(0);
                    return response()->json('success');
                case 'csv':
                    $import = new ImportDataJob($headers, auth()->user());
                    Excel::queueImport($import, $request->file('data'));
                    $this->exportImportLogs(0);
                    return response()->json('success');
                    break;
                default:
                    return response()->json(['error' => 'File must be type of csv or xlsx']);
                    break;
            }
        } else {
            // Get columns names from listings table
            $tableName = 'listings';
            $columnNames = Schema::getColumnListing($tableName);
            // Added tag_id column
            array_push($columnNames, 'tag');
            // Get columns names from csv file
            $headers = [];
            switch ($fileExtension) {
                case 'xlsx':
                    $import = new ExcelImport();
                    Excel::import($import, $filePath);
                    $headers = $import->getFirstRow();
                    break;
                case 'csv':
                    $file = new SplFileObject($filePath, 'r');
                    // Set flags to skip empty lines
                    $file->setFlags(SplFileObject::READ_CSV | SplFileObject::SKIP_EMPTY);
                    // Iterate through the file
                    foreach ($file as $lineNumber => $line) {
                        // Process the first line
                        if ($lineNumber === 0) {
                            $headers = $line;
                            break;
                        }
                    }
                    // Close the file when finished reading
                    $file = null;
                    break;
                default:
                    return response()->json(['error' => 'File must be type of csv or xlsx']);
                    break;
            }
            return response()->json(['headers' => $headers, 'columnNames' => $columnNames]);
        }
    }

    public function filter(Request $request)
    {
        $query = Listing::query();
        $tableName = 'listings';
        $dropdownColumnNames = Schema::getColumnListing($tableName);
        $columnGroup = ExportDataGroup::all();
        foreach ($columnGroup as $column) {
            $column->column_names = explode(',', $column->column_names);
        }
        if ($request->has('columnNames')) {
            $ColumnNames = $request->columnNames;

            $requiredColumns = ['name', 'id'];
            foreach ($requiredColumns as $columnName) {
                // Check if column names has required fields
                if (!in_array($columnName, $ColumnNames)) {
                    // if required columns not found then add them
                    array_unshift($ColumnNames, $columnName);
                }
            }
        }

        $dropdownData = GeneralHelper::getDropdowns();
        $query = $this->applyFilters($query, $request->except('_token'));
        $listings = $query->select($ColumnNames)->paginate(10);
        $request->session()->put('filter', $request->except('_token'));
        $request->session()->put('columnNames', $ColumnNames);

        return view('backend.listings.index', compact('listings', 'dropdownData', 'ColumnNames', 'dropdownColumnNames', 'columnGroup'));
    }

    public function exportFilter()
    {
        $query = Listing::query();
        $columnNames = Session::get('columnNames');
        $filter = Session::get('filter');
        $query = $this->applyFilters($query, $filter);
        $listings = $query->select($columnNames)->get();
        $this->exportImportLogs(1);
        return Excel::download(new ListingsExport($listings, $columnNames), 'listings.csv');
    }

    // Common function for "exportFilter", and "filter" functions
    private function applyFilters($query, $filters)
    {
        foreach ($filters as $key => $value) {
            if ($value && $key !== '_token') {
                switch ($key) {
                    case 'name':
                    case 'full_address':
                        $query->where($key, 'like', '%' . $value . '%');
                        break;
                    case 'cities':
                        foreach ($value as $item) {
                            $query->Where('city', $item);
                        }
                        break;
                    case 'states':
                        foreach ($value as $item) {
                            $query->Where('state', $item);
                        }
                        break;
                    case 'categories':
                        foreach ($value as $category) {
                            $query->Where('category', $category);
                        }
                        break;
                    case 'tags':
                        $query->whereHas('listingTags', function ($query) use ($value) {
                            $query->select('listing_id')
                                ->whereIn('tag_id', $value)
                                ->groupBy('listing_id')
                                ->havingRaw('COUNT(DISTINCT tag_id) = ?', [count($value)]);
                        });
                        break;
                    case 'postal_code':
                        $query->where($key, $value);
                        break;
                    case 'phone':
                    case 'site':
                        if ($value == 'null') {
                            $query->whereNull($key);
                        } else {
                            $query->whereNotNull($key);
                        }
                        break;
                    default:
                        break;
                }
            }
        }

        return $query;
    }

    // Display import export logs
    public function importExportLogs()
    {
        $logs = ExportImportLog::all();
        if (!$logs) {
            return redirect()->back()->with('error', 'Not able to fetch the import export logs.');
        }
        return view('backend.log.index', compact('logs'));
    }

    public function getStatus()
    {
        $jobs = Job::all();
        $failedJobs = FailedJob::all();
        foreach ($jobs as $job) {
            $job->available_at = Carbon::parse($job->available_at)->format('d-m-Y');
            $job->created_at = Carbon::parse($job->created_at)->format('d-m-Y');
        }
        return view('backend.listings.status', compact('jobs', 'failedJobs'));
    }

    private function exportImportLogs($type)
    {
        $log = new ExportImportLog();
        $log->user_id = auth()->user()->id;
        $log->type = $type; // 1 = export, 0 = import
        $log->save();
    }
}
