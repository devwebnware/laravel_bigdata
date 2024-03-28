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
<div class="card mb-3 card-bordered mt-3 card-preview">
    <div class="card-inner">
        <form method="POST" action="{{ route('listings.filter')}}">  
            @csrf
            <div class="row">
                <div class="col-md-3 mb-2">
                    <label class="form-label">Listing Name</label>
                    <input type="text" name="listing_name" id="listing_name" class="form-control" />
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label">Category</label>
                    <select class="form-select js-select2 select2-hidden-accessible" id="category_id" name='category_id' data-search="on" tabindex="-1" aria-hidden="true">
                        <option value="">Select Option</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label">Tag</label>
                    <select class="form-select js-select2 select2-hidden-accessible" id="tag_id" name='tag_id' data-search="on" tabindex="-1" aria-hidden="true">
                        <option value="">Select Option</option>
                        @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label">User</label>
                    <select class="form-select js-select2 select2-hidden-accessible" id="user_id" name='user_id' data-search="on" tabindex="-1" aria-hidden="true">
                        <option value="">Select Option</option>
                        @foreach ($users as $user)
                        <option value="{{ $tag->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" />
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" />
                </div>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-info">Filter Listings</button>
                <button type="button" class="btn clear-filter btn-secondary">Clear</button>
            </div>
        </form>
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
                <th class="tb-tnx-info text-center">Actions</th>
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
    // ** If changes were made here then make sure to update (backend.listings.index) view
    // Form submittion for listing delete
    function deleteRequest(name, id) {
        event.preventDefault();
        if (confirm('Do you really want to delete ' + '"' + name + '"' + " listing ?")) {
            $('#delete_form').attr('action', `/listings/${id}`);
            $('#delete_form').submit();
        }
    }

    // Clear filter
    $('.clear-filter').click(function() {
        $('.form-control, .form-select').val('').trigger('change');
    }); 
</script>
@endpush
@endsection