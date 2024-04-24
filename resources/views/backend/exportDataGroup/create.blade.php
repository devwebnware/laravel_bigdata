@extends('backend.layouts.main')
@section('content')
<x-alert />
<div class="d-flex flex-row justify-content-between">
    <div>
        <h4>Create Column Group</h4>
    </div>
    <div>
        <a href="{{ route('listing.export.group.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
<div class="card card-bordered table-responsive mt-3 p-5 card-preview">
    <form action="{{ route('listing.export.group.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-label" for="full-name">Group Name <span style="color: red">*</span></label>
                    <div class="form-control-wrap">
                        <input placeholder="Group Name" type="text" class="form-control" id="name" name='name' required>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group"><label class="form-label" for="column_names">Columns <span style="color: red">*</span></label>
                    <select class="form-select" multiple="multiple" id="column_names" data-placeholder="Select Columns" name="column_names[]" required>
                        <option value="">Select Cloumns</option>
                        @foreach($ColumnNames as $Column)
                        <option value="{{$Column}}" @if($Column==='id' || $Column==='name' ) selected @endif>{{ucwords($Column)}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group mt-3"><button type="submit" class="btn btn-sm btn-primary">SAVE GROUP</button><a href="{{ route('listing.export.group.index') }}" class="btn ml-2 btn-sm btn-secondary">CANCEL</a></div>
    </form>
</div>
@endsection