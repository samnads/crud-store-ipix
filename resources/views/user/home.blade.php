@extends('layouts.user', [])
@section('title', 'Nearest Stores')
@section('content')
    <div class="pagetitle">
        <h1>Nearest Stores (Sorted)</h1>
    </div><!-- End Page Title -->
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Current Latitude</span>
        <input type="text" class="form-control" name="latitude" id="latitude" aria-label="Username" aria-describedby="basic-addon1" readonly>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Current Longitude</span>
        <input type="text" class="form-control" name="longitude" id="longitude" aria-label="Username"
            aria-describedby="basic-addon1" readonly>
    </div>
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
                                        <th>Distance in KM</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
@push('head-assets')
@endpush
@push('footer-assets')
    <script>
        function google_maps_callback() {}
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmGJmity-vvlf0Wjmkrst4HEszyWZKZ2I&libraries=places&callback=google_maps_callback">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-locationpicker/0.1.12/locationpicker.jquery.min.js"
        integrity="sha512-KGE6gRUEc5VBc9weo5zMSOAvKAuSAfXN0I/djLFKgomlIUjDCz3b7Q+QDGDUhicHVLaGPX/zwHfDaVXS9Dt4YA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/user/js/store-list-sorted.js?v=') . config('version.js_user') }}"></script>
@endpush
