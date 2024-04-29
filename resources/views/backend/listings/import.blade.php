@extends('backend.layouts.main')
@section('content')
<x-alert />
<div class="d-flex flex-row justify-content-between">
    <div>
        <h4>Import Listings</h4>
    </div>
    <div>
        <a href="{{ route('listings.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
<div class="card card-bordered table-responsive mt-3 p-5 card-preview">
    <form id="importFileForm" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name">Select file</label>
            <input type="file" id="file" name='data' />
        </div>
        <div class="d-flex flex-direction-row">
            <button type="submit" class="btn btn-primary" class="btn btn-sm btn-success">UPLOAD</button>
            <a href="{{ route('listings.index') }}" class="btn ml-2 btn-sm btn-secondary">CANCEL</a>
            <div class="spinner-border first-loader ml-3 d-none" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </form>
</div>
<div class="csvErrors mt-3 d-none p-4 card-bordered card">
</div>
<!-- Start Filter Modal -->
<button data-toggle="modal" class="btn trigger-modal d-none btn-info" data-target="#importModal"></button>
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
                        <thead class="thead-dark">
                            <th scope="col" class="text-center">File Column</th>
                            <th scope="col" class="text-center">Database Column</th>
                        </thead>
                        <tbody id="headersMapBody">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <div class="mt-2">
                        <div class="spinner-border second-loader ml-3 d-none" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <a href="#" class="btn close-btn btn-secondery" data-dismiss="modal" aria-label="Close">
                            Close
                        </a>
                        <button type="submit" class="btn btn-info">IMPORT</button>
                        <button type="button" class="btn clear-btn btn-secondery">CLEAR</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    .second-loader {
        width: 1.6rem;
        height: 1.6rem;
        vertical-align: middle;
    }
</style>
@push('custom-js')
<script>
    $(document).ready(function() {
        $("#importFileForm").on("submit", function(e) {
            e.preventDefault();
            let $form = jQuery(this);
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('listings.data.handel.import') }}",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $form.find('.first-loader').removeClass('d-none');
                },
                success: function(data) {
                    let headers = data.headers;
                    let columnNames = data.columnNames;
                    let body = $("#headersMapBody");
                    body.empty();
                    let options = [];
                    options.push('<option disabled selected>Select an option</option>');
                    for (let i = 0; i < headers.length; i++) {
                        let optionElements = columnNames.map(columnName => {
                            let selected = columnName === headers[i] ? 'selected' : '';
                            return `<option value="${columnName}" ${selected}>${columnName}</option>`;
                        });

                        body.append(
                            `<tr>
                                <td scope="row" style="width: 30%; text-align: center">${headers[i]}</td>
                                <td scope="row" style="width: 70%; text-align: center">
                                    <select class="form-select db-column-list form-control" style="cursor: pointer" name="headers[${headers[i]}]">
                                        ${options.join('')}
                                        ${optionElements.join('')}
                                    </select>
                                </td>
                            </tr>`
                        );
                    }
                    $(".trigger-modal").trigger('click');
                },
                complete: function() {
                    $form.find('.first-loader').addClass('d-none');
                },
                error: function(data) {
                    $form.find('.first-loader').addClass('d-none');
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
            let modalFooter = $(".modal-footer");

            $.ajax({
                url: "{{ route('listings.data.handel.import') }}",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    modalFooter.find('.second-loader').removeClass('d-none');
                },
                success: function(data) {
                    window.location.href = "{{ route('listings.data.import') }}";
                },
                complete: function() {
                    modalFooter.find('.second-loader').addClass('d-none');
                },
                error: function(data) {
                    modalFooter.find('.second-loader').addClass('d-none');
                    console.log('Error:', data);
                }
            });
        });
    });
    $(document).ready(function() {
        $(".clear-btn").on("click", function() {
            $('.form-control, .form-select').val('').trigger('change');
        });
    });
</script>
@endpush
@endsection