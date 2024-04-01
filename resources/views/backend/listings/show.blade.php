@extends('backend.layouts.main')
@section('content')
<x-alert />

<div class="card card-bordered mt-3 card-preview">
    <div class="p-5">
        <table class="table">
            <thead>
                <tr>
                    <td colspan="2" class="text-center"><h3>{{ $listing->name }}</h3></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>TAGS :</td>
                    <td>
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
                    <td>{{ strtoupper($key) }} :</td>
                    <td>@if($value){{ $value }}@else N/A @endif</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@push('custom-js')

@endpush
@endsection