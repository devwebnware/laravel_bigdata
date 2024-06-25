@extends('backend.layouts.main')
@section('content')
<x-alert />
<div class="d-flex flex-row">
    <div class="ml-auto">
        <a href="{{ route('categories.create')}}" class='btn btn-info mr-auto'>Add Category</a>
    </div>
</div>
<div class="card card-bordered mt-3 card-preview">
    <div class="p-5">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">S. No.</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Listings Count</th>
                    <th scope="col">last Updated On</th>
                    <th scope="col">Created By</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $key => $category)
                <tr>
                    <td scope="row">{{ ++$key }}</td>
                    <td scope="row">{{ $category->name }}</td>
                    <td scope="row">{{ count($category->listings) }}</td>
                    <td scope="row">{{ $category->updated_at }}</td>
                    <td scope="row">{{ $category->user->name }}</td>
                    <td scope="row">
                    <a href="{{ route('categories.edit', ['category' => $category->id]) }}"><em style="font-size: 20px;" class="icon ni ni-edit"></em></a>
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