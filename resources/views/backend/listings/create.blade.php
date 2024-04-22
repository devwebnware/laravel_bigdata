@extends('backend.layouts.main')
@section('content')
<x-alert />
<div class="card card-bordered">
    <div class="card-inner">
        <div class="card-head">
            <h5 class="card-title">Listing Info</h5>
        </div>
        <form action="{{ route('listings.store') }}" method="POST">
            @csrf
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="form-group"><label class="form-label" for="name">Listing Name</label>
                        <div class="form-control-wrap"><input type="text" class="form-control" id="name" name='name'></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group"><label class="form-label" for="category_id">Category</label>
                        <select class="form-select js-select2 select2-hidden-accessible" id="category_id" name='category_id' data-search="on" data-select2-id="6" tabindex="-1" aria-hidden="true">
                            <option value="">Default Option</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group"><label class="form-label" for="tag_id">Tags</label>
                        <select class="form-select" multiple="multiple" id="tags" data-placeholder="Select Tags" name="tags[]">
                            <option value="">Select Tags</option>
                            @foreach($tags as $tag)
                            <option value="{{$tag->id}}">{{ucwords($tag->name)}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group"><button type="submit" class="btn btn-lg btn-primary">Save Informations</button></div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection