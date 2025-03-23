@extends('layouts.admin', [])
@section('title', 'New Store')
@section('content')
    <div class="pagetitle">
        <h1>New Store</h1>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Store Information</h5>
                        <!-- Horizontal Form -->
                        <form id="new-store">
                            @csrf
                            <div class="row pb-2">
                                <label for="name" class="col-sm-12 col-form-label">Store Name
                                    <rf />
                                </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name" id="name"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="row pb-4">
                                <label for="location" class="col-sm-12 col-form-label">Location
                                    <rf />
                                </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="location" autocomplete="off"
                                        id="location">
                                </div>
                            </div>
                            <div class="row pb-4">
                                <label for="latitude" class="col-sm-12 col-form-label">Latitude
                                    <rf />
                                </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="latitude" autocomplete="off"
                                        id="latitude">
                                </div>
                            </div>
                            <div class="row pb-4">
                                <label for="longitude" class="col-sm-12 col-form-label">Longitude
                                    <rf />
                                </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="longitude" autocomplete="off"
                                        id="longitude">
                                </div>
                            </div>
                            <div class="text-left">
                                <button type="submit" class="btn bestway-btn me-3">Save</button>
                                <button type="reset" class="btn bestway-btn grey">Reset</button>
                            </div>
                        </form><!-- End Horizontal Form -->

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Select or Search Location</h5>
                        <div class="col-md-12 position-relative p-0 mb-3">
                            <div class="map-search">
                                <input name="selected_address" placeholder="Seach..." class="text-field us3-address"
                                    type="search">
                            </div>
                            <input type="hidden" class="us3-radius" value="0">
                            <div class="us3" style="height: 400px; width:100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('head-assets')
    <style>
        .text-field {
            width: 100%;
            height: 40px;
            color: #555;
            font-size: 14px;
            line-height: 30px;
            padding: 3px 13px;
            text-indent: 0.01px;
            background: #fff;
            border: 1px solid #e6e8ee;
            border-radius: 5px;
        }
        .map-search {
    width: 75%;
    position: absolute;
    left: 13%;
    bottom: 12px;
    z-index: 9;
    box-shadow: 0 3px 10px 0 rgba(0, 0, 0, 0.1);
}
    </style>
@endpush
@push('footer-assets')
    <script>
        function google_maps_callback() {}
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmGJmity-vvlf0Wjmkrst4HEszyWZKZ2I&libraries=places&callback=google_maps_callback">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-locationpicker/0.1.12/locationpicker.jquery.min.js" integrity="sha512-KGE6gRUEc5VBc9weo5zMSOAvKAuSAfXN0I/djLFKgomlIUjDCz3b7Q+QDGDUhicHVLaGPX/zwHfDaVXS9Dt4YA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/user/js/store-new.js?v=') . config('version.js_user') }}"></script>
@endpush
