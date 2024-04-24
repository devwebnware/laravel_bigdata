<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dropdown;
use Illuminate\Http\Request;

class DropdownController extends Controller
{
    public function __contruct()
    {
        $this->middleware(['auth', 'permission:dropdown_crud']);
    }
    public function index()
    {
        $dropdowns = Dropdown::orderBy('key', 'asc')->get();
        return view('backend.dropdown.index', compact('dropdowns'));
    }
    public function create()
    {
        $distinctKeys = Dropdown::where('status', '1')->select('key')->distinct()->get();
        $allValues = Dropdown::where('status', '1')->get();
        return view('backend.dropdown.create', compact('distinctKeys', 'allValues'));
    }
    public function store(Request $request)
    {
        $allValues = explode(',', $request->value);
        if ($allValues) {
            foreach ($allValues as $item) {
                $option = Dropdown::where('value', $item)->where('key', $request->key)->first();
                if (!$option) {
                    $dropdown = new Dropdown();
                    $dropdown->key = $request->key;
                    $dropdown->key_sub = $request->key_sub;
                    $dropdown->value = $item;
                    $dropdown->save();
                }
            }
            if ($dropdown->save()) {
                return redirect(route('dropdown.index'))->with('message', 'Dropdown option added successfully');
            } else {
                return redirect(route('dropdown.index'))->with('error', 'An error occurred. Please try again.');
            }
        } else {
            return redirect(route('dropdown.index'))->with('error', 'An error occurred. Please try again.');
        }
    }
    public function edit($id)
    {
        $option = Dropdown::where('id', $id)->first();
        $distinctKeys = Dropdown::where('status', '1')->select('key')->distinct()->get();
        $allValues = Dropdown::where('status', '1')->get();
        return view('backend.dropdown.edit', compact('distinctKeys', 'allValues', 'option'));
    }
    public function update(Request $request, $id)
    {
        $dropdown = Dropdown::where('id', $id)->first();
        if ($dropdown) {
            $dropdown->key = $request->key;
            $dropdown->key_sub = $request->key_sub;
            $dropdown->value = $request->value;
            if ($dropdown->save()) {
                return redirect(route('dropdown.index'))->with('message', 'Dropdown option added successfully');
            } else {
                return redirect(route('dropdown.index'))->with('error', 'An error occurred. Please try again.');
            }
        } else {
            return redirect(route('dropdown.index'))->with('error', 'An error occurred. Please try again.');
        }
    }
    public function destroy($id)
    {
        $dropdown = Dropdown::where('id', $id)->first();
        if ($dropdown->delete()) {
            return redirect(route('dropdown.index'))->with('message', 'Dropdown option deleted successfully');
        } else {
            return redirect(route('dropdown.index'))->with('error', 'An error occurred. Please try again.');
        }
    }

    public function toggleStatus(Request $request)
    {
        $dropdown = Dropdown::find($request->id)->update(['status' => $request->status]);
        return response()->json(['message' => 'Status changed successfully.']);
    }
}
