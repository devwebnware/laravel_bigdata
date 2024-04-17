@extends('backend.layouts.main')
<style>
    .alert-div {
        position: fixed;
        right: 38px;
        width: 20%;
        z-index: 10;
    }

    @media only screen and (max-width: 767px) {
        .alert-div {
            position: relative;
            right: 0;
            width: 100%;
            z-index: 10;
        }
    }
</style>
@section('content')
<x-alert />
<div class="card card-preview">
    <div class="card-inner">
        <div class="card-title-group align-start mb-2">
            <h2 class="">Stats</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h4>Categories</h4>
                <p>{{ $categoriesCount }}</p>
            </div>
            <div class="col-md-4">
                <h4>Tags</h4>
                <p>{{ $tagsCount }}</p>
            </div>
            <div class="col-md-4">
                <h4>Listings</h4>
                <p>{{ $listingsCount }}</p>
            </div>
        </div>
    </div>
</div>
<div class="card card-preview">
    <div class="card-inner">
        <div class="card-title-group align-start mb-2">
            <h2 class="">Filter Listings</h2>
        </div>
        <form method="POST" action="{{ route('listings.filter')}}">
            @csrf
            <div class="modal-body-md">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <label class="form-label">Select columns to export <span class="text-muted">(For all left blank)</span></label>
                        <select class="form-select" multiple="multiple" id="columns" data-placeholder="Select Columns" name="columnNames[]">
                            @foreach($columnNames as $column)
                            <option value="{{ $column }}" @if($column === 'id' || $column === 'name') selected @endif>{{ucwords( $column )}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label">Listing Name</label>
                        <input type="text" name="listing_name" id="listing_name" class="form-control" />
                    </div>
                    {{-- <div class="col-md-3 mb-2">
                        <label class="form-label">User</label>
                        <select class="form-select js-select2 select2-hidden-accessible" id="user_id" name='user_id' data-search="on" tabindex="-1" aria-hidden="true">
                            <option value="">Select Option</option>
                            @foreach ($dropdownData['users'] as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="col-md-4 mb-2">
                        <label class="form-label">Full Address</label>
                        <input type="text" name="full_address" id="full_address" class="form-control" />
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label">Postal Code</label>
                        <input name="postal_code" type="text" pattern="\d*" minlength="5" maxlength="5" placeholder="54321" id="postal_code" class="form-control" />
                    </div>
                    {{-- <div class="col-md-4 mb-2">
                        <label class="form-label">Type</label>
                        <input type="text" name="type" id="type" class="form-control" />
                    </div> --}}
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Category</label>
                        <select class="form-select" multiple="multiple" id="category_id" data-placeholder="Select Category" name='category_ids[]'>
                            <option value="">Select Option</option>
                            @foreach ($dropdownData['categories'] as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Tag</label>
                        <select class="form-select" multiple="multiple" id="tag_id" data-placeholder="Select Tag" name='tag_ids[]'>
                            <option value="">Select Option</option>
                            @foreach ($dropdownData['tags'] as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="col-md-3 mb-2">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" />
                    </div>
                    <div class="col-md-3 mb-2">
                        <label class="form-label">End Date</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" />
                    </div> --}}
                    {{-- <div class="col-md-3 mb-2">
                        <label class="form-label">Query</label>
                        <input type="text" name="query" id="query" class="form-control" />
                    </div> --}}
                    {{-- <div class="col-md-3 mb-2">
                    <label class="form-label">Country</label>
                        <select class="form-select js-select2 select2-hidden-accessible" id="country" name='country' data-search="on" tabindex="-1" aria-hidden="true">
                            <option value="">Select Option</option>
                            @foreach ($dropdownData['countries'] as $country)
                            <option value="{{ $country }}">{{ $country }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="col-md-6 mb-2">
                    <label class="form-label">State</label>
                        <select class="form-select" multiple="multiple" id="state" data-placeholder="Select State" name='states[]'>
                            <option value="">Select Option</option>
                            @foreach ($dropdownData['states'] as $state)
                            <option value="{{ $state }}">{{ $state }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">City</label>
                        <select class="form-select" multiple="multiple" id="city" data-placeholder="Select city" name='cities[]'>
                            <option value="">Select Option</option>
                            @foreach ($dropdownData['cities'] as $city)
                            <option value="{{ $city }}">{{ $city }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Phone</label>
                        <select class="form-select" id="phone" data-placeholder="Select Option" name='phone'>
                            <option disabled selected>Select Option</option>
                            <option value="null">Blank</option>
                            <option value="NN">Not Blank</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Site</label>
                        <select class="form-select" id="site" data-placeholder="Select Option" name='site'>
                            <option disabled selected>Select Option</option>
                            <option value="null">Blank</option>
                            <option value="NN">Not Blank</option>
                        </select>
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-info">Filter Listings</button>
                    <button type="button" class="btn clear-filter btn-secondary">Clear</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('custom-js')
@endpush