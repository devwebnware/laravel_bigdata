@extends('backend.layouts.main')
<style>
    .alert-div {
        position: fixed;
        right: 38px;
        width: 20%;
        z-index: 10;
    }

    @media only screen and (max-width: 767px) {
        .alert-div {
            position: relative;
            right: 0;
            width: 100%;
            z-index: 10;
        }
    }

    .dataTables_paginate {
        display: none;
    }
</style>
@section('content')
    <x-alert />
    <div class="col-12">
                <div class="card card-preview">
                    <div class="card-inner">
                        <div class="card-title-group align-start mb-2">
                            <h4 class="">Noticse Board</h4>
                            <div class="text-right">
                                <div class="card-tools">
                                    <ul class="card-tools-nav">
                                        <li><a href="{{ route('notice.show') }}"><span>See All</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12 pb-md-0 pb-4">
                                <div class="col-lg-12 p-0">
                                    <div class="card border">
                                        <div class="card-body p-0">
                                            <h5 class="text-center pt-2">Pinned Notices</h5>
                                            <div style="min-height: 90px; max-height:250px; overflow-x: hidden;"
                                                class="news-and-upadtes scroll-thin">
                                                <hr class="m-0" />
                                                    <div class="card mt-1">
                                                        <div class="card-inner p-2 pb-1">
                                                            <a href="{{ route('notice.show') }}" class="text-dark">
                                                                <div class="card-title-group align-start">
                                                                    <div class="card-title">
                                                                        <h5 class=""> 
                                                                        </h5>
                                                                        <h5 class="subtitle">Circular No:-
                                                                            </h5>
                                                                    </div>
                                                                    <div class="text-right">
                                                                        <div class="card-title mb-2">
                                                                            <h5 class="subtitle">
                                                                                
                                                                                &nbsp;|&nbsp;&nbsp;
                                                                            </h5>
                                                                                <h5><em class="icon ni ni-lock-alt"></em>
                                                                                </h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <hr class="m-0" />
                                                    </div><!-- .card -->
                                                    <div class="card card-bordered ">
                                                        <div class="card-inner">
                                                            <div class="p-3 text-center">No New Pinned Notice Available.
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div> <!-- end slimscroll -->
                                        </div>
                                        <!-- end card-body -->
                                    </div>
                                    <!-- end card-->
                                </div>
                                <!-- end col -->
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="col-lg-12 p-0">
                                    <div class="card border">
                                        <div class="card-body p-0">
                                            <h5 class="text-center pt-2">Notices</h5>
                                            <div style="min-height: 80px; max-height:250px; overflow-x: hidden;"
                                                class="news-and-upadtes scroll-thin">
                                                <hr class="m-0" />
                                                    <div class="card mt-1">
                                                        <div class="card-inner p-3">
                                                            <a href="{{ route('notice.show') }}" class="text-dark">
                                                                <div class="card-title-group align-start">
                                                                    <div class="card-title">
                                                                        <h5 class=""> </h5>
                                                                        <h5 class="subtitle">Circular No:-
                                                                            </h5>
                                                                    </div>
                                                                    <div class="text-right">
                                                                        <div class="card-title mb-2">
                                                                            <h5 class="subtitle">
                                                                                
                                                                            </h5>
                                                                                <h5><em class="icon ni ni-lock-alt"></em>
                                                                                </h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <hr class="m-0" />
                                                    </div><!-- .card -->
                                                    <div class="card card-bordered ">
                                                        <div class="card-inner">
                                                            <div class="p-3 text-center">No New Notice Available.</div>
                                                        </div>
                                                    </div>
                                            </div> <!-- end slimscroll -->
                                        </div>
                                        <!-- end card-body -->
                                    </div>
                                    <!-- end card-->
                                </div>
                                <!-- end col -->
                            </div>
                        </div>
                    </div>
                </div><!-- .col -->
            </div>
@endsection
@push('custom-js')
    <script>
        $(document).ready(function() {
            window.setTimeout(function() {
                $(".alert-dismissible").fadeTo(3000, 0).slideUp(2000, function() {});
            });
        }, 5000);
    </script>
@endpush
