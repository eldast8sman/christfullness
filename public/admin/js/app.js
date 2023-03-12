// var BASE_URL = "https://www.cfcing.org/";
var BASE_URL = "http://127.0.0.1:8000/";
var ADMIN_URL = BASE_URL + "dashboard/";
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
                    localStorage.setItem("token", res.token);
                    localStorage.setItem("name", res.name);
                    localStorage.setItem("email", res.email);
                    toaster_success("Login was successful");

                    // console.log(localStorage);

                    window.location = "../dashboard"
                } else {
                    toaster_error(response.message);
                }
            },
            error: function(response) {
                toaster_error("Oops! Something went wrong "+response.responseText);
            }
        })
    }

});

$("a#dash_logout").click(function(e){
    e.preventDefault();

    toaster_success("Logging Out");

    $.ajax({
        type: "POST",
        url: API_URL+"logout",
        headers: {
            "Authorization": "Bearer "+localStorage.getItem('token'),
            "Content-Type": "application/json"
        },
        success: function(response){
            localStorage.setItem("token", "");
            localStorage.setItem("name", "");
            localStorage.setItem("email", "");
            toaster_success("Successfully Logged Out");

            window.location = ADMIN_URL;
        },
        error: function(response){
            console.log(response.responseText);
            toaster_error("Oops! "+response.responseText);
        }
    })
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
            "Authorization": "Bearer "+localStorage.getItem('token'),
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
                        "Authorization": "Bearer "+localStorage.getItem('token'),
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
                    "Authorization": "Bearer "+localStorage.getItem('token'),
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

$(".home_banner_form").submit(function(e){
    e.preventDefault();

    var title = $("#banner_title").val();
    var content = $("#banner_content").val();
    var call_to_action = $("#call_to_action").val();
    var link = $("#banner_link").val();

    if((title == "") || (content == "") || (call_to_action == "") || (link == "")){
        var error_message = "";
        if(title == ""){
            error_message += "Heading must be provided ";
        }
        if(content == ""){
            error_message += "Content must be provided ";
        }
        if(call_to_action == ""){
            error_message += "Call To Action must be provided ";
        }
        if(link == ""){
            error_message += "Call To Action Link must be provided "
        }
        toaster_error(error_message);
    } else {
        var req = {
            "title": title,
            "content": content,
            "call_to_action": call_to_action,
            "link": link
        }
        $.ajax({
            type: "POST",
            url: API_URL+"home-banner",
            data: JSON.stringify(req),
            contentType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Authorization": "Bearer "+localStorage.getItem('token'),
                "Content-Type": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    toaster_success(response.message);
                    window.location = ADMIN_URL;
                } else {
                    toaster_error(response.message);
                }
            },
            error: function(response){
                toaster_error(response.responseText);
            }
        });   
    }

    return false;
})

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
                "Authorization": "Bearer "+localStorage.getItem('token'),
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

$("form.minister_form").submit(function(e){
    e.preventDefault();

    var appearance = $("select#minister_appearance").val();
    var name = $("input#minister_name").val();
    var position = $("input#minister_position").val();

    if((appearance != "") && (name != "") && (position != "")){
        var fd = new FormData(document.querySelector(".minister_form"));
        toaster_success("Minister Data Uploading");
        if($("input#action").val() == "create"){
            var url = API_URL+"ministers";
        } else if($("input#action").val() == "update"){
            var minister_id = $("input#minister_id").val();
            var url = API_URL+"ministers/"+minister_id;
        }
        $.ajax({
            type: "POST",
            url: url,
            data: fd,
            dataType: "json",
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Authorization": "Bearer "+localStorage.getItem('token')
            },
            success: function(response){
                if(response.status == "success"){
                    toaster_success(response.message);
                    if($('input#action').val() == "create"){
                        window.location = ADMIN_URL+"ministers";
                    } else {
                        window.location = ADMIN_URL+"ministers/"+response.data.slug
                    }
                } else {
                    toaster_error(response.message);
                }
            },
            error: function(response){
                console.log(response.responseText);
                toaster_error(response.responseText);
            }
        });
        return false;
    } else {
        var error_message = "";
        if(appearance == ""){
            error_message += "Appearance Position must be selected! ";
        }
        if(name == ""){
            error_message += "Minister Name must be provided! ";
        }
        if(position == ""){
            error_message += "Minister's Post must be provided! ";
        }
        toaster_error(error_message);
    }
});

del_minister = document.querySelector("#delete_minister");
if(del_minister){
    del_minister.onclick = function(e){
        var minister_id = e.target.dataset['id'];
    
        $.ajax({
            type: "DELETE",
            url: API_URL+"ministers/"+minister_id,
            dataType: "json",
            headers: {
                "Authorization": "Bearer "+localStorage.getItem('token'),
                "Content-Type": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    toaster_success(response.message);
    
                    window.location = ADMIN_URL+"ministers";
                } else {
                    toaster_error(response.message);
                }
            },
            error: function(response){
                toaster_error(response.responseText);
            }
        })
    }
}


$("form.series_form").submit(function(e){
    e.preventDefault();

    var title = $("input#series_title").val();
    console.log(title);
    if(title != ""){
        var fd = new FormData(document.querySelector(".series_form"));
        toaster_success("Series Data Uploading");
        if($("input#action").val() == "create"){
            var url = API_URL+"series";
        } else if($("input#action").val() == "update"){
            var series_id = $("input#series_id").val();
            var url = API_URL+"series/"+series_id;
        }
        
        $.ajax({
            type: "POST",
            url: url,
            data: fd,
            dataType: "json",
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Authorization": "Bearer "+localStorage.getItem('token')
            },
            success: function(response){
                if(response.status == "success"){
                    toaster_success(response.message);
                    if($('input#action').val() == "create"){
                        window.location = ADMIN_URL+"message-series";
                    } else {
                        window.location = ADMIN_URL+"message-series/"+response.data.slug
                    }
                } else {
                    toaster_error(response.message);
                }
            },
            error: function(response){
                console.log(response.responseText);
                toaster_error(response.responseText);
            }
        });
        return false;
    } else {
        toaster_error('Title must be provided');
    }
})

var series_message_div = document.querySelectorAll(".show_series_message");
for(let i=0; i<=series_message_div.length-1; i++){
    series = series_message_div[i];
    
    series.onclick = function(e){
        var id = e.target.dataset['id'];

        $.ajax({
            type: "GET",
            url: API_URL+"messages/"+id,
            dataType: "json",
            headers: {
                "Authorization": "Bearer "+localStorage.getItem('token'),
                "Content-Type": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    var data = response.data;

                    $("#series_message_modal h5.modal-title").html(data.title);
                    var output = '<div class="row"><img src="'+data.image_path+'" style="width: 400px; max-width:80%; margin: 0 auto" /></div>';
                    output +=   '<div class="row">';
                    output +=       '<div class="col-lg-6 col-md-9 col-sm-12 mx-auto my-2"><audio src="'+data.audio_path+'" style="margin: 0 auto" controls></audio></div>'
                    output +=   '</div>';
                    output +=   '<div class="row text-dark">';
                    output +=       '<div class="col-lg-9 col-md-12 mx-auto">';
                    output +=           '<p><strong>Date Preached: </strong>'+ data.date_preached +'</p>';
                    output +=           '<p>'+data.description+'</p>';
                    output +=       '</div>';
                    output +=   '</div>';
                    $("#series_message_modal div.modal-body").html(output);
                } else {
                    $("#series_message_modal .modal-body").html(response.message);
                }
            },
            error: function(response){
                toaster_error(response.responseText);
            }
        })
    };
    //console.log(i);
}

del_series = document.querySelector("#delete_series");
if(del_series){
    del_series.onclick = function(e){
        var series_id = e.target.dataset['id'];
    
        $.ajax({
            type: "DELETE",
            url: API_URL+"series/"+series_id,
            dataType: "json",
            headers: {
                "Authorization": "Bearer "+localStorage.getItem('token'),
                "Content-Type": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    toaster_success(response.message);
    
                    window.location = ADMIN_URL+"message-series";
                } else {
                    toaster_error(response.message);
                }
            },
            error: function(response){
                toaster_error(response.responseText);
            }
        })
    }
}

$("form.event_form").submit(function(e){
    e.preventDefault();

    var event = $("input#event_event").val();
    var theme = $("input#event_theme").val();
    var start_date = $("input#start_date").val();
    var end_date = $("input#end_date").val();
    var venue = $("textarea#event_venue").val();
    var timing = $("textarea#event_time");
    var image_files = $("#image_upload")[0].files;
    var data_id = e.target.dataset['id'];

    if((event == "") || (theme == "") || (start_date == "") || (venue == "") || (timing == "")){
        var error_message = "";
        if(event == ""){
            error_message += "Event must be stated! ";
        }
        if(theme == ""){
            error_message += "Theme must be provided! ";
        }
        if(start_date == ""){
            error_message += "Event Start Date must be provided! ";
        }
        if(venue == ""){
            error_message += "Venue must be provided! ";
        }
        if(timing == ""){
            error_message += "Event's Time must be provided! ";
        }
        toaster_error(error_message);
        return false;
    }

    if((end_date != "") && (start_date > end_date)){
        toaster_error("Start Date must not be later than End date!");
        return false;
    }

    if(data_id == ""){
        if(image_files.length < 1){
            toaster_error("Message Album Art must be uploaded! ");
            return false;
        }
        url = API_URL+"events";
    } else {
        url = API_URL+"events/"+data_id;
    }

    if(image_files.length > 0){
        image_file = image_files[0].type;
        if((image_file != "image/jpg") && (image_file != "image/jpeg") && (image_file != "image/png")){
            toaster_error("Wrong Image Filetype");
            return false;
        }
    }

    var fd = new FormData(document.querySelector(".event_form"));
    toaster_success("Event Uploading...");
    $.ajax({
        type: "POST",
        url: url,
        data: fd,
        dataType: "json",
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            "Authorization": "Bearer "+localStorage.getItem('token')
        },
        success: function(response){
            if(response.status == "success"){
                toaster_success(response.message);
                if(data_id == ""){
                    window.location = ADMIN_URL+"events";
                } else {
                    window.location = ADMIN_URL+"events/"+response.data.slug
                }
            } else {
                toaster_error(response.message);
            }
        },
        error: function(response){
            console.log(response.responseText);
            toaster_error(response.responseText);
        }
    })
});

del_event = document.querySelector("#delete_event");
if(del_event){
    del_event.onclick = function(e){
        var event_id = e.target.dataset['id'];

        $.ajax({
            type: "DELETE",
            url: API_URL+"events/"+event_id,
            dataType: "json",
            headers: {
                "Authorization": "Bearer "+localStorage.getItem('token'),
                "Content-Type": "application/json" 
            },
            success: function(response){
                if(response.status == "success"){
                    toaster_success(response.message);
    
                    window.location = ADMIN_URL+"events";
                } else {
                    toaster_error(response.message);
                }
            },
            error: function(response){
                toaster_error(response.responseText);
            }
        })
    }
}

$("form.message_form").submit(function(e){
    e.preventDefault();

    var title = $("input#message_title").val();
    var minister = $("select#message_minister").val();
    var image_files = $('#image_upload')[0].files;
    var audio_files = $("input#audio_upload")[0].files;
    var data_id = e.target.dataset['id'];
    if(data_id == ""){
        if((title == "") || (minister == "") || (image_files.length < 1) || (audio_files.length < 1)){
            var error_message = "";
            if(title == ""){
                error_message += "Message Title must be provided! ";
            }
            if(minister == ""){
                error_message += "Minister must be provided! ";
            }
            if(image_files.length < 1){
                error_message += "Message Album Art must be uploaded! ";
            }
            if(audio_files.length < 1){
                error_message += "Message Audio File must be uploaded! ";
            }
            toaster_error(error_message);
            return false;
        }

        image_file = image_files[0].type;
        if((image_file != "image/jpg") && (image_file != "image/jpeg") && (image_file != "image/png")){
            toaster_error("Wrong Image Filetype");
            return false;
        }

        audio_file = audio_files[0].type;
        if((audio_file != "audio/mp3") && (audio_file != "audio/mpeg3") && (audio_file != "audio/mpeg")){
            toaster_error("Wrong Audio File upload");
            console.log(audio_file);
            return false;
        }

        url = API_URL+"messages";
    } else {
        if((title == "") || (minister == "")){
            var error_message = "";
            if(title == ""){
                error_message += "Message Title must be provided! ";
            }
            if(minister == ""){
                error_message += "Minister must be provided! ";
            }
            toaster_error(error_message);
            return false;
        }

        if(image_files.length > 0){
            image_file = image_files[0].type;
            if((image_file != "image/jpg") && (image_file != "image/jpeg") && (image_file != "image/png")){
                toaster_error("Wrong Image Filetype");
                return false;
            }
        }
        
        if(audio_files.length > 0){
            audio_file = audio_files[0].type;
            if((audio_file != "audio/mp3") && (audio_file != "audio/mpeg3") && (audio_file != "audio/mpeg")){
                toaster_error("Wrong Audio File upload");
                return false;
            }
        }
        
        url = API_URL+"messages/"+data_id;
    }
    var fd = new FormData(document.querySelector(".message_form"));
    toaster_success("Message Uploading...");
    $.ajax({
        type: "POST",
        url: url,
        data: fd,
        dataType: "json",
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            "Authorization": "Bearer "+localStorage.getItem('token')
        },
        success: function(response){
            if(response.status == "success"){
                toaster_success(response.message);
                if(data_id == ""){
                    var redirect = $("input#redirect");
                    if(redirect){
                        window.location= ADMIN_URL+"message-series/"+redirect.val();
                    } else {
                        window.location = ADMIN_URL+"messages";
                    }
                } else {
                    window.location = ADMIN_URL+"messages/"+response.data.slug
                }
            } else {
                toaster_error(response.message);
            }
        },
        error: function(response){
            console.log(response.responseText);
            toaster_error(response.responseText);
        }
    })
});

del_message = document.querySelector("#delete_message");
if(del_message){
    del_message.onclick = function(e){
        var msg_id = e.target.dataset['id'];
    
        $.ajax({
            type: "DELETE",
            url: API_URL+"messages/"+msg_id,
            dataType: "json",
            headers: {
                "Authorization": "Bearer "+localStorage.getItem('token'),
                "Content-Type": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    toaster_success(response.message);
    
                    window.location = ADMIN_URL+"messages";
                } else {
                    toaster_error(response.message);
                }
            },
            error: function(response){
                toaster_error(response.responseText);
            }
        })
    }
}

$("form.magazine_form").submit(function(e){
    e.preventDefault();

    var title = $("input#magazine_title").val();
    var publication_date = $("input#publication_date").val();
    var summary = $("textarea#magazine_summary").val();
    var image_files = $('#image_upload')[0].files;
    var pdf_files = $("input#pdf_upload")[0].files;
    var data_id = e.target.dataset['id'];

    if((title == "") || (publication_date == "") || (summary == "")){
        var error_message = "";
        if(title == ""){
            error_message += "Magazine Title must be provided! ";
        }
        if(publication_date == ""){
            error_message += "Magazine Publication Date must be selected! ";
        }
        if(summary == ""){
            error_message += "Magazine Summary must be provided";
        }
        toaster_error(error_message);
        return false;
    }

    if(data_id == ""){
        if((image_files.length < 1) || (pdf_files.length < 1)){
            var error_message = ""
            if(image_files.length < 1){
                error_message += "Magazine Cover Photo must be uploaded! ";
            }
            if(pdf_files.length < 1){
                error_message += "Magazine PDF File must be uploaded! ";
            }
            toaster_error(error_message);
            return false;
        }
        url = API_URL+"magazines";
    } else {
        url = API_URL+"magazines/"+data_id;
    }

    if(image_files.length > 0){
        var image_file = image_files[0].type;
        if((image_file != "image/jpg") && (image_file != "image/jpeg") && (image_file != "image/png")){
            toaster_error("Wrong Image Filetype");
            return false;
        }
    }
    
    if(pdf_files.length > 0){
        var pdf_file = pdf_files[0].type;
        if(pdf_file != "application/pdf"){
            toaster_error("Wrong File Format Uploaded for Books");
            return false;
        }
    }

    var fd = new FormData(document.querySelector(".magazine_form"));
    toaster_success("Magazine Uploading...");

    $.ajax({
        type: "POST",
        url: url,
        data: fd,
        dataType: "json",
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            "Authorization": "Bearer "+localStorage.getItem('token')
        },
        success: function(response){
            if(response.status == "success"){
                toaster_success(response.message);
                if(data_id == ""){
                    window.location = ADMIN_URL+"magazines";
                } else {
                    window.location = ADMIN_URL+"magazines/"+response.data.slug;
                }
            } else {
                toaster_error(response.message);
            }
        },
        error: function(response){
            console.log(response.responseText);
            toaster_error(response.responseText);
        }
    })
});

del_magazine = document.querySelector("#delete_magazine");
if(del_magazine){
    del_magazine.onclick = function(e){
        var magazine_id = e.target.dataset['id'];

        $.ajax({
            type: "DELETE",
            url: API_URL+"magazines/"+magazine_id,
            dataType: "json",
            headers: {
                "Authorization": "Bearer "+localStorage.getItem('token'),
                "Content-Type": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    toaster_success(response.message);

                    window.location = ADMIN_URL+"magazines";
                } else {
                    toaster_error(response.message);
                }
            },
            error: function(response){
                toaster_error(response.responseText);
            }
        });
    }
}

$("form.book_form").submit(function(e){
    e.preventDefault();

    var title = $("input#book_title").val();
    var minister = $("select#book_author").val();
    var image_files = $('#image_upload')[0].files;
    var pdf_files = $("input#pdf_upload")[0].files;
    var data_id = e.target.dataset['id'];

    if(data_id == ""){
        if((title == "") || (minister == "") || (image_files.length < 1) || (pdf_files.length < 1)){
            var error_message = "";
            if(title == ""){
                error_message += "Book Title must be provided! ";
            }
            if(minister == ""){
                error_message += "Author must be provided! ";
            }
            if(image_files.length < 1){
                error_message += "Book Cover Image must be uploaded! ";
            }
            if(pdf_files.length < 1){
                error_message += "Book PDF File must be uploaded! ";
            }
            toaster_error(error_message);
            return false;
        }

        image_file = image_files[0].type;
        if((image_file != "image/jpg") && (image_file != "image/jpeg") && (image_file != "image/png")){
            toaster_error("Wrong Image Filetype");
            return false;
        }

        pdf_file = pdf_files[0].type;
        if(pdf_file != "application/pdf"){
            toaster_error("Wrong File Format Uploaded for Books");
            console.log(audio_file);
            return false;
        }

        url = API_URL+"books";
    } else {
        if((title == "") || (minister == "")){
            var error_message = "";
            if(title == ""){
                error_message += "Book Title must be provided! ";
            }
            if(minister == ""){
                error_message += "Author must be provided! ";
            }
            toaster_error(error_message);
            return false;
        }

        if(image_files.length > 0){
            image_file = image_files[0].type;
            if((image_file != "image/jpg") && (image_file != "image/jpeg") && (image_file != "image/png")){
                toaster_error("Wrong Image Filetype");
                return false;
            }
        }
        
        if(pdf_files.length > 0){
            pdf_file = pdf_files[0].type;
            if(pdf_file != "application/pdf"){
                toaster_error("Wrong File Format Uploaded for Books");
                return false;
            }
        }
        
        url = API_URL+"books/"+data_id;
    }
    var fd = new FormData(document.querySelector(".book_form"));
    toaster_success("Book Uploading...");
    $.ajax({
        type: "POST",
        url: url,
        data: fd,
        dataType: "json",
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            "Authorization": "Bearer "+localStorage.getItem('token')
        },
        success: function(response){
            if(response.status == "success"){
                toaster_success(response.message);
                if(data_id == ""){
                    window.location= ADMIN_URL+"books"
                } else {
                    window.location = ADMIN_URL+"books/"+response.data.slug
                }
            } else {
                toaster_error(response.message);
            }
        },
        error: function(response){
            console.log(response.responseText);
            toaster_error(response.responseText);
        }
    })
});

del_book = document.querySelector("#delete_book");
if(del_book){
    del_book.onclick = function(e){
        var book_id = e.target.dataset['id'];
    
        $.ajax({
            type: "DELETE",
            url: API_URL+"books/"+book_id,
            dataType: "json",
            headers: {
                "Authorization": "Bearer "+localStorage.getItem('token'),
                "Content-Type": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    toaster_success(response.message);
    
                    window.location = ADMIN_URL+"books";
                } else {
                    toaster_error(response.message);
                }
            },
            error: function(response){
                toaster_error(response.responseText);
            }
        })
    }
}

$("form.devotional_form").submit(function(e){
    e.preventDefault(e);

    var dev_date = $("input#devotional_date").val();
    var minister = $("select#minister_id").val();
    var topic = $("input#topic").val();
    var bible_text = $("input#bible_text").val();
    var memory_verse_text = $("input#memory_verse_text").val();
    var memory_verse = $("textarea#memory_verse").val();
    var devotional = $("textarea#devotional").val();

    if((dev_date == "") || (minister == "") || (topic == "") || (bible_text == "") || (memory_verse_text == "") || (memory_verse == "") || (devotional == "")){
        var error_message = "";
        if(dev_date == ""){
            error_message += "Devotional Date must be selected! ";
        }
        if(minister == ""){
            error_message += "Minister must be selected! ";
        }
        if(bible_text == ""){
            error_message += "Bible Text must be provided! ";
        }
        if(memory_verse_text == ""){
            error_message += "Memory Verse Reference must be provided! ";
        }
        if(memory_verse == ""){
            error_message += "Memory Verse must be provided! ";
        }
        if(devotional == ""){
            error_message += "Devotional must  be provided!";
        }
        toaster_error(error_message);
        return false;
    } else {
        var data_id = e.target.dataset['id'];

        if(data_id == ""){
            var url = API_URL+"devotionals";
            var method = "POST";
        } else {
            var url = API_URL+"devotionals/"+data_id;
            var method = "POST";
        }

        var fd = new FormData(document.querySelector(".devotional_form"));
        // console.log(method);
        // console.log(url);
        // console.log(fd.get());

        $.ajax({
            type: method,
            url: url,
            data: fd,
            dataType: "json",
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Authorization": "Bearer "+localStorage.getItem('token')
            },
            success: function(response){
                if(response.status == "success"){
                    toaster_success(response.message);
                    if(data_id == ""){
                        window.location= ADMIN_URL+"devotionals"
                    } else {
                        window.location = ADMIN_URL+"devotionals/"+response.data.slug
                    }
                } else {
                    toaster_error(response.message);
                }
            },
            error: function(response){
                console.log(response.responseText);
                toaster_error(response.responseText);
            }
        })
    }
});

del_dev = document.querySelector("#delete_devotional");
if(del_dev){
    del_dev.onclick = function(e){
        var dev_id = e.target.dataset['id'];
    
        $.ajax({
            type: "DELETE",
            url: API_URL+"devotionals/"+dev_id,
            dataType: "json",
            headers: {
                "Authorization": "Bearer "+localStorage.getItem('token'),
                "Content-Type": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    toaster_success(response.message);
    
                    window.location = ADMIN_URL+"devotionals";
                } else {
                    toaster_error(response.message);
                }
            },
            error: function(response){
                toaster_error(response.responseText);
            }
        })
    }
}

var video_forms = document.querySelectorAll(".video_form");
for(let i=0; i < video_forms.length; i++){
    video_form = video_forms[i];

    video_form.onsubmit = function(e){
        e.preventDefault();

        var title = $("input#video_title").val();
        var platform = $("select#video_platform").val();
        var link = $("input#video_link").val();

        if((title == "") || (platform == "") || (link == "")){
            var error_message = "";
            if(title == ""){
                error_message += "Video must have a Title! ";
            }
            if(platform == ""){
                error_message += "Video Platform must be provided";
            }
            if(link == ""){
                error_message += "Video Link must be provided";
            }
            toaster_error(error_message);
            return false;
        } else {
            var data_id = e.target.dataset['id'];

            if(data_id == ""){
                var url = API_URL+"videos";
            } else {
                var url = API_URL+"videos/"+data_id;
            }

            var fd = new FormData(e.target);

            $.ajax({
                type: "POST",
                url: url,
                data: fd,
                dataType: "json",
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    "Authorization": "Bearer "+localStorage.getItem('token')
                },
                success: function(response){
                    if(response.status == "success"){
                        toaster_success(response.message);
                        if(data_id == ""){
                            window.location= ADMIN_URL+"videos"
                        } else {
                            var page = $("input#video_page").val();
                            window.location = ADMIN_URL+"videos?page="+page
                        }
                    } else {
                        toaster_error(response.message);
                    }
                },
                error: function(response){
                    console.log(response.responseText);
                    toaster_error(response.responseText);
                }
            })
        }
    }
}

var video_del_buttons = document.querySelectorAll(".delete_video");
for(let i=0; i < video_del_buttons.length; i++){
    del_button = video_del_buttons[i];

    del_button.onclick = function(e){
        var video_id = e.target.dataset['id'];

        $.ajax({
            type: "DELETE",
            url: API_URL+"videos/"+video_id,
            dataType: "json",
            headers: {
                "Authorization": "Bearer "+localStorage.getItem('token'),
                "Content-Type": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    toaster_success("Deleting Video...");

                    function redirect(){
                        window.location = ADMIN_URL+"videos";
                    }

                    setTimeout(redirect(), 2500);
                } else {
                    toaster_success(response.message);
                }
            },
            error: function(response){
                console.log(response.responseText);
                toaster_error(response.responseText);
            }
        })
    }
}

$("form.article_form").submit(function(e){
    e.preventDefault();

    var title = $("input#article_title").val();
    var author = $("input#article_author").val();
    var article = $("textarea#article_article").val();
    var image_files = $('#image_upload')[0].files;
    var published = $("input#article_published").val();
    var data_id = e.target.dataset['id'];

    if(data_id == ""){
        if((title == "") || (author == "") || (article == "") || (published == "") || (image_files.length < 1)){
            var error_message = "";
            if(title == ""){
                error_message += "Article Title must be provided! ";
            }
            if(author == ""){
                error_message += "Author must be provided! ";
            }
            if(article == ""){
                error_message += "Article must be provided! ";
            }
            if(published == ""){
                error_message += "Article's Published Date must be provided! ";
            }
            if(image_files.length < 1){
                error_message += "Article Image must be uploaded! ";
            }
            toaster_error(error_message);
            return false;
        }

        var image_file = image_files[0].type;
        if((image_file != "image/jpg") && (image_file != "image/jpeg") && (image_file != "image/png")){
            toaster_error("Wrong Image Filetype");
            return false;
        }

        url = API_URL+"articles";
    } else {
        if((title == "") || (author == "") || (article == "") || (published == "")){
            var error_message = "";
            if(title == ""){
                error_message += "Article Title must be provided! ";
            }
            if(author == ""){
                error_message += "Author must be provided! ";
            }
            if(article == ""){
                error_message += "Article must be provided! ";
            }
            if(published == ""){
                error_message += "Article's Published Date must be provided! ";
            }
            if(image_files.length < 1){
                error_message += "Article Image must be uploaded! ";
            }
            toaster_error(error_message);
            return false;
        }

        if(image_files.length > 0){
            image_file = image_files[0].type;
            if((image_file != "image/jpg") && (image_file != "image/jpeg") && (image_file != "image/png")){
                toaster_error("Wrong Image Filetype");
                return false;
            }
        }
        
        url = API_URL+"articles/"+data_id;
    }
    var fd = new FormData(document.querySelector(".article_form"));
    toaster_success("Article Uploading...");
    $.ajax({
        type: "POST",
        url: url,
        data: fd,
        dataType: "json",
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            "Authorization": "Bearer "+localStorage.getItem('token')
        },
        success: function(response){
            if(response.status == "success"){
                toaster_success(response.message);
                if(data_id == ""){
                    window.location= ADMIN_URL+"articles"
                } else {
                    window.location = ADMIN_URL+"articles/"+response.data.slug
                }
            } else {
                toaster_error(response.message);
            }
        },
        error: function(response){
            console.log(response.responseText);
            toaster_error(response.responseText);
        }
    })
});

var quote_forms = document.querySelectorAll(".quote_form");
for(let i=0; i < quote_forms.length; i++){
    var quote_form = quote_forms[i];

    quote_form.onsubmit = function(e){
        e.preventDefault();

        var quote = $("#quote_quote").val();
        var author = $("#quote_author").val();
        var title = $("#author_title").val();
        var data_id = e.target.dataset['id'];
        if((quote == "") || (author == "") || (title == "")){
            var error_message = "";
            if(quote == ""){
                error_message += "Quote must be provided! ";
            }
            if(author == ""){
                error_message += "Author must be provided! ";
            }
            if(title == ""){
                error_message += "Author's Title must be provided! ";
            }
            toaster_error(error_message);
            return false;
        }

        if(data_id == ""){
            url = API_URL+"quotes";
        } else {
            url = API_URL+"quotes/"+data_id;
        }

        var fd = new FormData(e.target);
        toaster_success("Quote Uploading...");
        $.ajax({
            type: "POST",
            url: url,
            data: fd,
            dataType: "json",
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Authorization": "Bearer "+localStorage.getItem('token')
            },
            success: function(response){
                if(response.status == "success"){
                    toaster_success(response.message);
                    window.location = ADMIN_URL;
                } else {
                    toaster_error(response.message);
                }
            },
            error: function(response){
                console.log(response.responseText);
                toaster_error(response.responseText);
            }
        })
    }
}

var quote_del_buttons = document.querySelectorAll(".delete_quote");
for(let i = 0; i < quote_del_buttons.length; i++){
    del_button = quote_del_buttons[i];

    del_button.onclick = function(e){
        var quote_id = e.target.dataset['id'];

        $.ajax({
            type: "DELETE",
            url: API_URL+"quotes/"+quote_id,
            dataType: "json",
            headers: {
                "Authorization": "Bearer "+localStorage.getItem('token'),
                "Content-Type": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    toaster_success("Deleting Quote...");

                    function redirect(){
                        window.location = ADMIN_URL;
                    }

                    setTimeout(redirect(), 2500);
                } else {
                    toaster_error(response.message);
                }
            },
            error: function(response){
                console.log(response.responseText);
                toaster_error(response.responseText);
            }
        });
    }
}

var del_article = document.querySelector("#delete_article");
if(del_article){
    del_article.onclick = function(e){
        var article_id = e.target.dataset['id'];
    
        $.ajax({
            type: "DELETE",
            url: API_URL+"articles/"+article_id,
            dataType: "json",
            headers: {
                "Authorization": "Bearer "+localStorage.getItem('token'),
                "Content-Type": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    toaster_success(response.message);
    
                    window.location = ADMIN_URL+"articles";
                } else {
                    toaster_error(response.message);
                }
            },
            error: function(response){
                toaster_error(response.responseText);
            }
        })
    }
}

$("form.photo_form").on("submit", function(e){
    e.preventDefault();

    var caption = $("input#article_title").val();
    var image_files = $('#image_upload')[0].files;
    var data_id = e.target.dataset['id'];

    if(data_id == ""){
        if((caption == "") || (image_files.length < 1)){
            var error_message = "";
            if(caption == ""){
                error_message += "Photo Caption must be provided! ";
            }
            if(image_files.length < 1){
                error_message += "Phot was not Uploaded! ";
            }
            toaster_error(error_message);
            return false;
        }

        image_file = image_files[0].type;
        if((image_file != "image/jpg") && (image_file != "image/jpeg") && (image_file != "image/png")){
            toaster_error("Wrong Image Filetype");
            return false;
        }

        url = API_URL+"photos";
    } else {
        if(caption == ""){
            toaster_error('Photo Caption must be provided');
        }

        if(image_files.length > 0){
            image_file = image_files[0].type;
            if((image_file != "image/jpg") && (image_file != "image/jpeg") && (image_file != "image/png")){
                toaster_error("Wrong Image Filetype");
                return false;
            }
        }
        
        url = API_URL+"photos/"+data_id;
    }
    var fd = new FormData(document.querySelector(".photo_form"));
    toaster_success("Photo Uploading...");
    $.ajax({
        type: "POST",
        url: url,
        data: fd,
        dataType: "json",
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            "Authorization": "Bearer "+localStorage.getItem('token')
        },
        success: function(response){
            if(response.status == "success"){
                toaster_success(response.message);
                if(data_id == ""){
                    window.location= ADMIN_URL+"photos"
                } else {
                    window.location = ADMIN_URL+"photos/"+response.data.slug
                }
            } else {
                toaster_error(response.message);
            }
        },
        error: function(response){
            console.log(response.responseText);
            toaster_error(response.responseText);
        }
    })
});

$("form.welcome_message_form").on("submit", function(e){
    e.preventDefault();

    var heading = $("input#welcome_heading").val();
    var content = $("textarea#welcome_content").val();
    var image_files = $("input#image_upload")[0].files;

    if((heading == "") || (content == "") || (image_files.length < 1)){
        var error_message = "";
        if(heading == ""){
            error_message += "Heading must be provided! ";
        }
        if(content == ""){
            error_message += "Welcome Message must be procided! ";
        }
        toaster_error(error_message);
    }

    if(image_files.length > 0){
        image_file = image_files[0].type;
        if((image_file != "image/jpg") && (image_file != "image/jpeg") && (image_file != "image/png")){
            toaster_error("Wrong Image Filetype");
            return false;
        }
    }

    var fd = new FormData(document.querySelector(".welcome_message_form"));
    toaster_success("Welcome Message Uploading...");
    $.ajax({
        type: "POST",
        url: API_URL+"welcoming",
        data: fd,
        dataType: "json",
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            "Authorization": "Bearer "+localStorage.getItem('token')
        },
        success: function(response){
            if(response.status == "success"){
                toaster_success(response.message);
                window.location = ADMIN_URL;
            } else {
                toaster_error(response.message);
            }
        },
        error: function(response){
            console.log(response.responseText);
            toaster_error(response.responseText);
        }
    })
});

var del_photo = document.querySelector("#delete_photo");
if(del_photo){
    del_photo.onclick = function(e){
        var photo_id = e.target.dataset['id'];
    
        $.ajax({
            type: "DELETE",
            url: API_URL+"photos/"+photo_id,
            dataType: "json",
            headers: {
                "Authorization": "Bearer "+localStorage.getItem('token'),
                "Content-Type": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    toaster_success(response.message);
    
                    window.location = ADMIN_URL+"photos";
                } else {
                    toaster_error(response.message);
                }
            },
            error: function(response){
                toaster_error(response.responseText);
            }
        })
    }
}

var header_forms = document.querySelectorAll(".header_form");
for(let i=0; i < header_forms.length; i++){
    header_form = header_forms[i];

    header_form.onsubmit = function(e){
        e.preventDefault();

        var page = $("input#page_page").val();
        var title = $("input#page_title").val();

        if((page == "") || (title == "")){
            var error_message = "";
            if(page == ""){
                error_message += "Page must be provided! ";
            }
            if(title == ""){
                error_message += "Page Title must be provided! ";
            }
            toaster_error(error_message);
            return false;
        }

        var data_id = e.target.dataset['id'];
        if(data_id == ""){
            var url = API_URL+"page_headers"
        } else {
            var url = API_URL+"page_headers/"+data_id;
        }

        var fd = new FormData(e.target);

        $.ajax({
            type: "POST",
            url: url,
            data: fd,
            dataType: "json",
            processData: false,
            contentType: false,
            headers: {
                'x-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Authorization": "Bearer "+localStorage.getItem('token')
            },
            success: function(response){
                if(response.status == "success"){
                    window.location = ADMIN_URL+"page_headers";
                } else {
                    toaster_error(response.message);
                }
            },
            error: function(response){
                console.log(response.responseText);
                toaster_error(response.responseText);
            }
        });
    }
}

var pageheader_del_buttons = document.querySelectorAll(".delete_pageheader");
for(let i=0; i<pageheader_del_buttons.length; i++){
    del_button = pageheader_del_buttons[i];

    del_button.onclick = function(e){
        var header_id = e.target.dataset['id'];

        $.ajax({
            type: "DELETE",
            url: API_URL+"page_headers/"+header_id,
            dataType: "json",
            headers: {
                "Authorization": "Bearer "+localStorage.getItem('token'),
                "Content-Type": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    toaster_success("Deleting Page Header...");

                    function redirect(){
                        window.location = ADMIN_URL+"page_headers";
                    }

                    setTimeout(redirect(), 2500);
                } else {
                    toaster_error(response.message);
                }
            },
            error: function(response){
                console.log(response.responseText);
                toaster_error(response.responseText);
            }
        })
    }
}

var about_forms = document.querySelectorAll(".about_us_form");
for(let i=0; i < about_forms.length; i++){
    about_form = about_forms[i];

    about_form.onsubmit = function(e){
        e.preventDefault();

        var position = $("select#about_position").val();
        var heading = $("input#about_heading").val();
        var content = $("textarea#about_content").val();

        if((position == "") || (heading == "") || (content == "")){
            var error_message = "";
            if(position == ""){
                error_message += "Position must be provided! ";
            }
            if(heading == ""){
                error_message += "Heading must be provided! ";
            }
            if(content == ""){
                error_message += "Content must be provided! ";
            }
            toaster_error(error_message);
            return false;
        }

        var data_id = e.target.dataset['id'];
        if(data_id == ""){
            var url = API_URL+"about-us";
        } else {
            var url = API_URL+"about-us/"+data_id;
        }

        var fd = new FormData(e.target);

        $.ajax({
            type: "POST",
            url: url,
            data: fd,
            dataType: "json",
            processData: false,
            contentType: false,
            headers: {
                'x-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Authorization": "Bearer "+localStorage.getItem('token')
            },
            success: function(response){
                if(response.status == "success"){
                    window.location = ADMIN_URL+"about-us";
                } else {
                    toaster_error(response.message);
                }
            },
            error: function(response){
                console.log(response.responseText);
                toaster_error(response.responseText);
            }
        });
    }
}

var about_del_buttons = document.querySelectorAll(".delete_about");
for(let i=0; i < about_del_buttons.length; i++){
    del_button = about_del_buttons[i];

    del_button.onclick = function(e){
        var about_id = e.target.dataset['id'];

        $.ajax({
            type: "DELETE",
            url: API_URL+"about-us/"+about_id,
            dataType: "json",
            headers: {
                "Authorization": "Bearer "+localStorage.getItem('token'),
                "Content-Type": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    toaster_success("Deleting About Us Section...");

                    function redirect(){
                        window.location = ADMIN_URL+"about-us";
                    }

                    setTimeout(redirect(), 2500);
                } else {
                    toaster_error(response.message);
                }
            },
            error: function(response){
                console.log(response.responseText);
                toaster_error(response.responseText);
            }
        })
    }
}

var about_photo_del_buttons = document.querySelectorAll(".delete_about_photo");
for(let i=0; i < about_photo_del_buttons.length; i++){
    del_button = about_photo_del_buttons[i];

    del_button.onclick = function(e){
        var about_id = e.target.dataset['id'];

        $.ajax({
            type: "DELETE",
            url: API_URL+"about-us/photos/"+about_id,
            dataType: "json",
            headers: {
                "Authorization": "Bearer "+localStorage.getItem('token'),
                "Content-Type": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    toaster_success("Deleting Image...");

                    function redirect(){
                        window.location = ADMIN_URL+"about-us";
                    }

                    setTimeout(redirect(), 2500);
                } else {
                    toaster_error(response.message);
                }
            },
            error: function(response){
                console.log(response.responseText);
                toaster_error(response.responseText);
            }
        })
    }
}

var slider_forms = document.querySelectorAll(".slider_form");
for(let i=0; i < slider_forms.length; i++){
    slider_form = slider_forms[i];

    slider_form.onsubmit = function(e){
        e.preventDefault();
        
        var position = $("select#slider_position").val();
        var caption = $("input#slider_caption").val();
        var slider_link = $("input#slider_link").val();
        var call_to_action = $("input#slider_call_to_action").val();

        if((position == "") || (caption == "")){
            var error_message = "";
            if(position == ""){
                error_message += "Slider Position must be Selected! ";
            }
            if(caption == ""){
                error_message += "Slider Caption must be Provided! ";
            }
            toaster_error(error_message);
            return false;
        }

        if((slider_link != "") && (call_to_action == "")){
            error_message = "Call To Action must be provided if Link is Provided! ";
            toaster_error(error_message);
            return false;
        }

        var data_id = e.target.dataset['id'];
        if(data_id == ""){
            var url = API_URL+"home_sliders"
        } else {
            var url = API_URL+"home_sliders/"+data_id;
        }

        var fd = new FormData(e.target);

        $.ajax({
            type: "POST",
            url: url,
            data: fd,
            dataType: "json",
            processData: false,
            contentType: false,
            headers: {
                'x-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Authorization": "Bearer "+localStorage.getItem('token')
            },
            success: function(response){
                if(response.status == "success"){
                    window.location = ADMIN_URL;
                } else {
                    toaster_error(response.message);
                }
            },
            error: function(response){
                console.log(response.responseText);
                toaster_error(response.responseText);
            }
        });
    }
}

var slider_del_buttons = document.querySelectorAll(".delete_homeslider");
for(let i=0; i < slider_del_buttons.length; i++){
    del_button = slider_del_buttons[i];

    del_button.onclick = function(e){
        var header_id = e.target.dataset['id'];

        $.ajax({
            type: "DELETE",
            url: API_URL+"home_sliders/"+header_id,
            dataType: "json",
            headers: {
                "Authorization": "Bearer "+localStorage.getItem('token'),
                "Content-Type": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    toaster_success("Deleting Home Slider...");

                    function redirect(){
                        window.location = ADMIN_URL;
                    }

                    setTimeout(redirect(), 2500);
                } else {
                    toaster_error(response.message);
                }
            },
            error: function(response){
                console.log(response.responseText);
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

if($("table#series_table")){
    $('#series_table').DataTable({
        order: [[2, 'desc']],
    });
}

if($("textarea#article_article")){
    $('#article_article').summernote();
}

if($("textarea#devotional")){
    $('textarea#devotional').summernote();
}

if($("textarea#welcome_message")){
    $('textarea#welcome_message').summernote();
}