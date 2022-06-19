const BASE_URL = "http://127.0.0.1:8000/";
const ADMIN_URL = BASE_URL + "dashboard/"
const API_URL = BASE_URL + "api/";

$(".loginForm").submit(function(e) {
    e.preventDefault();

    const email = $('#email').val();
    const password = $("#password").val();
    if (email == "" || password == "") {
        const error_message = "";
        if (email == "") {
            error_message += "Email must be provided";
        }
        if (password == "") {
            error_message += "Password must be provided";
        }

        toastr.error(error_message, "Top Full Width", {
            positionClass: "toast-top-full-width",
            timeOut: 5e3,
            closeButton: !0,
            debug: !1,
            newestOnTop: !0,
            progressBar: !0,
            preventDuplicates: !0,
            onclick: null,
            showDuration: "300",
            hideDuration: "1000",
            extendedTimeOut: "1000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut",
            tapToDismiss: !1
        })
    } else {

    }

    const req = {
        "email": email,
        "password": password
    }
    $.ajax({
        type: "POST",
        url: API_URL + "login",
        data: req,
        dataType: "json",
        success: function(response) {
            if (response.status == "success") {
                res = response.data;
                sessionStorage.setItem("token", res.token);
                sessionStorage.setItem("name", res.name);
                sessionStorage.setItem("email", res.email);
                toastr.success("Login was successful", "Top Right", {
                    timeOut: 500000000,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    positionClass: "toast-top-right",
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                })

                window.location = ADMIN_URL
            } else {
                toastr.error(res.message, "Top Full Width", {
                    positionClass: "toast-top-full-width",
                    timeOut: 5e3,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                })
            }
        },
        error: function(data) {
            toastr.error("Oops! Something went wrong " + response.responseText, "Top Full Width", {
                positionClass: "toast-top-full-width",
                timeOut: 5e3,
                closeButton: !0,
                debug: !1,
                newestOnTop: !0,
                progressBar: !0,
                preventDuplicates: !0,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                tapToDismiss: !1
            })
        }
    })
});