<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParentCategory;

class ParentCategoryController extends Controller
{
    public function index()
    {
        $categories = ParentCategory::all();
        return view('backend.parentCategories.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.parentCategories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:parent_categories,name|max:255',
        ]);

        $category = new ParentCategory;
        $category->name = $request->name;
        $category->created_by = auth()->user()->id;
        $category->save();

        return redirect()->route('parent.categories.index')->with('message', 'Category created successfully.');
    }

    public function edit(ParentCategory $ParentCategory)
    {
        return view('backend.parentCategories.edit', compact('ParentCategory'));
    }

    public function update(Request $request, ParentCategory $ParentCategory)
    {
        $request->validate([
            'name' => 'required|unique:parent_categories,name,' . $ParentCategory->id . '|max:255',
        ]);

        $ParentCategory->name = $request->name;
        $ParentCategory->created_by = auth()->user()->id;
        $ParentCategory->update();

        return redirect()->route('parent.categories.index')->with('message', 'Category updated successfully.');
    }

    public function destroy(ParentCategory $ParentCategory)
    {
        $ParentCategory->delete();

        return redirect()->route('parentCategories.index')->with('message', 'Category deleted successfully.');
    }
}
