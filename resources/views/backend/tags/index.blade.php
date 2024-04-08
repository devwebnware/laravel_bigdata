@extends('backend.layouts.main')
@section('content')
<x-alert />
<div class="d-flex flex-row">
    <div class="ml-auto">
        <a href="{{ route('tags.create')}}" class='btn btn-info mr-auto'>Add Tag</a>
    </div>
</div>
<div class="card card-bordered mt-3 card-preview">
    <div class="p-5">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">S. No.</th>
                    <th scope="col">Tag Name</th>
                    <th scope="col">last Updated On</th>
                    <th scope="col">Created By</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tags as $key => $tag)
                <tr>
                    <td scope="row">{{ ++$key }}</td>
                    <td scope="row">{{ $tag->name }}</td>
                    <td scope="row">{{ $tag->updated_at }}</td>
                    <td scope="row">{{ $tag->user->name }}</td>
                    <td scope="row">
                    <a href="{{ route('tags.edit', ['tag' => $tag->id]) }}"><em style="font-size: 20px;" class="icon ni ni-edit"></em></a>
                    </td>
                </tr>
                @empty
                <tr class="text-center">
                    <td scope="row" colspan="5">No Data Available</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection