@extends('backend.layouts.main')
@section('content')
<x-alert />
<div class="d-flex flex-row">
    <a href="{{ route('listings.data.import')}}" class='btn btn-secondary mr-2'>Import</a>
    <a href="{{ route('listings.data.export')}}" class='btn btn-secondary'>Export</a>
    <div class="ml-auto">
        <a href="{{ route('listings.create')}}" class='btn btn-info mr-auto text-decoration-none'>Add Listing</a>
    </div>
</div>
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
    <div class="datatable-wrap my-3" style="border: 0;">
        <table class="datatable-init nowrap table dataTable no-footer dtr-inline"  id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
            <thead>
                <tr>
                    <!-- TODO: Check area-label -->
                    <th class="sorting sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">S. No.</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Listing Name</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Category Name</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Tag Name</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">last Updated On</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">Created By</th>
                    <th class="sorting text-center" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($listings as $key => $listing)
                <tr>
                    <td class="dtr-control sorting_1" tabindex="0">{{ ++$key }}</td>
                    <td>{{ $listing->name }}</td>
                    <td>{{ $listing->category->name }}</td>
                    <td>{{ $listing->tag->name }}</td>
                    <td>{{ $listing->updated_at }}</td>
                    <td>{{ $listing->user->name }}</td>
                    <td class="nk-tb-col text-center nk-tb-col-tools">
                        <a href="{{ route('listings.edit', ['listing' => $listing->id]) }}"><em style="font-size: 20px;" class="icon ni ni-edit"></em></a>
                        <a class="ml-2" href="#" onclick="deleteRequest('{{$listing->name}}','{{$listing->id}}')"><em style="font-size: 20px; color: red;" class="icon ni ni-trash"></em></em></a>
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
<form action="" method="post" id="delete_form">
    @method('delete')
    @csrf
</form>
@push('custom-js')
<script>
    function deleteRequest(name, id) {
        event.preventDefault();
        if (confirm('Do you really want to delete ' + '"' + name + '"'+ " listing ?")) {
            $('#delete_form').attr('action', `/listings/${id}`);
            $('#delete_form').submit();
        }
    }
</script>
@endpush
@endsection