@extends('backend.layouts.main')
@section('content')
<x-alert />

<div class="d-flex flex-row justify-content-between">
    <div>
        <h4>Import Report</h4>
    </div>
</div>
<div class="card card-bordered table-responsive mt-3 p-5 card-preview">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">S. No.</th>
                <th scope="col">File Name</th>
                <th scope="col">Matched Records</th>
                <th scope="col">New Records</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reports as $key => $report)
            <tr>
                <td scope="row">{{ ++$key }}</td>
                <td scope="row">{{ $report->file_name }}</td>
                <td scope="row">{{ $report->matched_records }}</td>
                <td scope="row">{{ $report->new_records }}</td>
            </tr>
            @empty
            <tr class="text-center">
                <td class="row" colspan="4">No Data Available</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection