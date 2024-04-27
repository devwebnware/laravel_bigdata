@extends('backend.layouts.main')
@section('content')
<x-alert />
<div class="d-flex flex-row justify-content-between">
    <div>
        <h4>Edit Tag</h4>
    </div>
    <div>
        <a href="{{ route('tags.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
<div class="card card-bordered table-responsive mt-3 p-5 card-preview">
    <form action="{{ route('tags.update', $tag->id)}}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="form-group col-md-6">
                <label class="form-label" for="full-name"> Name <span style="color: red;">*</span></label>
                <div class="form-control-wrap">
                    <input type="text" class="form-control" value="{{ $tag->name }}" id="name" name='name' required>
                </div>
            </div>
            <div class="form-group col-md-2">
                <label class="form-label" for="full-name"> Background Color <span style="color: red;">*</span></label>
                <div class="form-control-wrap">
                    <input type="color" class="form-control" value="{{ $tag->bg_color }}" id="bg-color" name='bg_color' required>
                </div>
            </div>
            <div class="form-group col-md-2">
                <label class="form-label" for="full-name"> Text Color <span style="color: red;">*</span></label>
                <div class="form-control-wrap">
                    <input type="color" class="form-control" value="{{ $tag->color }}" id="color" name='color' required>
                </div>
            </div>
        </div>
        <div class="form-group"><button type="submit" class="btn btn-sm btn-primary">UPDATE TAG</button><a href="{{ route('tags.index') }}" class="btn ml-2 btn-sm btn-secondary">CANCEL</a></div>
    </form>
</div>
@endsection