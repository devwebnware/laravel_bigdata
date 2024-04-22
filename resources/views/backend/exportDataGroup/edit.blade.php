@extends('backend.layouts.main')
@section('content')
<x-alert />
<div class="card card-bordered h-100">
    <div class="card-inner">
        <div class="card-head">
            <h5 class="card-title">Update Group</h5>
        </div>
        <form action="{{ route('listing.export.group.update', ['id' => $dataGroup->id]) }}" method="POST">
            @csrf
            @method('patch')
            <div class="row">
            <div class="col-lg-6">
            <div class="form-group">
                <label class="form-label" for="full-name">Group Name <span style="color: red">*</span></label>
                <div class="form-control-wrap">
                    <input placeholder="Group Name" type="text" value='{{ $dataGroup->group_name }}' class="form-control" id="name" name='name'>
                </div>
            </div>
        </div>
            <div class="col-lg-6">
                <div class="form-group"><label class="form-label" for="column_names">Columns <span style="color: red">*</span></span></label>
                    <select class="form-select" multiple="multiple" id="column_names" data-placeholder="Select Columns" name="column_names[]">
                        <option value="">Select Cloumns</option>
                        @foreach($ColumnNames as $Column)
                        <option value="{{$Column}}" @if(in_array($Column, $dataGroup->column_names)) selected @endif)>{{ucwords($Column)}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
            <div class="form-group mt-3"><button type="submit" class="btn btn-primary">Update Group</button></div>
        </form>
    </div>
</div>
@endsection