@extends('backend.layouts.main')
@section('content')
<x-alert />

<div class="card card-bordered table-responsive mt-3 p-5 card-preview">
    <div>
        <h4>In Progress Jobs</h4>
    </div>
    <table class="table mt-3" id="inProgressJobsTable">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">QUEUE</th>
                <th scope="col">ATTEMPTS</th>
                <th scope="col">RESERVED AT</th>
                <th scope="col">AVAILABLE AT</th>
                <th scope="col">CREATED AT</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @php $count=1; @endphp
            @forelse($inProgressJobs as $job)
            <tr>
                <td scope="row">{{ $count++ }}</td>
                <td scope="row">{{ $job->id }}</td>
                <td scope="row">{{ $job->queue }}</td>
                <td scope="row">{{ $job->attempts }}</td>
                <td scope="row">{{ $job->reserved_at }}</td>
                <td scope="row">{{ $job->available_at }}</td>
                <td scope="row">{{ $job->created_at }}</td>
                <td scope="row"><div class="Jobloader"></div></td>
            </tr>
            @empty
            <tr class="text-center">
                <td scope="row" colspan="7">No Data Available</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="card card-bordered table-responsive mt-3 p-5 card-preview">
    <div>
        <h4>Failed Jobs</h4>
    </div>
    <table class="table mt-3" id="failedJobsTable">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">EXCEPTION</th>
                <th scope="col">FAILED AT</th>
            </tr>
        </thead>
        <tbody>
            @php $count=1; @endphp
            @forelse($failedJobs as $job)
            <tr>
                <td scope="row">{{ $count++ }}</td>
                <td scope="row">{{ $job->id }}</td>
                <td scope="row">{{ substr($job->exception, 0, 100) }}</td>
                <td scope="row">{{ $job->failed_at }}</td>
            </tr>
            @empty
            <tr class="text-center">
                <td scope="row" colspan="4">No Data Available</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<style>
.Jobloader {
  width: calc(80px / cos(45deg));
  height: 14px;
  background: repeating-linear-gradient(-45deg,#2B3748 0 15px,#0000 0 20px) left/200% 100%;
  animation: l3 2s infinite linear;
}
@keyframes l3 {
    100% {background-position:right}
}
</style>
@push('custom-js')
<script>
    // Function to send AJAX request and update table data
    function updateTableData() {
        $.ajax({
            url: '{{ route("listings.import.data.status") }}',
            type: 'GET',
            dataType: 'json', // Expecting JSON response from the server
            success: function(response) {
                console.log(response);
                // Parse the JSON response
                var inProgressJobs = response[0];
                var failedJobs = response[1];

                // Update the in-progress jobs table
                updateJobsTable(inProgressJobs, '#inProgressJobsTable');

                // Update the failed jobs table
                updateJobsTable(failedJobs, '#failedJobsTable');
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    // Function to update the table rows with the provided data
    function updateJobsTable(jobs, tableId) {
        var $tableBody = $(tableId + ' tbody');
        $tableBody.empty(); // Clear existing rows

        // Check if there are any jobs
        if (jobs.length > 0) {
            $.each(jobs, function(index, job) {
                // Construct table row HTML with job data
                var rowHTML = '<tr>' +
                    '<td scope="row">' + (index + 1) + '</td>' +
                    '<td scope="row">' + job.id + '</td>' +
                    '<td scope="row">' + job.queue + '</td>' +
                    '<td scope="row">' + job.attempts + '</td>' +
                    '<td scope="row">' + job.reserved_at + '</td>' +
                    '<td scope="row">' + job.available_at + '</td>' +
                    '<td scope="row">' + job.created_at + '</td>' +
                    '</tr>';

                // Append the row to the table
                $tableBody.append(rowHTML);
            });
        } else {
            // If no jobs, display a message
            $tableBody.append('<tr class="text-center"><td colspan="7">No Data Available</td></tr>');
        }
    }

    // Call the updateTableData function initially
    updateTableData();

    // Set a timeout to call the updateTableData function every 5 seconds
    setInterval(updateTableData, 5000); // 5000 milliseconds = 5 seconds
</script>

@endpush
@endsection