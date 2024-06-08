@extends('backend.layouts.main')
@section('content')
<x-alert />
<div class="d-flex flex-row justify-content-between">
    <div>
        <h4>Create Parent Category</h4>
    </div>
    <div>
        <a href="{{ route('parent.categories.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
<div class="card card-bordered table-responsive mt-3 p-5 card-preview">
    <form action="{{ route('parent.category.store') }}" method="POST">
        @csrf
        <div class="form-group w-50">
            <label class="form-label" for="full-name">Name <span style="color: red;">*</span></label>
            <div class="form-control-wrap">
                <input type="text" placeholder="Enter category name" class="form-control" id="name" name='name' required>
            </div>
        </div>
        <div class="form-group"><button type="submit" class="btn btn-sm btn-primary">SAVE</button><a href="{{ route('categories.index') }}" class="btn ml-2 btn-sm btn-secondary">CANCEL</a></div>
    </form>
</div>
@endsection