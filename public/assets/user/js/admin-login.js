let login_form = $('form[id="user-login-form"]');
let loading_button_html = `Please wait...`;
$(document).ready(function () {
    login_form_validator = login_form.validate({
        focusInvalid: true,
        errorClass: "text-danger small",
        ignore: [],
        rules: {
            "username": {
                required: true,
            },
            "password": {
                required: true,
            },
        },
        messages: {
            "email": {
                required: "Enter your email",
            },
            "password": {
                required: "Enter your password",
            },
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "username") {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            let submit_btn = $('button[type="submit"]', form);
            submit_btn.html(loading_button_html).prop("disabled", true);
            $.ajax({
                type: 'POST',
                url: _base_url + "admin/login",
                dataType: 'json',
                data: login_form.serialize(),
                success: function (response) {
                    if (response.status == 'success') {
                        submit_btn.html('Logging in...').prop("disabled", true).removeClass('btn-info').addClass('btn-success');
                        location.href = response.redirect;
                    }
                    else {
                        submit_btn.html('Login').prop("disabled", false);
                        toast("", response.message, "error", { stack: 1, position: 'bottom-center', allowToastClose: false });
                    }
                },
                error: function (response) {
                    submit_btn.html('Login').prop("disabled", false);
                    //toast("Page Expired", "Reloading...", 'warning')
                },
            });
        }
    });
});