<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class FieldController extends Controller
{
    public function index()
    {
        $fields = Field::all();
        return view('backend.field.index', compact('fields'));
    }

    public function create()
    {
        $types = [
            'text' => 'Text',
            'textarea' => 'Textarea',
            'number' => 'Number',
            'date' => 'Date',
            'time' => 'Time',
            'datetime' => 'Datetime',
            'boolean' => 'Boolean',
        ];
        return view('backend.field.create', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:fields,name|max:255',
            'type' => 'required',
        ]);

        $field = new Field;
        $field->name = $request->name;
        $field->type = $request->type;
        if($field->save()) {
            Schema::table('listings', function (Blueprint $table) use ($request) {
                $columnName = $request->name;
                $columnType = $request->type;
                $table->$columnType($columnName)->nullable();
            });
        }

        return redirect()->route('field.index')->with('success', 'Field Created Successfully');
    }
}
