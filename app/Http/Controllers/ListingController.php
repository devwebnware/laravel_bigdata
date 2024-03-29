<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Listing;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Exports\ListingsExport;
use App\Jobs\ImportDataJob;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ListingController extends Controller
{
    protected $_action;
    public function index()
    {
        $tableName = 'listings';
        $columnNames = Schema::getColumnListing($tableName);
        $categories = Category::select('id', 'name')->get();
        $tags = Tag::select('id', 'name')->get();
        $users = User::select('id', 'name')->get();
        $listings = Listing::paginate(10);
        return view('backend.listings.index', compact('listings', 'categories', 'tags', 'users', 'columnNames'));
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

    public function show(string $id)
    {
        //
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
        ]);

        $listing->name = $request->name;
        $listing->category_id = $request->category_id;
        $listing->tag_id = $request->tag_id;
        $listing->created_by = auth()->user()->id;
        $listing->update();

        return redirect()->route('listings.index')->with('success', 'Listing updated successfully.');
    }

    public function destroy(Listing $listing)
    {
        $listing->delete();

        return redirect()->route('listings.index')->with('success', 'Listing deleted successfully.');
    }

    public function export()
    {
        return Excel::download(new ListingsExport, 'listings.csv');
    }

    public function import()
    {
        return view('backend.listings.import');
    }

    public function handelImport(Request $request)
    {
        Excel::queueImport(new ImportDataJob, $request->file('data'));
        return response()->json(['message' => 'Import job queued']);
    }

    public function filter(Request $request)
    {
        $tableName = 'listings';
        $columnNames = Schema::getColumnListing($tableName);
        $query = Listing::query();
        $categories = Category::select('id', 'name')->get();
        $tags = Tag::select('id', 'name')->get();
        $users = User::select('id', 'name')->get();

        if ($request->filled('listing_name')) {
            $query->where('name', 'like', '%' . $request->listing_name . '%');
        }

        if ($request->filled('full_address')) {
            $query->where('full_address', 'like', '%' . $request->full_address . '%');
        }

        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('tag_id')) {
            $query->where('tag_id', $request->tag_id);
        }

        if ($request->filled('user_id')) {
            $query->where('created_by', $request->user_id);
        }

        if ($request->filled('start_date')) {
            $start = Carbon::parse($request->start_date);
            $query->whereDate('created_at', '>=', $start);
        }

        if ($request->filled('end_date')) {
            $end = Carbon::parse($request->end_date);
            $query->whereDate('created_at', '<=', $end);
        }

        if ($request->filled('query')) {
            $query->where('query', 'like', '%' . $request->query . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', 'like', '%' . $request->type . '%');
        }

        if ($request->filled('state')) {
            $query->where('state', 'like', '%' . $request->state . '%');
        }

        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        if ($request->filled('postal_code')) {
            $query->where('postal_code', $request->postal_code);
        }

        if ($request->filled('country')) {
            $query->where('country', 'like', '%' . $request->country . '%');
        }

        $search = $request->all();
        Session::set('name', $request->name);
        Session::set('category_id', $request->category_id);
        Session::set('tag_id', $request->tag_id);
        Session::set('user_id', $request->user_id);
        Session::set('full_address', $request->full_address);
        Session::set('city', $request->city);
        Session::set('state', $request->state);
        Session::set('query', $request->query);
        Session::set('type', $request->type);
        Session::set('postal_code', $request->postal_code);
        Session::set('start_date', $request->start_date);
        Session::set('end_date', $request->end_date);
        Session::set('postel_code', $request->end_date);
        $listings = $query->paginate(10);

        return view('backend.listings.filter', compact('listings', 'categories', 'tags', 'users', 'columnNames', 'search'));
    }
}
