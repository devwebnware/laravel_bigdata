@extends('backend.layouts.main')
@section('content')
<x-alert />
<div class="d-flex flex-row justify-content-between">
    <div>
        <h4>Custom Field</h4>
    </div>
    <div>
        <a href="{{ route('field.create') }}" class="btn btn-secondary">Add Custom Field</a>
    </div>
</div>

<div class="card card-bordered table-responsive mt-3 card-preview">
    <table class="table table-tranx w-auto">
        <thead>
            <tr class="tb-tnx-head">
                <th>#</th>
                <th>Field Name</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            @forelse($fields as $key => $field)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $field->name }}</td>
                <td>{{ $field->type }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3">No Data Found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@push('custom-js')

@endpush
@endsection