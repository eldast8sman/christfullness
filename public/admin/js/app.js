var BASE_URL = "http://127.0.0.1:8000/";
var ADMIN_URL = BASE_URL + "dashboard/"
var API_URL = BASE_URL + "api/";

$(".loginForm").submit(function(e) {
    e.preventDefault();

    var email = $('#email').val();
    var password = $("#password").val();
    if (email == "" || password == "") {
        var error_message = "";
        if (email == "") {
            error_message += "Email must be provided";
        }
        if (password == "") {
            error_message += "Password must be provided";
        }

        toaster_error(error_message)
    } else {
        var req = {
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
                    toaster_success("Login was successful");

                    window.location = ADMIN_URL
                } else {
                    toaster_error(response.message);
                }
            },
            error: function(data) {
                toaster_error("Oops! Something went wrong "+respose.responseText);
            }
        })
    }

});

if($("input#action").val() == "update"){
    var admin_id = $("input#admin_id").val();
    var password_div = $("input#admin_password").parent();
    password_div.hide();
    $.ajax({
        type: "GET",
        url: API_URL+"users/"+admin_id,
        dataType: "json",
        headers: {
            "Authorization": "Bearer "+sessionStorage.getItem('token'),
            "Content-Type": "application/json"
        },
        success: function(response){
            if(response.status == "success"){
                data = response.data;

                $("input#admin_name").val(data.name);
                $("input#admin_email").val(data.email);
            }
        },
        error: function(response){
            console.log(response.responseText);
        }
    })
}

$(".admin_form").submit(function(e){
    e.preventDefault();

    var name = $("input#admin_name").val();
    var email = $("input#admin_email").val();
    var password = $("input#admin_password").val();

    if((name != "") && (email != "")){
        if($("input#action").val() == "create"){
            if(password == ""){
                toaster_error("Password must be provided");
                return false;
            } else {
                var req = {
                    "name": name,
                    "email": email,
                    "password": password
                }
                $.ajax({
                    type: "POST",
                    url: API_URL+"register",
                    data: JSON.stringify(req),
                    contentType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        "Authorization": "Bearer "+sessionStorage.getItem('token'),
                        "Content-Type": "application/json"
                    },
                    success: function(response){
                        if(response.status == "success"){
                            toaster_success(response.message);
                            window.location = ADMIN_URL + "admins";
                        } else {
                            toaster_error(response.message);
                        }
                    },
                    error: function(response){
                        toaster_error(response.responseText);
                    }
                });
            }
        } else if($("input#action").val() == "update"){
            var admin_id = $("input#admin_id").val();
            var req = {
                "name": name,
                "email": email
            }
            
            $.ajax({
                type: "PUT",
                url: API_URL+"users/"+admin_id,
                data: JSON.stringify(req),
                contentType: "json",
                headers: {
                    "Authorization": "Bearer "+sessionStorage.getItem('token'),
                    "Content-Type": "application/json"
                },
                success: function(response){
                    if(response.status == "success"){
                        toaster_success(response.message);
                        window.location = ADMIN_URL + "admins";
                    } else {
                        toaster_error(response.message);
                    }
                },
                error: function(response){
                    toaster_error(response.responseText);
                }
            });
        }
    } else {
        var error_message = "";
        if(name == ""){
            error_message += "No Name was given";
        }
        if(email == ""){
            error_message += "Email must be provided";
        }

        toaster_error(error_message);
    }

    return false;
});

var admin_del_buttons = document.querySelectorAll(".del_admin");
for(let i=0; i < admin_del_buttons.length; i++){
    del_button = admin_del_buttons[i];

    del_button.onclick = function(e){
        var admin_id = e.target.dataset['id'];

        $.ajax({
            type: "DELETE",
            url: API_URL+"users/"+admin_id,
            dataType: "json",
            headers: {
                "Authorization": "Bearer "+sessionStorage.getItem('token'),
                "Content-Type": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    toaster_success(response.message);

                    $("tr#admin"+admin_id).fadeOut(1500);
                }
            },
            error: function(response){
                toaster_error(response.responseText);
            }
        })
    }
}

function toaster_error(error_message){
    toastr.error(error_message, "Error", {
        positionClass: "toast-top-right",
        timeOut: 500000000,
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

function toaster_success(success_message){
    toastr.success(success_message, "Success", {
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
}