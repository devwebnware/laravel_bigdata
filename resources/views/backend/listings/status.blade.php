@extends('backend.layouts.main')
@section('content')
<x-alert />

<div class="card card-bordered mt-3 table-responsive card-preview">
    <div class="p-5">
        <h4>In Progress Jobs</h4>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">QUEUE</th>
                    <th scope="col">ATTEMPTS</th>
                    <th scope="col">RESERVED AT</th>
                    <th scope="col">AVAILABLE AT</th>
                    <th scope="col">CREATED AT</th>
                </tr>
            </thead>
            <tbody>
                @php $count=1; @endphp
                @forelse($jobs as $job) 
                <tr>
                    <td scope="row">{{ $count++ }}</td>
                    <td scope="row">{{ $job->id }}</td>
                    <td scope="row">{{ $job->queue }}</td>
                    <td scope="row">{{ $job->attempts }}</td>
                    <td scope="row">{{ $job->reserved_at }}</td>
                    <td scope="row">{{ $job->available_at }}</td>
                    <td scope="row">{{ $job->created_at }}</td>
                </tr>
                @empty
                <tr class="text-center">
                    <td scope="row" colspan="6">No Data Available</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-5">
        <h4>Failed Jobs</h4>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">EXCEPTION</th>
                    <th scope="col">FAILED AT</th>
                </tr>
            </thead>
            <tbody>
                @php $count=1; @endphp
                @forelse($failedJobs as $job) 
                <tr>
                    <td scope="row">{{ $count++ }}</td>
                    <td scope="row">{{ $job->id }}</td>
                    <td scope="row">{{ substr($job->exception, 0, 100) }}</td>
                    <td scope="row">{{ $job->failed_at }}</td>
                </tr>
                @empty
                <tr class="text-center">
                    <td scope="row" colspan="4">No Data Available</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@push('custom-js')

@endpush
@endsection