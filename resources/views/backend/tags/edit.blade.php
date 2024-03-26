@extends('backend.layouts.main')
@section('content')
<div class="card card-bordered h-100">
    <div class="card-inner">
        <div class="card-head">
            <h5 class="card-title">Tag Info</h5>
        </div>
        <form action="{{ route('tags.update', $tag->id)}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label class="form-label" for="full-name">Tag Name</label>
                <div class="form-control-wrap">
                    <input type="text" class="form-control" value='{{$tag->name}}' id="name" name='name'>
                </div>
            </div>
            <div class="form-group"><button type="submit" class="btn btn-lg btn-primary">Update Informations</button></div>
        </form>
    </div>
</div>
@endsection