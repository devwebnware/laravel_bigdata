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
            'string' => 'String',
            'text' => 'Text',
            'integer' => 'Integer',
            'bigInteger' => 'Big Integer',
            'decimal' => 'Decimal',
            'float' => 'Float',
            'double' => 'Double',
        ];
        return view('backend.field.create', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:fields,name|max:255',
            'type' => 'required',
        ]);

        try {
            Schema::table('listings', function (Blueprint $table) use ($request) {
                $columnName = $request->name;
                $columnType = $request->type;
                $table->$columnType($columnName)->nullable();
            });

            $field = new Field;
            $field->name = $request->name;
            $field->type = $request->type;
            $field->created_by = auth()->user()->id;
            $field->save();
            return redirect()->route('field.index')->with('message', 'Field created successfully');
        } catch (\Throwable $th) {
            return redirect()->route('field.index')->with('error', 'Failed to create field');
        }
    }
}
