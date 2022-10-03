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
            "Authorization": "Bearer "+sessionStorage.getItem('token'),
            "Content-Type": "application/json"
        },
        success: function(response){
            sessionStorage.setItem("token", "");
            sessionStorage.setItem("name", "");
            sessionStorage.setItem("email", "");
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
                "Authorization": "Bearer "+sessionStorage.getItem('token')
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
                "Authorization": "Bearer "+sessionStorage.getItem('token'),
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
                "Authorization": "Bearer "+sessionStorage.getItem('token')
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
                "Authorization": "Bearer "+sessionStorage.getItem('token'),
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
                "Authorization": "Bearer "+sessionStorage.getItem('token'),
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
            "Authorization": "Bearer "+sessionStorage.getItem('token')
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
                "Authorization": "Bearer "+sessionStorage.getItem('token'),
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
            "Authorization": "Bearer "+sessionStorage.getItem('token')
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
                "Authorization": "Bearer "+sessionStorage.getItem('token'),
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
                "Authorization": "Bearer "+sessionStorage.getItem('token')
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
                "Authorization": "Bearer "+sessionStorage.getItem('token'),
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
                    "Authorization": "Bearer "+sessionStorage.getItem('token')
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
                "Authorization": "Bearer "+sessionStorage.getItem('token'),
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

        image_file = image_files[0].type;
        if((image_file != "image/jpg") && (image_file != "image/jpeg") && (image_file != "image/png")){
            toaster_error("Wrong Image Filetype");
            return false;
        }

        url = API_URL+"articles";
    } else {
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
            "Authorization": "Bearer "+sessionStorage.getItem('token')
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

del_article = document.querySelector("#delete_article");
if(del_article){
    del_article.onclick = function(e){
        var article_id = e.target.dataset['id'];
    
        $.ajax({
            type: "DELETE",
            url: API_URL+"articles/"+article_id,
            dataType: "json",
            headers: {
                "Authorization": "Bearer "+sessionStorage.getItem('token'),
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