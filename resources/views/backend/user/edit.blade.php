@extends('backend.layouts.main')
@section('content')
<div class="nk-block-head">
    <div class="nk-block-head-content">
        <h4 class="title nk-block-title float-left">Edit User</h4>
    </div>
    <div class="nk-block-des text-right">
        <a href="{{route('user.index')}}"><button class="btn btn-secondary"><em class="icon ni ni-arrow-left"></em>Back</button></a>
    </div>
</div>
<div id="passwordError"></div>
<div class="card card-bordered">
    <div class="card-inner">
        <form action="{{route('user.update',$user->id)}}" id="form" method="post">
            @csrf
            @method('patch')
            <div class="row gy-3">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Name<span class="text-danger">*</span></label>
                        <div class="form-control-wrap">
                            <input type="text" data-msg="This field is required" class="form-control required" name="name" placeholder="Enter Full Name" value="{{$user->name}}" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Email<span class="text-danger">*</span></label>
                        <div class="form-control-wrap">
                            <input type="email" data-msg="This field is required" class="form-control required" name="email" placeholder="Enter Email Address" value="{{$user->email}}" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">New Password<span class="text-danger">*</span></label>
                        <div class="form-control-wrap">
                            <input type="password" data-msg="This field is required" class="form-control required" name="password" id="new_password" placeholder="Enter New Password">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Confirm Password<span class="text-danger">*</span></label>
                        <div class="form-control-wrap">
                            <input type="password" data-msg="This field is required" class="form-control required" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <button id="submitBtn" class="btn btn-primary">Update User</button>
                </div>
            </div><!-- .row -->
        </form>
    </div><!-- .row -->
</div>
<div class="nk-block-head">
    <div class="nk-block-head-content">
        <div class="float-left">
            <h4 class="nk-block-title mt-3">Assigned Roles</h4>
        </div>
        <div class="nk-block-des text-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#assignRoleModal"><em class="icon ni ni-plus"></em>&nbsp Assign New Role</button>
        </div>
    </div>
</div>
<div class="card card-preview">
    <div class="card-inner">
        <table class="datatable-init nk-tb-list nk-tb-ulist col-12" data-auto-responsive="false">
            <thead>
                <tr class="nk-tb-item nk-tb-head">
                    <th class="nk-tb-col">#</th>
                    <th class="nk-tb-col"><span class="sub-text">Role</span></th>
                    <th class="nk-tb-col"><span class="sub-text">Action</span></th>
                </tr>
            </thead>
            <tbody>
                @forelse($user->roles->pluck('name') as $key=>$role)
                <tr class="nk-tb-item">
                    <td class="nk-tb-col">
                        {{$key+1}}
                    </td>
                    <td class="nk-tb-col">
                        {{ucfirst($role)}}
                    </td>
                    <td class="nk-tb-col nk-tb-col-tools">
                        <a href="javascript: void(0);" onclick="revokeRole('{{$user->id}}','{{$role}}')">
                            <h5 class="icon ni ni-trash"></h5>
                        </a>
                    </td>
                </tr>
                <!-- .nk-tb-item  -->
                @empty
                <tr class="nk-tb-item">
                    <td colspan="4" class="text-center p-2">No Records Found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div><!-- .card-preview -->


<!-- Modal -->
<div class="modal fade" id="assignRoleModal" role="dialog" aria-labelledby="assignRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignRoleModalLabel">Assign New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('user.assignrole')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <label class="form-label">Role<span class="text-danger">*</span></label>
                            <div class="form-control-wrap">
                                <select class="form-control required ri-select" name="role" required>
                                    <option selected disabled>Assign Role</option>
                                    @foreach($roles as $role)
                                    <option value="{{$role->name}}">{{ucfirst($role->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Assign Role</button>
                </div>
            </form>
        </div>
    </div>
</div>
<form id="delete_form" style="display:none" method="post">
    @csrf
    <input type="hidden" name="id" class="id">
    <input type="hidden" name="role" class="role">
</form>
@endsection
@push('custom-js')
<script>
    function revokeRole(userId, userRole) {
        event.preventDefault();
        $('.id').val(userId);
        $('.role').val(userRole);
        var base_url = "{{ url('/') }}"
        if (confirm('Do you really want to revoke ' + userRole + ' role ?')) {
            var deleteForm = $('#delete_form');
            deleteForm.attr('action', base_url + "/user/revoke-role");
            deleteForm.submit();
        }
    }
</script>
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