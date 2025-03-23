@extends('layouts.admin', [])
@section('title', 'Stores')
@section('content')
    <div class="pagetitle">
        <h1>Stores</h1>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row g-4">
            <div class="ro">
                <div class="col-lg-12">
                    <div class="card pt-2">
                        <div class="card-body">
                            <table id="store-list-datatable" class="datatable table table-sm table-hover table-striped"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="1%">Sl. No.</th>
                                        <th>Store Name</th>
                                        <th>Location</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th width="1%">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    @include('includes.view-store-popup')
@endsection
@push('head-assets')
    <link rel="stylesheet" href="{{ asset('assets/user/css/flatpickr.min.css?v=') . config('version.css_user') }}">
@endpush
@push('footer-assets')
    <script src="{{ asset('assets/user/js/flatpickr.js?v=') . config('version.js_user') }}"></script>
    <script src="{{ asset('assets/user/js/store-list.js?v=') . config('version.js_user') }}"></script>
@endpush
