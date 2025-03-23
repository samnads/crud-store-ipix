let cent_latitude = 11.2542733;
let cent_longitude = 75.8345698;
var event_ = null; 
$(document).ready(function () {
    
});
function locationPickr(latitude, longitude) {
    $('.us3').locationpicker({
        location: {
            latitude: latitude,
            longitude: longitude
        },

        radius: 0,
        inputBinding: {
            latitudeInput: $('#latitude'),
            longitudeInput: $('#longitude'),
            radiusInput: $('.us3-radius'),
            locationNameInput: $('.us3-address')
        },
        //markerIcon: _base_url +'images/picker.png',
        enableAutocomplete: true,
        onchanged: function (currentLocation, radius, isMarkerDropped) {
            // Uncomment line below to show alert on each Location Changed event
            //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
        }
    });
}
function showPosition(position) {
    if (event_) {
        console.log(event_);
        event_.type = 'change';
        $('input[name="latitude"]', _address_from).val(position.coords.latitude).trigger(event_);
        $('input[name="longitude"]', _address_from).val(position.coords.longitude).trigger(event_);
    }
    else {
        $('#latitude').val(position.coords.latitude);
        $('#longitude').val(position.coords.longitude);
    }
    locationPickr(position.coords.latitude, position.coords.longitude);
    datatable = $('#store-list-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: _base_url + 'user/stores',
            data: function (d) {
                d.latitude = $('#latitude').val();
                    d.longitude = $('#longitude').val();
            },
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name', name: 'name', orderable: false, searchable: false },
            { data: 'location', name: 'location', orderable: false, searchable: false, orderable: false, searchable: false },
            { data: 'latitude', name: 'latitude', orderable: false, searchable: false },
            { data: 'longitude', name: 'longitude', orderable: false, searchable: false },
            { data: 'distance', name: 'distance', orderable: false, searchable: false },
        ]
    });
}
function showError(error) {
    switch (error.code) {
        case error.PERMISSION_DENIED:
            $('.us3').locationpicker({
                location: {
                    latitude: cent_latitude,
                    longitude: cent_longitude
                },
                radius: 0,
                inputBinding: {
                    latitudeInput: $('#latitude'),
                    longitudeInput: $('#longitude'),
                    radiusInput: $('.us3-radius'),
                    locationNameInput: $('.us3-address')
                },
                enableAutocomplete: true,
                onchanged: function (currentLocation, radius, isMarkerDropped) {
                    // Uncomment line below to show alert on each Location Changed event
                    //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
                }
            });
            break;
        case error.POSITION_UNAVAILABLE:
            console.log("Location information is unavailable.");
            break;
        case error.TIMEOUT:
            console.log("The request to get user location timed out.");
            break;
        case error.UNKNOWN_ERROR:
            console.log("An unknown error occurred.");
            break;
    }
}
$(document).ready(function () {
    if ($('#latitude').val() == '' || $('#longitude').val() == '') {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    } else {
        locationPickr($('#latitude').val(), $('#longitude').val());
    }
});