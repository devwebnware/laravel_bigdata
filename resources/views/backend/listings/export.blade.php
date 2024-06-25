@extends('backend.layouts.main')
@section('content')
<x-alert />
<div class="d-flex flex-row justify-content-between">
    <div>
        <h4>Export Listings</h4>
    </div>
</div>
<div class="card card-bordered table-responsive mt-3 p-5 card-preview">
    <form method="POST" action="{{ route('listings.filter')}}">
        @csrf
        <div class="modal-body-md">
            <div class="row">
                <div class="col-md-12 mb-2">
                    <label class="form-label">Select Column Group</label>
                    <select class="form-select" id="column_group" data-placeholder="Select Columns Group">
                        <option disabled selected>Select Group</option>
                        @foreach($columnGroup as $group)
                        <option value="{{ $group->group_name }}">{{ $group->group_name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12 mb-2">
                    <label class="form-label">Select columns to export <span class="text-muted">(For all left blank)</span></label>
                    <select class="form-select" multiple="multiple" id="columns" data-placeholder="Select Columns" name="columnNames[]">
                        @foreach($columnNames as $column)
                        <option value="{{ $column }}" @if($column==='id' || $column==='name' ) selected @endif>{{ucwords( $column )}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label">Listing Name</label>
                    <input type="text" name="listing_name" id="listing_name" class="form-control" />
                </div>
                <!-- {{-- <div class="col-md-3 mb-2">
                        <label class="form-label">User</label>
                        <select class="form-select js-select2 select2-hidden-accessible" id="user_id" name='user_id' data-search="on" tabindex="-1" aria-hidden="true">
                            <option value="">Select Option</option>
                            @foreach ($dropdownData['users'] as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
                </select>
            </div> --}} -->
                <div class="col-md-4 mb-2">
                    <label class="form-label">Full Address</label>
                    <input type="text" name="full_address" id="full_address" class="form-control" />
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label">Postal Code</label>
                    <input name="postal_code" type="text" pattern="\d*" minlength="5" maxlength="5" placeholder="54321" id="postal_code" class="form-control" />
                </div>
                <!-- {{-- <div class="col-md-4 mb-2">
                        <label class="form-label">Type</label>
                        <input type="text" name="type" id="type" class="form-control" />
                    </div> --}} -->
                <div class="col-md-6 mb-2">
                    <label class="form-label">Category</label>
                    <select class="form-select" multiple="multiple" id="categories" data-placeholder="Select Category" name='categories[]'>
                        <option value="">Select Option</option>
                        @foreach ($dropdownData['categories'] as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                     <div class="col-md-6 mb-2">
                        <label class="form-label">Parent Category</label>
                        <select class="form-select" multiple="multiple" id="parent_categories" data-placeholder="Select Parent Category" name='parent_categories[]'>
                            <option value="">Select Option</option>
                            @foreach ($dropdownData['parent_categories'] as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label">Tag</label>
                    <select class="form-select" multiple="multiple" id="tags" data-placeholder="Select Tag" name='tags[]'>
                        <option value="">Select Option</option>
                        @foreach ($dropdownData['tags'] as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- {{-- <div class="col-md-3 mb-2">
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
        </div> --}} -->
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
                <button type="submit" class="btn btn-info">FILTER/EXPORT LISTINGS</button>
                <button type="button" class="btn ml-2 clear-filter btn-secondary">CLEAR</button>
            </div>
        </div>
    </form>
</div>
@push('custom-js')
<script>
    let columnGroup = {
        !!json_encode($columnGroup) !!
    };
    $(document).ready(function() {
        $("#column_group").on("change", function() {
            let group = $(this).val();
            let columnNames = '';
            columnGroup.forEach(function(column) {
                if (column.group_name === group) {
                    columnNames = column.column_names;
                }
            })
            let options = `<option disable>Select Columns</option><option value="id">id</option><option value="name">name</option>`;
            Object.keys(columnNames).forEach(key => {
                options += `<option value="${columnNames[key]}" selected>${columnNames[key]}</option>`;
            });
            $('#columns').empty();
            $('#columns').html(options);
        })
    });
</script>
@endpush
@endsection