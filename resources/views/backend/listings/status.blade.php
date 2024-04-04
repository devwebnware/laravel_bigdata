@extends('backend.layouts.main')
@section('content')
<x-alert />

<div class="card card-bordered mt-3 card-preview">
    <div class="p-5">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">File Name</th>
                    <th scope="col">Upload Time</th>
                    <th scope="col">Status</th>
                    <th scope="col">Remark</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row">1</td>
                    <td scope="row">Demo File</td>
                    <td scope="row">12/04/2024</td>
                    <td scope="row">Pending</td>
                    <td scope="row">N/A</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@push('custom-js')

@endpush
@endsection