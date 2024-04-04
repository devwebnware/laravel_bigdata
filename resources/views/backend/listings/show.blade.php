@extends('backend.layouts.main')
@section('content')
<x-alert />

<div class="card card-bordered mt-3 card-preview">
    <div class="p-5">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" colspan="2" class="text-center"><h3 style="color: white">{{ $listing->name }}</h3></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row">TAGS :</td>
                    <td scope="row">
                    @forelse($listing->listingTags as $tag)
                    <span class="badge rounded-pill" style="background-color: {{ $tag->tagName->bg_color ?? 'default_color' }}; color: {{ $tag->tagName->color ?? 'color' }} ">
                        {{ substr($tag->tagName->name, 0, 20) }}
                    </span>
                    @empty
                    N/A
                    @endforelse
                    </td>
                </tr>
                @foreach($listing->getAttributes() as $key => $value)
                <tr>
                    <td scope="row">{{ strtoupper($key) }} :</td>
                    <td scope="row">@if($value){{ $value }}@else N/A @endif</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@push('custom-js')

@endpush
@endsection