@extends('backend.layouts.main')
@section('content')
<x-alert />
<div class="d-flex flex-row justify-content-between">
    <div>
        <h4>Create Custom Field</h4>
    </div>
    <div>
        <a href="{{ route('field.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>

<div class="card card-bordered table-responsive mt-3 p-5 card-preview">
    <form action="{{ route('field.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <label class="form-label">Name <span style="color: red;">*</span></label>
                <input type="text" placeholder="Enter field name" name="name" id="name" class="form-control" />
            </div>
            <div class="col-md-6">
                <label class="form-label">Type <span style="color: red;">*</span></label>
                <select class="form-select js-select2 select2-hidden-accessible" id="type" name='type' data-search="on" data-select2-id="6" tabindex="-1" aria-hidden="true">
                    <option selected disabled>Select Type</option>
                    @foreach($types as $type)
                    <option value="{{ strtolower($type) }}">{{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-sm btn-primary">SAVE FIELD</button><a href="{{ route('field.index') }}" class="btn ml-2 btn-sm btn-secondary">CANCEL</a>
            </div>
        </div>
    </form>
</div>
@push('custom-js')

@endpush
@endsection