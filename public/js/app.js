// var BASE_URL = "https://www.cfcing.org/";
var BASE_URL = "http://127.0.0.1:8000/";
var API_URL = BASE_URL + "api/";

function html_decode(text) {
    return $("<textarea/>")
        .html(text)
        .text();
}

$(".popup-gallery").magnificPopup({
    delegate: 'a',
    type: 'image',
    tLoading: 'Loading image #%curr%...',
    mainClass: 'mfp-img-mobile',
    gallery: {
        enabled: true,
        navigateByImgClick: true,
        preload: [0,1] 
    }
})

$("button#submit_contact").on("click", function(e){
    e.preventDefault();

    $(".error_message").remove();
    var name = $("input#name");
    var email = $("input#email");
    var subject = $("input#subject");
    var message = $("textarea#message");

    if((name.val() == "") || (email.val() == "") || (subject.val() == "") || (message.val() == "")){
        if(name.val() == ""){
            name.after('<p class="error_message text-danger">You must provide your Name</p>');
        }
        if(email.val() == ""){
            email.after('<p class="error_message text-danger">You must provide your Email</p>')
        }
        if(subject.val() == ""){
            subject.after('<p class="error_message text-danger">Your Message must have a Subject</p>');
        }
        if(message.val() == ""){
            message.after('<p class="error_message text-danger">Message must be provided</p>');
        }
        return false;
    } else {
        $("button#submit_contact").html("Sending...");
        var req = {
            "name": name.val(),
            "email": email.val(),
            "subject": subject.val(),
            "message": message.val()
        }

        $.ajax({
            type: "POST",
            url: API_URL + "send-message",
            data: req,
            dataType: "json",
            success: function(response){
                if(response.status == "success"){
                    $("button#submit_contact").after('<p class="error_message text-primary">'+response.message+'</p>');

                    $(".error_message").fadeOut(5000);
                } else {
                    $("button#submit_contact").after('<p class="error_message text-danger">'+response.message+'</p>')

                    $(".error_message").fadeOut(5000);
                }
            },
            error: function(response){
                $("button#submit_contact").after('<p class="error_message text-danger">'+response.responseText+'</p>');

                $(".error_message").fadeOut(5000);
            }
        });

        $("button#submit_contact").html("Send Message");
    }
});

$("button#series_search_submit").on("click", function(e){
    $(".response").remove();
    var search = $("input.search_param").val();
    if(search == ""){
        $("div#submit_div").after('<div class="col-12 text-danger response">Please input a Search Parametre!</div>');
    } else {
        $("div#submit_div").after('<div class="col-12 text-danger response">Searching...</div>');
        var url = API_URL+"series/search/"+search;
        $.ajax({
            type: "GET",
            url: url,
            data: "",
            dataType: "json",
            contentType: "application/x-json",
            headers: {
                "Accept": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    window.location = BASE_URL+"media/message-series?search="+search;
                } else {
                    $(".response").remove();
                    $("div#submit_div").after('<div class="col-12 text-danger response">'+response.message+'</div>');
                }
            },
            error: function(response){
                console.log(response.responseText);
            }
        });
    }
});

$("button#message_search_submit").on("click", function(e){
    $(".response").remove();
    var search = $("input.search_param").val();
    if(search == ""){
        $("div#submit_div").after('<div class="col-12 text-danger response">Please input a Search Parametre!</div>');
    } else {
        $("div#submit_div").after('<div class="col-12 text-danger response">Searching...</div>');
        var url = API_URL+"messages/search/"+search;
        $.ajax({
            type: "GET",
            url: url,
            data: "",
            dataType: "json",
            contentType: "application/x-json",
            headers: {
                "Accept": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    window.location = BASE_URL+"media/messages?search="+search;
                } else {
                    $(".response").remove();
                    $("div#submit_div").after('<div class="col-12 text-danger response">'+response.message+'</div>');
                }
            },
            error: function(response){
                console.log(response.responseText);
            }
        });
    }
});

$("button#books_search_submit").on("click", function(e){
    $(".response").remove();
    var search = $("input.search_param").val();
    if(search == ""){
        $("div#submit_div").after('<div class="col-12 text-danger response">Please input a Search Parametre!</div>');
    } else {
        $("div#submit_div").after('<div class="col-12 text-danger response">Searching...</div>');
        var url = API_URL+"books/search/"+search;
        $.ajax({
            type: "GET",
            url: url,
            data: "",
            dataType: "json",
            contentType: "application/x-json",
            headers: {
                "Accept": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    window.location = BASE_URL+"publications/books?search="+search;
                } else {
                    $(".response").remove();
                    $("div#submit_div").after('<div class="col-12 text-danger response">'+response.message+'</div>');
                }
            },
            error: function(response){
                console.log(response.responseText);
            }
        });
    }
});

$("button#magazines_search_submit").on("click", function(e){
    $(".response").remove();
    var search = $("input.search_param").val();
    if(search == ""){
        $("div#submit_div").after('<div class="col-12 text-danger response">Please input a Search Parametre!</div>');
    } else {
        $("div#submit_div").after('<div class="col-12 text-danger response">Searching...</div>');
        var url = API_URL+"magazines/search/"+search;
        $.ajax({
            type: "GET",
            url: url,
            data: "",
            dataType: "json",
            contentType: "application/x-json",
            headers: {
                "Accept": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    window.location = BASE_URL+"publications/magazines?search="+search;
                } else {
                    $(".response").remove();
                    $("div#submit_div").after('<div class="col-12 text-danger response">'+response.message+'</div>');
                }
            },
            error: function(response){
                console.log(response.responseText);
            }
        });
    }
});

$("button#articles_search_submit").on("click", function(e){
    $(".response").remove();
    var search = $("input.search_param").val();
    if(search == ""){
        $("div#submit_div").after('<div class="col-12 text-danger response">Please input a Search Parametre!</div>');
    } else {
        $("div#submit_div").after('<div class="col-12 text-danger response">Searching...</div>');
        var url = API_URL+"articles/search/"+search;
        $.ajax({
            type: "GET",
            url: url,
            data: "",
            dataType: "json",
            contentType: "application/x-json",
            headers: {
                "Accept": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    window.location = BASE_URL+"publications/articles?search="+search;
                } else {
                    $(".response").remove();
                    $("div#submit_div").after('<div class="col-12 text-danger response">'+response.message+'</div>');
                }
            },
            error: function(response){
                console.log(response.responseText);
            }
        });
    }
});

$("button#photo_search_submit").on("click", function(e){
    $(".response").remove();
    var search = $("input.search_param").val();
    if(search == ""){
        $("div#submit_div").after('<div class="col-12 text-danger response">Please input a Search Parametre!</div>');
    } else {
        $("div#submit_div").after('<div class="col-12 text-danger response">Searching...</div>');
        var url = API_URL+"photos/search/"+search;
        $.ajax({
            type: "GET",
            url: url,
            data: "",
            dataType: "json",
            contentType: "application/x-json",
            headers: {
                "Accept": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    window.location = BASE_URL+"media/photos?search="+search;
                } else {
                    $(".response").remove();
                    $("div#submit_div").after('<div class="col-12 text-danger response">'+response.message+'</div>');
                }
            },
            error: function(response){
                console.log(response.responseText);
            }
        });
    }
});

$("button#videos_search_submit").on("click", function(e){
    $(".response").remove();
    var search = $("input.search_param").val();
    if(search == ""){
        $("div#submit_div").after('<div class="col-12 text-danger response">Please input a Search Parametre!</div>');
    } else {
        $("div#submit_div").after('<div class="col-12 text-danger response">Searching...</div>');
        var url = API_URL+"videos/search/"+search;
        $.ajax({
            type: "GET",
            url: url,
            data: "",
            dataType: "json",
            contentType: "application/x-json",
            headers: {
                "Accept": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    window.location = BASE_URL+"media/videos?search="+search;
                } else {
                    $(".response").remove();
                    $("div#submit_div").after('<div class="col-12 text-danger response">'+response.message+'</div>');
                }
            },
            error: function(response){
                console.log(response.responseText);
            }
        });
    }
});

$("button#events_search_submit").on("click", function(e){
    $(".response").remove();
    var search = $("input.search_param").val();
    if(search == ""){
        $("div#submit_div").after('<div class="col-12 text-danger response">Please input a Search Parametre!</div>');
    } else {
        $("div#submit_div").after('<div class="col-12 text-danger response">Searching...</div>');
        var url = API_URL+"events/search/"+search;
        $.ajax({
            type: "GET",
            url: url,
            data: "",
            dataType: "json",
            contentType: "application/x-json",
            headers: {
                "Accept": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    window.location = BASE_URL+"events?search="+search;
                } else {
                    $(".response").remove();
                    $("div#submit_div").after('<div class="col-12 text-danger response">'+response.message+'</div>');
                }
            },
            error: function(response){
                console.log(response.responseText);
            }
        });
    }
});