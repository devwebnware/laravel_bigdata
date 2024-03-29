<!-- // ** If changes were made here then make sure to update (backend.listings.filter) view -->

@extends('backend.layouts.main')
@section('content')
<x-alert />
<div class="d-flex flex-row">
    <a href="{{ route('listings.data.import')}}" class='btn btn-secondary mr-2'>Import</a>
    <a href="{{ route('listings.data.export')}}" class='btn btn-secondary mr-2'>Export</a>
    <!-- Filter Modal trigger button -->
    <button data-toggle="modal" class="btn btn-info" data-target="#filterModal"><em class="icon ni ni-filter"></em><span>Filter Records</span></button>
    <div class="ml-auto">
        <a href="{{ route('listings.create')}}" class='btn btn-info mr-auto text-decoration-none'>Add Listing</a>
    </div>
</div>
<!-- Start Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="markPaid" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('listings.filter')}}">
                @csrf
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Filter</h5>
                </div>
                <div class="modal-body-md">
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
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Full Address</label>
                            <input type="text" name="full_address" id="full_address" class="form-control" />
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">City</label>
                            <input type="text" name="city" id="city" class="form-control" />
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" />
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" />
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Query</label>
                            <input type="text" name="query" id="query" class="form-control" />
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Type</label>
                            <input type="text" name="type" id="type" class="form-control" />
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Postal Code</label>
                            <input name="postal_code" type="text" pattern="\d*" minlength="5" maxlength="5" placeholder="54321" id="postal_code" class="form-control" />
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">US State</label>
                            <input type="text" name="us_state" id="us_state" class="form-control" />
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Country</label>
                            <input type="text" name="country" id="country" class="form-control" />
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
    <table class="table table-tranx w-auto">
        <thead> 
            <tr class="tb-tnx-head">
                <th class="w-50 tb-tnx-info">#</th>
                @foreach($columnNames as $column)
                @if($column !== 'id' && $column !== 'created_by' && $column !== 'created_at' && $column !== 'updated_at')
                <th class="tb-tnx-info">{{ $column }}</th>
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
                <td class="w-50">{{ substr($serialNumber++,0, 20) }}</td>
                <!-- <td>{{ substr($listing->id,0, 20) }}</td> -->
                <td>{{ substr($listing->name,0, 20) }}</td>
                <td>{{ substr($listing->category->name,0, 20) }}</td>
                <td>
                    <span class="badge rounded-pill" style="background-color: {{ $listing->tag->bg_color ?? 'default_color' }}; color: {{ $listing->tag->color ?? 'color' }} ">
                        {{ substr($listing->tag->name, 0, 20) }}
                    </span>
                </td>
                <td>{{ substr($listing->tag->name,0, 20) }}</td>
                <!-- <td>{{ substr($listing->user->name,0, 20) }}</td> -->
                <!-- <td>{{ substr($listing->created_at,0, 20) }}</td> -->
                <!-- <td>{{ substr($listing->updated_at,0, 20) }}</td> -->
                <td>{{ substr($listing->query,0, 20) }}</td>
                <td>{{ substr($listing->site,0, 20) }}</td>
                <td>{{ substr($listing->type,0, 20) }}</td>
                <td>{{ substr($listing->subtypes,0, 20) }}</td>
                <td>{{ substr($listing->phone,0, 20) }}</td>
                <td>{{ substr($listing->full_address,0, 20) }}</td>
                <td>@if(isset($listing->borough))
                    {{ substr($listing->borough,0, 20)}}
                    @else
                    N/A
                    @endif
                </td>
                <td>@if(isset($listing->street))
                    {{ substr($listing->street,0, 20) }}
                    @else
                    N/A
                    @endif
                </td>
                <td>{{ substr($listing->city,0, 20) }}</td>
                <td>{{ substr($listing->postal_code,0, 20) }}</td>
                <td>{{ substr($listing->state,0, 20) }}</td>
                <td>{{ substr($listing->us_state,0, 20) }}</td>
                <td>{{ substr($listing->country,0, 20) }}</td>
                <td>{{ substr($listing->country_code,0, 20) }}</td>
                <td>{{ substr($listing->latitude,0, 20) }}</td>
                <td>{{ substr($listing->longitude,0, 20) }}</td>
                <td>{{ substr($listing->time_zone,0, 20) }}</td>
                <td>{{ substr($listing->plus_code,0, 20) }}</td>
                <td>{{ substr($listing->area_service,0, 20) }}</td>
                <td>{{ substr($listing->rating,0, 20) }}</td>
                <td>{{ substr($listing->reviews,0, 20) }}</td>
                <td>{{ substr($listing->reviews_link,0, 20) }}</td>
                <td>{{ substr($listing->reviews_per_score,0, 20) }}</td>
                <td>{{ substr($listing->reviews_per_score_1,0, 20) }}</td>
                <td>{{ substr($listing->reviews_per_score_2,0, 20) }}</td>
                <td>{{ substr($listing->reviews_per_score_3,0, 20) }}</td>
                <td>{{ substr($listing->reviews_per_score_4,0, 20) }}</td>
                <td>{{ substr($listing->reviews_per_score_5,0, 20) }}</td>
                <td>{{ substr($listing->photos_count,0, 20) }}</td>
                <td>{{ substr($listing->photo,0, 20) }}</td>
                <td>{{ substr($listing->street_view,0, 20) }}</td>
                <td>{{ substr($listing->located_in,0, 20) }}</td>
                <td>{{ substr($listing->working_hours,0, 20) }}</td>
                <td>{{ substr($listing->working_hours_old_format,0, 20) }}</td>
                <td>{{ substr($listing->other_hours,0, 20) }}</td>
                <td>{{ substr($listing->popular_times,0, 20) }}</td>
                <td>{{ substr($listing->business_status,0, 20) }}</td>
                <td>{{ substr($listing->about,0, 20) }}</td>
                <td>{{ substr($listing->range,0, 20) }}</td>
                <td>{{ substr($listing->posts,0, 20) }}</td>
                <td>{{ substr($listing->logo,0, 20) }}</td>
                <td>{{ substr($listing->description,0, 20) }}</td>
                <td>{{ substr($listing->verified,0, 20) }}</td>
                <td>{{ substr($listing->owner_id,0, 20) }}</td>
                <td>{{ substr($listing->owner_title,0, 20) }}</td>
                <td>{{ substr($listing->owner_link,0, 20) }}</td>
                <td>{{ substr($listing->reservation_links,0, 20) }}</td>
                <td>{{ substr($listing->booking_appointment_link,0, 20) }}</td>
                <td>{{ substr($listing->menu_link,0, 20) }}</td>
                <td>{{ substr($listing->order_links,0, 20) }}</td>
                <td>{{ substr($listing->location_link,0, 20) }}</td>
                <td>{{ substr($listing->place_id,0, 20) }}</td>
                <td>{{ substr($listing->google_id,0, 20) }}</td>
                <td>{{ substr($listing->cid,0, 20) }}</td>
                <td>{{ substr($listing->reviews_id,0, 20) }}</td>
                <td>{{ substr($listing->located_google_id,0, 20) }}</td>
                <td>{{ substr($listing->email_1,0, 20) }}</td>
                <td>{{ substr($listing->email_1_full_name,0, 20) }}</td>
                <td>{{ substr($listing->email_1_title,0, 20) }}</td>
                <td>{{ substr($listing->email_2,0, 20) }}</td>
                <td>{{ substr($listing->email_2_full_name,0, 20) }}</td>
                <td>{{ substr($listing->email_2_title,0, 20) }}</td>
                <td>{{ substr($listing->email_3,0, 20) }}</td>
                <td>{{ substr($listing->email_3_full_name,0, 20) }}</td>
                <td>{{ substr($listing->email_3_title,0, 20) }}</td>
                <td>{{ substr($listing->phone_1,0, 20) }}</td>
                <td>{{ substr($listing->phone_2,0, 20) }}</td>
                <td>{{ substr($listing->phone_3,0, 20) }}</td>
                <td>{{ substr($listing->facebook,0, 20) }}</td>
                <td>{{ substr($listing->instagram,0, 20) }}</td>
                <td>{{ substr($listing->linkedin,0, 20) }}</td>
                <td>{{ substr($listing->medium,0, 20) }}</td>
                <td>{{ substr($listing->reddit,0, 20) }}</td>
                <td>{{ substr($listing->skype,0, 20) }}</td>
                <td>{{ substr($listing->snapchat,0, 20) }}</td>
                <td>{{ substr($listing->telegram,0, 20) }}</td>
                <td>{{ substr($listing->whatsapp,0, 20) }}</td>
                <td>{{ substr($listing->twitter,0, 20) }}</td>
                <td>{{ substr($listing->vimeo,0, 20) }}</td>
                <td>{{ substr($listing->youtube,0, 20) }}</td>
                <td>{{ substr($listing->github,0, 20) }}</td>
                <td>{{ substr($listing->crunchbase,0, 20) }}</td>
                <td>{{ substr($listing->website_title,0, 20) }}</td>
                <td>{{ substr($listing->website_generator,0, 20) }}</td>
                <td>{{ substr($listing->website_description,0, 20) }}</td>
                <td>{{ substr($listing->website_keywords,0, 20) }}</td>
                <td>{{ substr($listing->website_has_fb_pixel,0, 20) }}</td>
                <td>{{ substr($listing->website_has_google_tag,0, 20) }}</td>
                <td class="nk-tb-col text-center nk-tb-col-tools">
                    <a href="{{ route('listings.edit', ['listing' => $listing->id]) }}"><em style="font-size: 20px;" class="icon ni ni-edit"></em></a>
                    <a class="ml-2" href="#" onclick="deleteRequest('{{$listing->name}}','{{$listing->id}}')"><em style="font-size: 20px; color: red;" class="icon ni ni-trash"></em></em></a>
                </td>
            </tr>
            @empty
            <tr class="text-center">
                <td colspan="95">No Data Available</td>
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