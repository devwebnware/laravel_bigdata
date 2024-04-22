<!-- // ** If changes were made here then make sure to update (backend.listings.filter) view -->

@extends('backend.layouts.main')
@section('content')
<x-alert />
<div class="d-flex flex-row">
    <a href="{{ route('listing.export.group.create')}}" class='btn btn-secondary mr-2'>ADD GROUP</a>
</div>

<div class="card card-bordered table-responsive mt-3 card-preview">
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">ACTIONS</th>
                @foreach($ColumnNames as $column)
                <th scope="col">{{ strtoupper($column) }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @php
            $serialNumber = ($ExportDataGroups->currentPage() - 1) * $ExportDataGroups->perPage() + 1;
            @endphp
            @forelse($ExportDataGroups as $key => $group)
            <tr>
                <td scope="row">{{ substr($serialNumber++,0, 20) }}</td>
                <td scope="row">
                    <div class="drodown">
                        <a href="javascript:void(0)" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="link-list-opt">
                                <li><a href="{{ route('listing.export.group.edit', ['id' => $group->id]) }}"><em style="font-size: 20px;" class="icon ni ni-edit"></em>Edit</a></li>
                                <li><a href="#" onclick="deleteRequest('{{$group->group_name}}','{{$group->id}}')"><em class="icon ni ni-trash"></em>Delete</a></li>
                            </ul>
                        </div>
                    </div>
                </td>
                @foreach($group->getAttributes() as $key => $attribute)
                <td scope="row">
                    {{ $attribute }}
                </td>
                @endforeach
            </tr>
            @empty
            <tr class="text-center">
                <td colspan="{{ count($ColumnNames)+2 }}">No Data Available</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="d-flex mt-2 justify-content-start">
    {{ $ExportDataGroups->links('components/custom-pagination') }}
</div>
<form action="" method="post" id="delete_form">
    @method('delete')
    @csrf
</form>


@push('custom-js')
<script>
    // Form submittion for listing delete
    function deleteRequest(name, id) {
        console.log(name, id);
        event.preventDefault();
        if (confirm('Do you really want to delete ' + '"' + name + '"' + " group ?")) {
            $('#delete_form').attr('action', '/listing/export/groups/' + id + '/delete');
            $('#delete_form').submit();
        }
    }
</script>
@endpush
@endsection