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
<div class="card card-bordered mt-3 card-preview">
    <table class="table table-tranx">
        <thead>
            <tr class="tb-tnx-head">
                <th class="tb-tnx-id"><span class="">#</span></th>
                <th class="tb-tnx-info">Listing Name</th>
                <th class="tb-tnx-info">Category Name</th>
                <th class="tb-tnx-info">Tag Name</th>
                <th class="tb-tnx-info">last Updated On</th>
                <th class="tb-tnx-info">Created By</th>
                <th class="tb-tnx-info">Actions</th>
            </tr>
        </thead>
        <tbody>
        @php
            $serialNumber = ($listings->currentPage() - 1) * $listings->perPage() + 1;
        @endphp
            @forelse($listings as $key => $listing)
            <tr>
                <td>{{ $serialNumber++ }}</td>
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
<div class="d-flex mt-2 justify-content-start">
        {{ $listings->links('components/custom-pagination') }}
    </div>
<form action="" method="post" id="delete_form">
    @method('delete')
    @csrf
</form>
@push('custom-js')
<script>
    function deleteRequest(name, id) {
        event.preventDefault();
        if (confirm('Do you really want to delete ' + '"' + name + '"' + " listing ?")) {
            $('#delete_form').attr('action', `/listings/${id}`);
            $('#delete_form').submit();
        }
    }
</script>
@endpush
@endsection