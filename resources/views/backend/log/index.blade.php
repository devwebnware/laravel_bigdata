@extends('backend.layouts.main')
@section('content')
<x-alert />
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
    <div class="datatable-wrap my-3" style="border: 0;">
        <table class="datatable-init nowrap table dataTable no-footer dtr-inline" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
            <thead>
                <tr>
                    <!-- TODO: Check area-label -->
                    <th class="sorting sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">S. No.</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">User</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">Type</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">Created On</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $key => $log)
                <tr>
                    <td class="dtr-control sorting_1" tabindex="0">{{ ++$key }}</td>
                    <td>{{ $log->user->name }}</td>
                    <td>
                        @if($log->type == 0)
                        Import
                        @else
                        Export
                        @endif
                    </td>
                    <td>{{ $log->created_at }}</td>
                </tr>
                @empty
                <tr class="text-center">
                    <td colspan="4">No Data Available</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection