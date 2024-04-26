<!-- // ** If changes were made here then make sure to update (backend.listings.filter) view -->

@extends('backend.layouts.main')
@section('content')
<x-alert />
<div class="d-flex flex-row">
    @if(Route::currentRouteName() == 'listings.index')
    <a href="{{ route('listings.data.import')}}" class='btn btn-secondary mr-2'>IMPORT</a>
    <a href="{{ route('listings.data.handel.export')}}" class='btn btn-secondary mr-2'>EXPORT</a>
    {{-- <a href="{{ route('listings.create')}}" class='btn btn-info mr-auto text-decoration-none'>ADD LISTING</a> --}}
    @endif
    @if(Route::currentRouteName() == 'listings.filter')
    <form action="{{ route('listings.export.filtered') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-secondary mr-2">EXPORT FILRERED DATA</button>
    </form>
    @endif
    <!-- Filter Modal trigger button -->
    <button data-toggle="modal" class="btn ml-auto btn-info" data-target="#filterModal"><em class="icon ni ni-filter"></em><span>FILTER RECORDS</span></button>
</div>
<!-- Start Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="markPaid" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('listings.filter')}}" id="filterForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Filter</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
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
                                @foreach($dropdownColumnNames as $column)
                                <option value="{{ $column }}" @if($column==='id' || $column==='name' ) selected @endif>{{ucwords( $column )}} </option>
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
    </div>
    <div class="modal-footer">
        <div class="mt-2">
            <button type="submit" class="btn btn-info">Filter Listings</button>
            <button type="button" class="btn clear-filter btn-secondary">Clear</button>
        </div>
    </div>
    </form>
</div>
</div>
</div>
<!-- End Filter Modal -->

<div class="card card-bordered table-responsive mt-3 card-preview">
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">ACTION</th>
                <th scope="col">TAGS</th>
                @foreach($ColumnNames as $column)
                @if($column !== 'id')
                <th scope="col">{{ strtoupper($column) }}</th>
                @endif
                @endforeach
            </tr>
        </thead>
        <tbody>
            @php
            $serialNumber = ($listings->currentPage() - 1) * $listings->perPage() + 1;
            @endphp
            @forelse($listings as $key => $listing)
            <tr>
                <td scope="row">{{ substr($serialNumber++,0, 20) }}</td>
                <td scope="row">
                    <div class="drodown">
                        <a href="javascript:void(0)" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="link-list-opt">
                                <li><a href="{{ route('listings.edit', ['id' => $listing->id]) }}"><em style="font-size: 20px;" class="icon ni ni-edit"></em>Edit</a></li>
                                <li><a href="#" onclick='deleteRequest("{{$listing->name}}","{{$listing->id}}")'><em class="icon ni ni-trash"></em>Delete</a></li>
                                <li><a href="{{ route('listings.show', ['id' => $listing->id]) }}"><em class="icon ni ni-eye"></em>Show</a></li>
                            </ul>
                        </div>
                    </div>
                </td>
                <td>
                    @forelse($listing->listingTags as $tag)
                    <span class="badge rounded-pill" style="background-color: {{ $tag->bg_color ?? 'default_color' }}; color: {{ $tag->color ?? 'color' }} ">
                        {{ substr($tag->name, 0, 20) }}
                    </span>
                    @empty
                    No tags assigned
                    @endforelse
                </td>
                @foreach($listing->getAttributes() as $key => $attribute)
                @if($key !== 'id')
                <td scope="row">
                    @if($attribute)
                    {{ substr($attribute, 0, 20) }}
                    @else
                    N/A
                    @endif
                </td>
                @endif
                @endforeach
            </tr>
            @empty
            <tr class="text-center">
                <td colspan="{{ count($ColumnNames) }}">No Data Available</td>
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
    // Form submittion for listing delete
    function deleteRequest(name, listing) {
        event.preventDefault();
        if (confirm('Do you really want to delete ' + '"' + name + '"' + " listing ?")) {
            $('#delete_form').attr('action', `/listings/${listing}/delete`);
            $('#delete_form').submit();
        }
    }

    // Clear filter
    $('.clear-filter').click(function() {
        $('.form-control, .form-select').val('').trigger('change');
    });

    document.getElementById('filterForm').addEventListener('submit', function(event) {
        var inputs = this.getElementsByTagName('input');
        var isAnyFieldFilled = false;

        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].value.trim() !== '') {
                isAnyFieldFilled = true;
                break;
            }
        }

        if (!isAnyFieldFilled) {
            alert('Please fill at least one input field');
            event.preventDefault(); // Prevent form submission
        }
    });
</script>
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