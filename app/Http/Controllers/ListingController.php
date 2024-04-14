<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Job;
use App\Models\Listing;
use App\Models\Category;
use App\Models\ListingTag;
use App\Jobs\ImportDataJob;
use Illuminate\Http\Request;
use App\Events\FileUploaded;
use App\Helpers\GeneralHelper;
use App\Events\ImportJobStart;
use App\Models\ImportJobStatus;
use App\Models\ExportImportLog;
use App\Exports\ListingsExport;
use App\Imports\ListingsImport;
use Illuminate\Support\Facades\Auth;
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
            $tableName = 'listings';
            $dropdownColumnNames = Schema::getColumnListing($tableName);
            $ColumnNames = $dropdownColumnNames;
            $dropdownData = GeneralHelper::getDropdowns();
            $listings = Listing::paginate(10);
            return view('backend.listings.index', compact('listings', 'tags', 'dropdownData', 'ColumnNames', 'dropdownColumnNames'));
        } else {
            return redirect()->route('dashboard')->with('error', 'User is not authorized for access.');
        };
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('backend.listings.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name|max:255',
            'category_id' => 'required',
            'tag_id' => 'required',
        ]);

        $listing = new Listing();
        $listing->name = $request->name;
        $listing->category_id = $request->category_id;
        $listing->tag_id = $request->tag_id;
        $listing->created_by = auth()->user()->id;
        $listing->save();

        return redirect()->route('listings.index')->with('success', 'Listing created successfully.');
    }

    public function show($id)
    {
        $listing = Listing::find($id);
        return view('backend.listings.show', compact('listing'));
    }

    public function edit(string $id)
    {
        $listing = Listing::find($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('backend.listings.edit', compact('listing', 'categories', 'tags'));
    }

    public function update(Request $request, Listing $listing)
    {
        $request->validate([
            'name' => 'required|unique:tags,name,' . $listing->id . '|max:255',
            'category_id' => 'required',
            'tags' => 'required',
        ]);

        $listing->name = $request->name;
        $listing->category_id = $request->category_id;
        $listing->created_by = auth()->user()->id;
        $listing->update();
        if ($request->tags) {
            foreach ($request->tags as $tag) {
                $listingTag = new ListingTag();
                $listingTag->listing_id = $listing->id;
                $listingTag->tag_id = $tag;
                $listingTag->save();
            }
        }

        return redirect()->route('listings.index')->with('success', 'Listing updated successfully.');
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

        return view('backend.listings.index', compact('listings', 'dropdownData', 'ColumnNames', 'dropdownColumnNames'));
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
