<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('backend.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('backend.tags.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name|max:255',
            'bg_color' => 'required',
            'color' => 'required',
        ]);

        $tag = new Tag;
        $tag->name = $request->name;
        $tag->bg_color = $request->bg_color;
        $tag->color = $request->color;
        $tag->created_by = auth()->user()->id;
        $tag->save();

        return redirect()->route('tags.index')->with('success', 'Tag created successfully.');
    }

    public function show(Tag $tag)
    {
        return view('tag.show', compact('tag'));
    }

    public function edit(Tag $tag)
    {
        return view('backend.tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|unique:tags,name,' . $tag->id . '|max:255',
            'bg_color' => 'required',
            'color' => 'required',
        ]);

        $tag->name = $request->name;
        $tag->bg_color = $request->bg_color;
        $tag->color = $request->color;
        $tag->created_by = auth()->user()->id;
        $tag->update();

        return redirect()->route('tags.index')->with('success', 'Tag updated successfully.');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully.');
    }
}
