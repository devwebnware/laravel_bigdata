@extends('backend.layouts.main')
@section('content')
<x-alert />
<div class="d-flex flex-row">
    <div class="ml-auto">
        <a href="{{ route('categories.create')}}" class='btn btn-info mr-auto'>Add Category</a>
    </div>
</div>
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
    <div class="datatable-wrap my-3" style="border: 0;">
        <table class="datatable-init nowrap table dataTable no-footer dtr-inline" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
            <thead>
                <tr>
                    <!-- TODO: Check area-label -->
                    <th class="sorting sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">S. No.</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Category Name</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">last Updated On</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">Created By</th>
                    <th class="sorting text-center" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $key => $category)
                <tr>
                    <td class="dtr-control sorting_1" tabindex="0">{{ ++$key }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->updated_at }}</td>
                    <td>{{ $category->user->name }}</td>
                    <td class="nk-tb-col text-center nk-tb-col-tools">
                    <a href="{{ route('categories.edit', ['category' => $category->id]) }}"><em style="font-size: 20px;" class="icon ni ni-edit"></em></a>
                    </td>
                </tr>
                @empty
                <tr class="text-center">
                    <td colspan="5">No Data Available</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection