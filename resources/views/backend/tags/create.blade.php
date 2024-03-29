@extends('backend.layouts.main')
@section('content')
<div class="card card-bordered h-100">
    <div class="card-inner">
        <div class="card-head">
            <h5 class="card-title">Tag Info</h5>
        </div>
        <form action="{{ route('tags.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <label class="form-label" for="full-name">Tag Name</label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control" id="name" name='name'>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <label class="form-label" for="full-name">Background Color</label>
                    <div class="form-control-wrap">
                        <input type="color" class="form-control" id="bg-color" name='bg_color'>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <label class="form-label" for="full-name">Text Color</label>
                    <div class="form-control-wrap">
                        <input type="color" class="form-control" id="color" name='color'>
                    </div>
                </div>
            </div>
            <div class="form-group"><button type="submit" class="btn btn-lg btn-primary">Save Informations</button></div>
        </form>
    </div>
</div>
@endsection