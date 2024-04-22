<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExportDataGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Redirect;

class ExportDataGroupController extends Controller
{
    public function index()
    {
        try {
            $tableName = 'export_data_groups';
            $ColumnNames = Schema::getColumnListing($tableName);
            $ExportDataGroups = ExportDataGroup::paginate(10);
            return view('backend.exportDataGroup.index', compact('ColumnNames', 'ExportDataGroups'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function create()
    {
        $tableName = 'listings';
        $ColumnNames = Schema::getColumnListing($tableName);
        return view('backend.exportDataGroup.create', compact('ColumnNames'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
            'column_names' => 'required|array',
        ]);

        try {
            DB::beginTransaction();
            $exportDataGroup = new ExportDataGroup;
            $exportDataGroup->group_name = $request->name;
            $columnNames = $request->input('column_names');
            if (!in_array('name', $columnNames)) {
                $columnNames[] = 'name';
            }
            if (!in_array('id', $columnNames)) {
                $columnNames[] = 'id';
            }
            $exportDataGroup->column_names = implode(",", $columnNames);
            if ($exportDataGroup->save()) {
                DB::commit();
            }
            return redirect()->route('listing.export.group.index')->with('success', 'Group created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('listing.export.group.create')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $tableName = 'listings';
            $ColumnNames = Schema::getColumnListing($tableName);
            $dataGroup = ExportDataGroup::find($id);
            $dataGroup->column_names = explode(',', $dataGroup->column_names);
            return view('backend.exportDataGroup.edit', compact('dataGroup', 'ColumnNames'));
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'column_names' => 'required|array',
        ]);
        try {
            DB::beginTransaction();
            $exportDataGroup = ExportDataGroup::find($id);
            $exportDataGroup->group_name = $request->name;
            $columnNames = $request->input('column_names');
            if (!in_array('name', $columnNames)) {
                $columnNames[] = 'name';
            }
            if (!in_array('id', $columnNames)) {
                $columnNames[] = 'id';
            }
            $exportDataGroup->column_names = implode(",", $columnNames);
            if ($exportDataGroup->update()) {
                DB::commit();
                return redirect()->route('listing.export.group.index')->with('success', 'Group has been updated');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            if (ExportDataGroup::find($id)->delete()) {
                return redirect()->route('listing.export.group.index')->with('success', 'Group deleted successfully');
            }
        } catch (\Throwable $th) {
            return redirect()->route('listing.export.group.index')->with('error', $th->getMessage());
        }
    }
}
