@extends('backend.layouts.main')
@section('content')
<div class="nk-block-head">
    <div class="nk-block-head-content">
        <h4 class="title nk-block-title float-left mt-2">Add User</h4>
    </div>
    <div class="nk-block-des text-right">
        <a href="{{route('user.index')}}"><button class="btn btn-secondary"><em class="icon ni ni-arrow-left"></em>Back</button></a>
    </div>
</div>
<div id="passwordError"></div>
<div class="card card-bordered">
    <div class="card-inner">
        <form action="{{route('user.store')}}" id="form" method="post">
            @csrf
            <div class="row gy-3">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Name<span class="text-danger">*</span></label>
                        <div class="form-control-wrap">
                            <input type="text" data-msg="This field is required" class="form-control required" name="name" placeholder="Enter Full Name" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Email<span class="text-danger">*</span></label>
                        <div class="form-control-wrap">
                            <input type="email" data-msg="This field is required" class="form-control required" name="email" placeholder="Enter Email Address" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">New Password<span class="text-danger">*</span></label>
                        <div class="form-control-wrap">
                            <input type="password" data-msg="This field is required" class="form-control required" name="password" id="new_password" placeholder="Enter New Password" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Confirm Password<span class="text-danger">*</span></label>
                        <div class="form-control-wrap">
                            <input type="password" data-msg="This field is required" class="form-control required" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="form-label">Role<span class="text-danger">*</span></label>
                        <div class="form-control-wrap">
                            <select class="form-control required ri-select" data-placeholder="Select Roles" multiple="multiple" name="role[]" required>
                                @foreach($roles as $role)
                                <option value="{{$role->name}}">{{ucfirst($role->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <button id="submitBtn" class="btn btn-primary">Add User</button>
                </div>
            </div><!-- .row -->
        </form>
    </div><!-- .row -->
</div>
@endsection
@push('custom-js')
<script>
    $('#confirm_password').focus(function() {
        $('#passwordError').html(``)
    });
    $('#confirm_password').change(function(e) {
        var newPassword = $('#new_password').val();
        var confirmPassword = $('#confirm_password').val();
        if (newPassword != confirmPassword || newPassword == 'null') {
            e.preventDefault();
            $('#passwordError').html(`<p class="alert alert-danger mb-1">Confirm password doesn't match. Please check.</p>`)
        } else {
            $('#passwordError').html(``)
        }
    });
</script>
@endpush