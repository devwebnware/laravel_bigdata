@extends('backend.layouts.main')
@section('content')
<div class="card card-bordered h-100">
    <div class="card-inner">
        <div class="card-head">
            <h5 class="card-title">Import Info</h5>
        </div>
        <form method="POST" action="{{ route('listings.data.handel.import') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name">Select file</label>
                <input type="file" id="file" name='data' required />
            </div>
            <button type="submit" class="btn btn-primary" class="btn btn-success">Upload</button>
        </form>
    </div>
</div>
@endsection