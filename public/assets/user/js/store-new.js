let cent_latitude = 11.2542733;
let cent_longitude = 75.8345698;
var event_ = null;
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
    new_store_form_validator = new_store_form.validate({
        focusInvalid: true,
        //ignore: [],
        rules: {
            "name": {
                required: true,
            },
            "location": {
                required: true,
            },
            "latitude": {
                required: true,
            },
            "longitude": {
                required: true,
            }
        },
        messages: {
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "mobile_number") {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            let save_btn = $('[type="submit"]', form);
            save_btn.attr('disabled', true);
            $.ajax({
                type: 'POST',
                url: _base_url + "admin/store",
                dataType: 'json',
                data: new_store_form.serialize(),
                success: function (response) {
                    //afterAjaxSuccess(response);
                    if (response.status == true) {
                        Swal.fire({
                            title: response.message.title,
                            text: response.message.content,
                            icon: response.message.type,
                            confirmButtonText: "OK",
                            allowOutsideClick: false
                        }).then((result) => {
                            location.href = _base_url + 'admin/home'
                        });
                    }
                    else {
                        toast(response.error.title, response.error.content, response.error.type);
                        save_btn.attr('disabled', false);
                    }
                },
                error: function (response) {
                    ajaxError(response);
                    save_btn.attr('disabled', false);
                },
            });
        }
    });
    edit_store_form_validator = edit_store_form.validate({
        focusInvalid: true,
        //ignore: [],
        rules: {
            "name": {
                required: true,
            },
            "location": {
                required: true,
            },
            "latitude": {
                required: true,
            },
            "longitude": {
                required: true,
            }
        },
        messages: {
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "mobile_number") {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            let save_btn = $('[type="submit"]', form);
            save_btn.attr('disabled', true);
            $.ajax({
                type: 'PUT',
                url: _base_url + "admin/store",
                dataType: 'json',
                data: edit_store_form.serialize(),
                success: function (response) {
                    //afterAjaxSuccess(response);
                    if (response.status == true) {
                        Swal.fire({
                            title: response.message.title,
                            text: response.message.content,
                            icon: response.message.type,
                            confirmButtonText: "OK",
                            allowOutsideClick: false
                        }).then((result) => {
                            location.href = _base_url +'admin/home'
                        });
                    }
                    else {
                        toast(response.error.title, response.error.content, response.error.type);
                        save_btn.attr('disabled', false);
                    }
                },
                error: function (response) {
                    ajaxError(response);
                    save_btn.attr('disabled', false);
                },
            });
        }
    });
});

let new_store_form = $('form[id="new-store"]');
let edit_store_form = $('form[id="edit-store"]');