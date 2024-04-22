@extends('backend.layouts.main')
@section('content')
<x-alert />
<div class="card card-bordered h-100">
    <div class="card-inner">
        <div class="card-head">
            <h5 class="card-title">Tag Info</h5>
        </div>
        <form action="{{ route('tags.update', $tag->id)}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="form-group col-md-6">
                    <label class="form-label" for="full-name">Tag Name</label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control" value="{{ $tag->name }}" id="name" name='name'>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <label class="form-label" for="full-name">Background Color</label>
                    <div class="form-control-wrap">
                        <input type="color" class="form-control" value="{{ $tag->bg_color }}" id="bg-color" name='bg_color'>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <label class="form-label" for="full-name">Text Color</label>
                    <div class="form-control-wrap">
                        <input type="color" class="form-control" value="{{ $tag->color }}" id="color" name='color'>
                    </div>
                </div>
            </div>
            <div class="form-group"><button type="submit" class="btn btn-lg btn-primary">Update Informations</button></div>
        </form>
    </div>
</div>
@endsection