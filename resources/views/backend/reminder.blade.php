@extends('backend.layouts.main')
@php
$durations = ['15','30','45','60','75','90','105','120'];
$mediums = ['Email','Call','Whatsapp','LinkedIn','Social Media','Meeting'];
@endphp
@section('content')
<div class="nk-block-head">
    <div class="nk-block-head-content">
        <h4 class="nk-block-title">Reminders</h4>
    </div>
</div>

<div class="card card-preview">
    <div class="card-inner">
        <ul class="nav nav-tabs mt-n3">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tabItem1"><em class="icon ni ni-check-circle-cut d-none d-md-block"></em><span>Upcoming</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabItem2"><em class="icon ni ni-alert d-none d-md-block"></em><span>Missed</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabItem3"><em class="icon ni ni-check-circle-cut d-none d-md-block"></em><span>Completed</span></a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tabItem1">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="nk-block nk-block-lg">
                            <!-- content @s -->
                            <div class="card card-preview">
                                <div class="card-inner">
                                    <table class="datatable-init nowrap nk-tb-list nk-tb-ulist reminders-table" data-auto-responsive="false">
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head">
                                                <th class="nk-tb-col"><span class="sub-text">#</span></th>
                                                <th class="nk-tb-col"><span class="sub-text">Reminder</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Date</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Action</span></th>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $key = 0; @endphp
                                            @foreach($todayReminders as $reminder)
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col">
                                                    {{$key+1}}
                                                </td>
                                                <td class="nk-tb-col">
                                                    <div class="user-card">
                                                        <div class="user-info">
                                                            @if($reminder->connection_id)
                                                            <b>Connection: {{$reminder->connection->name}}</b> follow up reminder is scheduled at {{date('H:i A',strtotime($reminder->time))}}.
                                                            @endif
                                                            @if($reminder->lead_id)
                                                            <b>Lead: {{$reminder->lead->company_name}}</b> follow up reminder is scheduled at {{date('H:i A',strtotime($reminder->time))}}.
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg">
                                                    <span>{{date('d F Y',strtotime($reminder->date))}}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg reminder-badge">
                                                    <span class="badge badge-dim badge-success">Today</span>
                                                    @if($reminder->completed_at)
                                                    <span class="badge badge-dim badge-success">Completed</span>
                                                    @endif
                                                </td>
                                                <td class="nk-tb-col nk-tb-col-tools">
                                                    @if(!$reminder->completed_at)
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0)" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt">
                                                                <li>
                                                                    <a href="javascript:void(0)" class="mark-complete" data-id="{{$reminder->id}}" @if($reminder->lead) data-type="lead" data-type_id ="{{$reminder->lead_id}}" @else data-type="connection" data-type_id ="{{$reminder->connection_id}}" @endif><em class="icon ni ni-check-circle-cut"></em></span>Mark Completed</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </td>
                                            </tr><!-- .nk-tb-item  -->
                                            @php $key++; @endphp
                                            @endforeach
                                            @foreach($tommorrowReminders as $reminder)
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col">
                                                    {{$key+1}}
                                                </td>
                                                <td class="nk-tb-col">
                                                    <div class="user-card">
                                                        <div class="user-info">
                                                            @if($reminder->connection_id)
                                                            <b>Connection: {{$reminder->connection->name}}</b> follow up reminder is scheduled at {{date('H:i A',strtotime($reminder->time))}}.
                                                            @endif
                                                            @if($reminder->lead_id)
                                                            <b>Lead: {{$reminder->lead->company_name}}</b> follow up reminder is scheduled at {{date('H:i A',strtotime($reminder->time))}}.
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg">
                                                    <span>{{date('d F Y',strtotime($reminder->date))}}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg reminder-badge">
                                                    <span class="badge badge-dim badge-warning">Tommorrow</span>
                                                    @if($reminder->completed_at)
                                                    <span class="badge badge-dim badge-success">Completed</span>
                                                    @endif
                                                </td>
                                                <td class="nk-tb-col nk-tb-col-tools">
                                                    @if(!$reminder->completed_at)
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0)" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt">
                                                                <li>
                                                                    <a href="javascript:void(0)" class="mark-complete" data-id="{{$reminder->id}}" @if($reminder->lead) data-type="lead" data-type_id ="{{$reminder->lead_id}}" @else data-type="connection" data-type_id ="{{$reminder->connection_id}}" @endif><em class="icon ni ni-check-circle-cut"></em></span>Mark Completed</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </td>
                                            </tr><!-- .nk-tb-item  -->
                                            @php $key++; @endphp
                                            @endforeach
                                            @foreach($currentWeekReminders as $reminder)
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col">
                                                    {{$key+1}}
                                                </td>
                                                <td class="nk-tb-col">
                                                    <div class="user-card">
                                                        <div class="user-info">
                                                            @if($reminder->connection_id)
                                                            <b>Connection: {{$reminder->connection->name}}</b> follow up reminder is scheduled at {{date('H:i A',strtotime($reminder->time))}}.
                                                            @endif
                                                            @if($reminder->lead_id)
                                                            <b>Lead: {{$reminder->lead->company_name}}</b> follow up reminder is scheduled at {{date('H:i A',strtotime($reminder->time))}}.
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg">
                                                    <span>{{date('d F Y',strtotime($reminder->date))}}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg reminder-badge">
                                                    <span class="badge badge-dim badge-primary">Current Week</span>
                                                    @if($reminder->completed_at)
                                                    <span class="badge badge-dim badge-success">Completed</span>
                                                    @endif
                                                </td>
                                                <td class="nk-tb-col nk-tb-col-tools">
                                                    @if(!$reminder->completed_at)
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0)" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt">
                                                                <li>
                                                                    <a href="javascript:void(0)" class="mark-complete" data-id="{{$reminder->id}}" @if($reminder->lead) data-type="lead" data-type_id ="{{$reminder->lead_id}}" @else data-type="connection" data-type_id ="{{$reminder->connection_id}}" @endif><em class="icon ni ni-check-circle-cut"></em></span>Mark Completed</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </td>
                                            </tr><!-- .nk-tb-item  -->
                                            @php $key++; @endphp
                                            @endforeach
                                            @foreach($nextWeekReminders as $reminder)
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col">
                                                    {{$key+1}}
                                                </td>
                                                <td class="nk-tb-col">
                                                    <div class="user-card">
                                                        <div class="user-info">
                                                            @if($reminder->connection_id)
                                                            <b>Connection: {{$reminder->connection->name}}</b> follow up reminder is scheduled at {{date('H:i A',strtotime($reminder->time))}}.
                                                            @endif
                                                            @if($reminder->lead_id)
                                                            <b>Lead: {{$reminder->lead->name}}</b> follow up reminder is scheduled at {{date('H:i A',strtotime($reminder->time))}}.
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg">
                                                    <span>{{date('d F Y',strtotime($reminder->date))}}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg reminder-badge">
                                                    <span class="badge badge-dim badge-info">Next Week</span>
                                                    @if($reminder->completed_at)
                                                    <span class="badge badge-dim badge-success">Completed</span>
                                                    @endif
                                                </td>
                                                <td class="nk-tb-col nk-tb-col-tools">
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0)" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt">
                                                                <li>
                                                                    <a href="javascript:void(0)" class="mark-complete" data-id="{{$reminder->id}}" @if($reminder->lead) data-type="lead" data-type_id ="{{$reminder->lead_id}}" @else data-type="connection" data-type_id ="{{$reminder->connection_id}}" @endif><em class="icon ni ni-check-circle-cut"></em></span>Mark Completed</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr><!-- .nk-tb-item  -->
                                            @php $key++; @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tabItem2">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="nk-block nk-block-lg">
                            <!-- content @s -->
                            <div class="card card-preview">
                                <div class="card-inner">
                                    <table class="datatable-init nowrap nk-tb-list nk-tb-ulist reminders-table" data-auto-responsive="false">
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head">
                                                <th class="nk-tb-col"><span class="sub-text">#</span></th>
                                                <th class="nk-tb-col"><span class="sub-text">Reminder</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Date</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Action</span></th>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $key = 0; @endphp
                                            @foreach($missedReminders as $reminder)
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col">
                                                    {{$key+1}}
                                                </td>
                                                <td class="nk-tb-col">
                                                    <div class="user-card">
                                                        <div class="user-info">
                                                            @if($reminder->connection_id)
                                                            <b>Connection: {{$reminder->connection->name}}</b> follow up reminder is scheduled at {{date('H:i A',strtotime($reminder->time))}}.
                                                            @endif
                                                            @if($reminder->lead_id)
                                                            <b>Lead: {{$reminder->lead->name}}</b> follow up reminder is scheduled at {{date('H:i A',strtotime($reminder->time))}}.
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg">
                                                    <span>{{date('d F Y',strtotime($reminder->date))}}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg reminder-badge">
                                                    <span class="badge badge-dim badge-danger">Missed</span>
                                                </td>
                                                <td class="nk-tb-col nk-tb-col-tools">
                                                    @if(!$reminder->completed_at)
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0)" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt">
                                                                <li>
                                                                    <a href="javascript:void(0)" class="mark-complete" data-id="{{$reminder->id}}" @if($reminder->lead) data-type="lead" data-type_id ="{{$reminder->lead_id}}" @else data-type="connection" data-type_id ="{{$reminder->connection_id}}" @endif><em class="icon ni ni-check-circle-cut"></em></span>Mark Completed</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </td>
                                            </tr><!-- .nk-tb-item  -->
                                            @php $key++; @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tabItem3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="nk-block nk-block-lg">
                            <!-- content @s -->
                            <div class="card card-preview">
                                <div class="card-inner">
                                    <table class="datatable-init nowrap nk-tb-list nk-tb-ulist reminders-table" data-auto-responsive="false">
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head">
                                                <th class="nk-tb-col"><span class="sub-text">#</span></th>
                                                <th class="nk-tb-col"><span class="sub-text">Reminder</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Date</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $key = 0; @endphp
                                            @foreach($completedReminders as $reminder)
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col">
                                                    {{$key+1}}
                                                </td>
                                                <td class="nk-tb-col">
                                                    <div class="user-card">
                                                        <div class="user-info">
                                                            @if($reminder->connection_id)
                                                            <b>Connection: {{$reminder->connection->name}}</b> follow up reminder is scheduled at {{date('H:i A',strtotime($reminder->time))}}.
                                                            @endif
                                                            @if($reminder->lead_id)
                                                            <b>Lead: {{$reminder->lead->company_name}}</b> follow up reminder is scheduled at {{date('H:i A',strtotime($reminder->time))}}.
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg">
                                                    <span>{{date('d F Y',strtotime($reminder->date))}}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg reminder-badge">
                                                    <span class="badge badge-dim badge-success">Completed</span>
                                                </td>
                                            </tr><!-- .nk-tb-item  -->
                                            @php $key++; @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- .card-preview -->

<div class="modal fade" id="markCompleteModal" tabindex="-1" role="dialog" aria-labelledby="reasonForRejection" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form id="mark-complete-form" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <input type="hidden" id="reminder-id" name="id">
                    <h5 class="modal-title">Record Follow-Up to Mark Complete this reminder.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="type-id">
                    <div class="row gy-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Follow Up Date<span class="text-danger">*</span></label>
                                <input name="date" class="form-control" type="date" id="date" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Follow Up Time<span class="text-danger">*</span></label>
                                <input name="time" class="form-control" type="time" id="time" value="<?php echo date("H:i") ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Medium <span class="text-danger">*</span></label>
                                <select name="medium" id="medium" class="form-control ri-select" data-placeholder="Select Medium" required>
                                    <option value="" selected disabled>Select Medium</option>
                                    @foreach($mediums as $key=>$medium)
                                    <option value="{{$key}}">{{ucwords($medium)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 durationDiv d-none">
                            <div class="form-group">
                                <label class="form-label">Duration <span class="text-muted">(in minutes)</span><span class="text-danger">*</span></label>
                                <select name="duration" id="duration" class="form-control ri-select" data-placeholder="Select Duration">
                                    <option value="" selected disabled>Select Duration</option>
                                    @foreach($durations as $duration)
                                    <option value="{{$duration}}">{{ucwords($duration)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Follow Up Type<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select class="form form-control form-control-lg ri-select" name="type_id" data-placeholder="Select Type" data-search="on" required>
                                        <option value="" disabled selected>Select Type</option>
                                        @foreach($followUpTypes as $key=>$followUpType)
                                        <option value="{{$followUpType->id}}">{{ucwords($followUpType->value)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Attachment</label>
                                <div class="form-control-wrap">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="attachment" name="attachment">
                                        <label class="custom-file-label" for="attachment">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Follow Up Outcome</label>
                                <textarea type="text" class="form-control" name="outcome" placeholder="Enter Follow Up Outcome"></textarea>
                            </div>
                        </div>
                    </div><!-- .row -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary mark-complete-btn">Mark Complete</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('custom-js')
<script>
    $('.mark-complete').click(function() {
        let id = $(this).data('id');
        let type = $(this).data('type');
        $('#reminder-id').val(id);
        let typeId = $(this).data('type_id');
        $('#type-id').val(typeId);
        let url = "";
        if (type == "connection") {
            url = "{{route('connectionReminder.markComplete')}}";
            $('#type-id').attr('name', 'connection_id');
        }
        if (type == "lead") {
            url = "{{route('leadReminder.markComplete')}}";
            $('#type-id').attr('name', 'lead_id');
        }
        $('#markCompleteModal').modal('show');
        $('#mark-complete-form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: url,
                data: $('#mark-complete-form').serialize(),
                method: "POST",
                success: function(response) {
                    $('#markCompleteModal').modal('hide');
                    if (response.success) {
                        $('#alert').html(`<div class="alert alert-success">${response.success}</div>`);
                        $('.reminders-table').find("a[data-id='" + id + "']").closest('tr').find('.reminder-badge').html(`<span class="badge badge-dim badge-success">Completed</span>`);
                        $('.reminders-table').find("a[data-id='" + id + "']").closest('tr').find('.dropdown').addClass(`d-none`);
                    } else {
                        $('#alert').html(`<div class="alert alert-danger">${response.error}</div>`);
                    }
                    window.setTimeout(function() {
                        $(".alert").fadeTo(1000, 0).slideUp(500, function() {
                            $('#alert').html('');
                        });
                    }, 1000);

                },
                error: function(response) {
                    $('#markCompleteModal').modal('hide');
                    $('#alert').html(`<div class="alert alert-danger">${response.error}</div>`);
                    window.setTimeout(function() {
                        $(".alert").fadeTo(1000, 0).slideUp(500, function() {
                            $('#alert').html('');
                        });
                    }, 1000);

                }
            });
        });
    });
</script>
<script>
    $('#medium').on('change', function() {
        let medium = $('#medium').val();
        if (medium == '5') {
            $('.durationDiv').removeClass('d-none');
            $('#duration').attr("required", "required");
        } else {
            $('.durationDiv').addClass('d-none');
            $('#duration').removeAttr("required");
        }
    });
    let medium = $('#medium').val();
    if (medium == '5') {
        $('.durationDiv').removeClass('d-none');
        $('#duration').attr("required", "required");
    } else {
        $('.durationDiv').addClass('d-none');
        $('#duration').removeAttr("required");
    }
</script>
@endpush