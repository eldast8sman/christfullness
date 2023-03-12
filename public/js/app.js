// var BASE_URL = "https://www.cfcing.org/";
var BASE_URL = "http://127.0.0.1:8000/";
var API_URL = BASE_URL + "api/";

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