@extends('backend.layouts.main')
@section('content')
<x-alert />

<div class="card card-bordered mt-3 card-preview">
    <div class="p-5">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">S. No.</th>
                    <th scope="col">User</th>
                    <th scope="col">Type</th>
                <th scope="col">Created On</th>
            </tr>
            </thead>
            <tbody>
                @forelse($logs as $key => $log)
                <tr>
                    <td scope="row">{{ ++$key }}</td>
                    <td scope="row">{{ $log->user->name }}</td>
                    <td scope="row">
                        @if($log->type == 0)
                        Import
                        @else
                        Export
                        @endif
                    </td>
                    <td scope="row">{{ $log->created_at }}</td>
                </tr>
                @empty
                <tr class="text-center">
                    <td class="row" colspan="4">No Data Available</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection