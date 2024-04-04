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

<div class="card card-bordered mt-3 card-preview">
    <div class="p-5">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Field Name</th>
                    <th scope="col">Type</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fields as $key => $field)
                <tr>
                    <td scope="row">{{ ++$key }}</td>
                    <td scope="row">{{ $field->name }}</td>
                    <td scope="row">{{ $field->type }}</td>
                </tr>
                @empty
                <tr>
                    <td scope="row" colspan="3">No Data Found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@push('custom-js')

@endpush
@endsection