@extends('backend.layouts.main')
@section('content')
<div class="card card-bordered h-100">
    <div class="card-inner">
        <div class="card-head">
            <h5 class="card-title">Tag Info</h5>
        </div>
        <form class="max-w-sm mx-auto" method="POST" action="{{ route('listings.update', $listing->id) }}">
            @csrf
            @method('patch')
            <div class="row">
                <div class="mb-3 col-md-12" style="margin-bottom: 10px;">
                    <label for="name" style="margin-bottom: 10px;" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tag Name</label>
                    <input type="text" id="name" name='name' value='{{$listing->name}}' class="form-control" placeholder="Enter category name" required />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="category" style="margin-bottom: 10px;" class="form-label">Category</label>
                    <select class="form-select" name="category_id" id="category" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if ($listing->tag_id==$category->id) selected @endif>{{ $category->name}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 col-md-6" style="margin-bottom: 10px;">
                    <label for="tag" style="margin-bottom: 10px;" class="form-label">Tag</label>
                    <select class="form-select" name="tag_id" id="tag" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" @if ($listing->tag_id==$tag->id) selected @endif>{{ $tag->name}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection