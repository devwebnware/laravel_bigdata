@extends('backend.layouts.main')
@section('content')
<div class="card card-bordered h-100">
    <div class="card-inner">
        <div class="card-head">
            <h5 class="card-title">Import Info</h5>
        </div>
        <form id="importFileForm" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name">Select file</label>
                <input type="file" id="file" name='data' />
            </div>
            <button type="submit" class="btn btn-primary" class="btn btn-success">Upload</button>
        </form>
    </div>
</div>

<!-- Start Filter Modal -->
<button data-toggle="modal" class="btn trigger-modal d-none btn-info" data-target="#importModal"><em class="icon ni ni-filter"></em></button>
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form id="importDataForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Import</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body-md">
                    <table class="table w-100" id="headersMapTable">
                        <thead>
                            <th class="text-center">File Column</th>
                            <th class="text-center">Database Column</th>
                        </thead>
                        <tbody id="headersMapBody">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <div class="mt-2">
                        <button type="submit" class="btn btn-info">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@push('custom-js')
<script>
    $(document).ready(function() {
        $("#importFileForm").on("submit", function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: "{{ route('listings.data.handel.import') }}",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    let headers = data.headers;
                    let columnNames = data.columnNames;
                    let body = $("#headersMapBody");
                    body.empty();
                    let options = [];
                    options.push('<option value="Default Option" selected disabled>Default Option</option>');
                    for (let i = 0; i < columnNames.length; i++) {
                        let option = `<option value="${columnNames[i]}">${columnNames[i]}</option>`;
                        options.push(option);
                    }
                    for (let i = 0; i < headers.length; i++) {
                        body.append(
                            `<tr>
                                <td style="width: 30%; text-align: center">${headers[i]}</td>
                                <td style="width: 70%; text-align: center">
                                    <select class="" name="headers[${headers[i]}]">
                                        ${options.join('')}
                                    </select>
                                </td>
                            </tr>`
                        );
                    }
                    $(".trigger-modal").trigger('click');
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });
    });
    $(document).ready(function() {
        $("#importDataForm").on("submit", function(e) {
            e.preventDefault();
            var fileInput = document.getElementById('file');
            var file = fileInput.files[0];
            var formData = new FormData(this);
            formData.append('data', file);

            $.ajax({
                url: "{{ route('listings.data.handel.import') }}",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });
    });
</script>
@endpush
@endsection