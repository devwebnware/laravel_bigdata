@extends('backend.layouts.main')
@push('custom-js')
<style>
    .dark-mode .bg-create,
    .bg-create {
        background-color: #180044 !important;
    }
    .dark-mode .bg-update,
    .bg-update {
        background-color: #004bbd !important;
    }
    .dark-mode .bg-approve,
    .bg-approve {
        background-color: #01b30a !important;
    }
    .dark-mode .bg-reject,
    .bg-reject {
        background-color: #b30101 !important;
    }
</style>
@endpush
@section('content')
<div class="nk-block-head">
    <div class="nk-block-head-content">
        <h4 class="nk-block-title">Activity Logs</h4>
    </div>
</div>
<div class="card card-preview">
        <div class="card-inner">
            <table class="datatable-init nowrap nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">#</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Date</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Activity</span></th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activities as $key=>$activity)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            {{$key+1}}
                        </td>
                        <td class="nk-tb-col">
                            <span>{{date('d F Y',strtotime($activity->created_at))}}</span>
                        </td>
                        <td class="nk-tb-col">
                            <div class="user-card">
                                <div class="user-avatar bg-dark d-none d-sm-flex bg-{{$activity->type}}">
                                    <span>{{substr($activity->message,0,1)}}</span>
                                </div>
                                <div class="user-info">
                                    <span class="tb-lead">{{$activity->message}}</span>
                                </div>
                            </div>
                        </td>
                    </tr><!-- .nk-tb-item  -->
                    @empty
                    <tr class="nk-tb-col">
                        <td class="nk-tb-col" colspan="3">No Record to display </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
</div><!-- .card-preview -->
@endsection