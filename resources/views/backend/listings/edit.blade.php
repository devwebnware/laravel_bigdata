@extends('backend.layouts.main')
@section('content')
<x-alert />
<div class="card card-bordered h-100">
    <div class="card-inner">
        <div class="card-head">
            <h5 class="card-title">Listing - {{$listing->name}}</h5>
        </div>
        <form class="max-w-sm mx-auto" method="POST" action="{{ route('listings.update', $listing->id) }}">
            @csrf
            @method('patch')
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="category" style="margin-bottom: 10px;" class="form-label">CATEGORY</label>
                    <select class="form-select" name="categories" id="category" aria-label="Default select example">
                        <option value='' selected>Open this select menu</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if ($listing->category==$category->id) selected @endif>{{ $category->name}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 col-md-6" style="margin-bottom: 10px;">
                    <div class="form-group"><label class="form-label" for="tags">TAGS</label>
                        <select class="form-select" multiple="multiple" id="tags" data-placeholder="Select Tags" name="tags[]">
                            <option value="">Select Tags</option>
                            @foreach($tags as $tag)
                            <option value="{{$tag->id}}">{{ucwords($tag->name)}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @foreach($columnNames as $column)
                @if($column !== 'id' && $column !== 'created_at' && $column !== 'updated_at' && $column !== 'category')
                <div class="mb-3 col-md-6" style="margin-bottom: 10px;">
                    <div class="form-group"><label class="form-label" for="{{ $column }}">{{ strtoupper($column) }}</label>
                        <input type="text" id="{{ $column }}" name='{{ $column }}' value='{{$listing->$column}}' class="form-control" placeholder="Enter {{ $column }}" />
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection