<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Listing;
use App\Models\Category;
use App\Models\ListingTag;
use App\Jobs\ImportDataJob;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use App\Models\ExportImportLog;
use App\Exports\ListingsExport;
use App\Imports\ListingsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;


class ListingController extends Controller
{
    protected $_action;

    public function index()
    {
        $tableName = 'listings';
        $columnNames = Schema::getColumnListing($tableName);
        $tags = ListingTag::all();
        $dropdownData = GeneralHelper::getDropdowns();
        $listings = Listing::paginate(10);
        return view('backend.listings.index', compact('listings', 'tags', 'dropdownData', 'columnNames'));
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

    public function show(Listing $listing)
    {
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
        $dropdownData = GeneralHelper::getDropdowns();
        return view('backend.listings.export', compact('dropdownData'));
    }

    public function handelExport()
    {
        $listings = Listing::all();
        $log = new ExportImportLog();
        $log->user_id = auth()->user()->id;
        $log->type = 1;
        $log->save();
        return Excel::download(new ListingsExport($listings), 'listings.csv');
    }

    public function import()
    {
        return view('backend.listings.import');
    }

    public function handelImport(Request $request)
    {
        if ($request->filled('headers')) {
            // dd($request['headers']);
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
            $import = new ImportDataJob($request['headers']);
            Excel::queueImport($import, $request->file('data')); // CSV data import job
            return response()->json(['message' => 'Import job queued']);
        } else {
            $tableName = 'listings';
            $columnNames = Schema::getColumnListing($tableName);
            $headers = Excel::toArray([], $request->file('data'))[0][0];
            return response()->json(['headers' => $headers, 'columnNames' => $columnNames]);
        }
    }

    public function filter(Request $request)
    {
        $tableName = 'listings';
        $columnNames = Schema::getColumnListing($tableName);
        $query = Listing::query();
        $dropdownData = GeneralHelper::getDropdowns();
        $query = $this->applyFilters($query, $request->except('_token'));

        $listings = $query->paginate(10);
        $request->session()->put('filter', $request->except('_token'));

        return view('backend.listings.index', compact('listings', 'dropdownData', 'columnNames'));
    }

    public function exportFilter()
    {
        $filter = Session::get('filter');
        $query = Listing::query();
        $query = $this->applyFilters($query, $filter);
        $listings = $query->get();

        $log = new ExportImportLog();
        $log->user_id = auth()->user()->id;
        $log->type = 1;
        $log->save();

        return Excel::download(new ListingsExport($listings), 'listings.csv');
    }

    // Common function for "exportFilter", and "filter" functions
    private function applyFilters($query, $filters)
    {
        foreach ($filters as $key => $value) {
            if ($value && $key !== '_token') {
                switch ($key) {
                    case 'name':
                    case 'full_address':
                    case 'city':
                    case 'query':
                    case 'type':
                    case 'state':
                    case 'country':
                        $query->where($key, 'like', '%' . $value . '%');
                        break;
                    case 'category_id':
                    case 'tag_id':
                    case 'user_id':
                    case 'postal_code':
                        $query->where($key, $value);
                        break;
                    case 'start_date':
                        $start = Carbon::parse($value);
                        $query->whereDate('created_at', '>=', $start);
                        break;
                    case 'end_date':
                        $end = Carbon::parse($value);
                        $query->whereDate('created_at', '<=', $end);
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

    public function getHeaders(Request $request)
    {
        try {
            // Read the first row (headers) from the uploaded CSV file
            $headers = Excel::toArray([], $request->file('data'))[0][0];
            dd($headers);
            return response()->json(['headers' => $headers]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
