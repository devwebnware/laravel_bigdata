<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Listing;
use App\Models\Category;
use App\Models\ListingTag;
use App\Jobs\ImportDataJob;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use App\Models\ImportJobStatus;
use App\Models\ExportImportLog;
use App\Exports\ListingsExport;
use App\Models\ExportDataGroup;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;


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

    // public function create()
    // {
    //     $categories = Category::all();
    //     $tags = Tag::all();
    //     if($categories->isNotEmpty() && $tags->isNotEmpty()) {
    //         return view('backend.listings.create', compact('categories', 'tags'));
    //     } else {
    //         Log::error('Error while fetching categories and tags. Check if they are not empty.');
    //         return redirect()->back()->with('error', 'Error while fetching categories and tags. Check if they are not empty.');
    //     }
    // }

    // public function store(Request $request)
    // {
    //     // dd($request->all());
    //     $request->validate([
    //         'name' => 'required|max:255',
    //         'category_id' => 'required',
    //         'tags' => 'required',
    //     ]);
    //     try {
    //         $listing = new Listing();
    //         $listing->name = $request->name;
    //         $listing->category_id = $request->category_id;
    //         $listing->tag_id = $request->tags;
    //         $listing->created_by = null;
    //         $listing->save();

    //         return redirect()->route('listings.index')->with('success', 'Listing created successfully.');
    //     } catch (\Throwable $th) {
    //         return redirect()->back()->with('error', $th->getMessage());
    //     }

    // }

    public function show($id)
    {
        $listing = Listing::find($id);
        return view('backend.listings.show', compact('listing'));
    }

    public function edit(string $id)
    {
        $tableName = 'listings';
        $columnNames = Schema::getColumnListing($tableName);
        $listing = Listing::find($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('backend.listings.edit', compact('listing', 'categories', 'tags', 'columnNames'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required',
            'tags' => 'required',
        ]);
        try {
            $listing = Listing::find($id);
            $requestData = $request->all();
            foreach ($requestData as $column => $data) {
                if($column !== '_token' && $column !== '_method' && $column !== 'tags') {
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
            return redirect()->route('listings.index')->with('success', 'Listing updated successfully.');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function destroy(Listing $listing)
    {
        $listing->delete();

        return redirect()->route('listings.index')->with('success', 'Listing deleted successfully.');
    }

    public function export()
    {
        $tableName = 'listings';
        $columnNames = Schema::getColumnListing($tableName);
        $dropdownData = GeneralHelper::getDropdowns();
        return view('backend.listings.export', compact('dropdownData', 'columnNames'));
    }

    public function handelExport()
    {
        $listings = Listing::all();
        $this->exportImportLogs(1);
        return Excel::download(new ListingsExport($listings), 'listings.csv');
    }

    public function import()
    {
        return view('backend.listings.import');
    }

    public function handelImport(Request $request)
    {
        if ($request->filled('headers')) {
            // Start: CSV file data validation before database operations
            // try {
            //     $import = new ListingsImport($request['headers']);
            //     Excel::import($import, $request->file('data'));
            //     $log = new ExportImportLog();
            //     $log->user_id = auth()->user()->id;
            //     $log->type = 0;
            //     $log->save();
            // } catch (\Exception $e) {
            //     return back()->with('error', $e->getMessage());
            // }
            // End
            // if ($request->hasFile('data')) {
            //     $fileName = $request->file('data')->getClientOriginalName();
            // }
            // $fileData = [
            //     'file_name'
            // ];
            $jobStatus = new ImportJobStatus();
            $jobStatus->file_name = $request->file('data')->getClientOriginalName();
            $jobStatus->save();
            $jobStatusId = $jobStatus->id;
            $import = new ImportDataJob($request['headers']);
            Excel::queueImport($import, $request->file('data'));
            $this->exportImportLogs(0);
            return redirect()->route('listings.data.import');
        } else {
            // Get columns names from listings table
            $tableName = 'listings';
            $columnNames = Schema::getColumnListing($tableName);
            // Get columns names from csv file
            $file = fopen($request->file('data'), 'r');
            if ($file !== false) {
                $headers = fgetcsv($file);
                fclose($file);
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
        // dd($query->toSql());
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
                    case 'category_ids':
                        foreach ($value as $category_id) {
                            $query->Where('category_id', $category_id);
                        }
                        break;
                    case 'tag_ids':
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
        return view('backend.log.index', compact('logs'));
    }

    public function getStatus()
    {
        return view('backend.listings.status');
    }

    private function exportImportLogs($type)
    {
        $log = new ExportImportLog();
        $log->user_id = auth()->user()->id;
        $log->type = $type; // 1 = export, 0 = import
        $log->save();
    }
}
