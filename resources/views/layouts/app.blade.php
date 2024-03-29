<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset("lib/animate/animate.min.css") }}" rel="stylesheet">
    <link href="{{ asset("lib/owlcarousel/assets/owl.carousel.min.css") }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link rel="stylesheet" href="{{ asset("css/magnific-popup.css") }}">
    <link href="{{ asset("css/style.css") }}" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="top-bar row gx-0 align-items-center d-none d-lg-flex">
            <div class="col-lg-6 px-5 text-start">
                <small><i class="fa fa-map-marker-alt me-2"></i>1, Christfullness Close, Ebi's Mechanic Road, Amarata, Yenagoa</small>
                <small class="ms-4"><i class="fa fa-envelope me-2"></i>email@cfci.ng</small>
            </div>
            <div class="col-lg-6 px-5 text-end">
                <small>Follow us:</small>
                <a class="text-body ms-3" href=""><i class="fab fa-facebook-f"></i></a>
                <a class="text-body ms-3" href=""><i class="fab fa-youtube"></i></a>
                <a class="text-body ms-3" href=""><i class="fab fa-instagram"></i></a>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
            <a href="{{ env('APP_URL') }}" class="navbar-brand ms-4 ms-lg-0">
                {{-- <h1 class="fw-bold text-primary m-0">F<span class="text-secondary">oo</span>dy</h1> --}}
                <img src="{{ asset('cfci_logo.png') }}" style="width: 150px; max-width: 40%">
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="{{ env('APP_URL') }}" class="nav-item nav-link active">Home</a>
                    <a href="{{ env('APP_URL') }}/about-us" class="nav-item nav-link">About Us</a>
                    <a href="{{ env('APP_URL') }}/events" class="nav-item nav-link">Events</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Media</a>
                        <div class="dropdown-menu m-0">
                            <a href="{{ env('APP_URL') }}/media/message-series" class="dropdown-item">Message Series</a>
                            <a href="{{ env('APP_URL') }}/media/messages" class="dropdown-item">Messages</a>
                            <a href="{{ env('APP_URL') }}/media/photos" class="dropdown-item">Photos</a>
                            <a href="{{ env('APP_URL') }}/media/videos" class="dropdown-item">Videos</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Publications</a>
                        <div class="dropdown-menu m-0">
                            <a href="{{ env('APP_URL') }}/publications/devotionals" class="dropdown-item">Devotionals</a>
                            <a href="{{ env('APP_URL') }}/publications/books" class="dropdown-item">Books</a>
                            <a href="{{ env('APP_URL') }}/publications/magazines" class="dropdown-item">Magazines</a>
                            <a href="{{ env('APP_URL') }}/publications/articles" class="dropdown-item">Articles</a>
                        </div>
                    </div>
                    <a href="{{ env('APP_URL') }}/contact-us" class="nav-item nav-link">Contact Us</a>
                </div>
                {{-- <div class="d-none d-lg-flex ms-2">
                    <a class="btn-sm-square bg-white rounded-circle ms-3" href="">
                        <small class="fa fa-search text-body"></small>
                    </a>
                    <a class="btn-sm-square bg-white rounded-circle ms-3" href="">
                        <small class="fa fa-user text-body"></small>
                    </a>
                    <a class="btn-sm-square bg-white rounded-circle ms-3" href="">
                        <small class="fa fa-shopping-bag text-body"></small>
                    </a>
                </div> --}}
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    @yield('content')

    <!-- Footer Start -->
    <div class="container-fluid bg-dark footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    {{-- <h1 class="fw-bold text-primary mb-4">F<span class="text-secondary">oo</span>dy</h1> --}}
                    <img src="{{ asset('cfci_logo.png') }}" style="width: 300px; max-width: 40%; margin-top: -20px; margin-bottom: 20px">
                    <p>You can connect with us through our social media handles</p>
                    <div class="d-flex pt-2">
                        {{-- <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i class="fab fa-twitter"></i></a> --}}
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-0" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Address</h4>
                    <p><i class="fa fa-map-marker-alt me-3"></i>1, Christfullness Close, Ebi's Mechanic Road, Amarata, Yenagoa, Bayelsa State, Nigeria</p>
                    <p><i class="fa fa-phone-alt me-3"></i>+234 (0) 701 701 9879</p>
                    <p><i class="fa fa-envelope me-3"></i>info@example.com</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Quick Links</h4>
                    <a class="btn btn-link" href="{{ env('APP_URL') }}/about-us">About Us</a>
                    <a class="btn btn-link" href="{{ env('APP_URL') }}/media/messages">Messages</a>
                    <a class="btn btn-link" href="{{ env('APP_URL') }}/publications/devotionals">Devotionals</a>
                    <a class="btn btn-link" href="{{ env('APP_URL') }}/publications/books">Books</a>
                    <a class="btn btn-link" href="{{ env('APP_URL') }}/contact-us">Contact Us</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Newsletter</h4>
                    <p>You can recieve latest updates from us</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="email" id="newsletter_email" placeholder="Your email">
                        <button type="button" id="newsletter_button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a href="https://cfci.ng">Christfullness Church Int'l</a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a href="https://omotolaniolurotimi.com">Omotolani Olurotimi</a>
                        {{-- <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset("lib/wow/wow.min.js") }}"></script>
    <script src="{{ asset("lib/easing/easing.min.js") }}"></script>
    <script src="{{ asset("lib/waypoints/waypoints.min.js") }}"></script>
    <script src="{{ asset("lib/owlcarousel/owl.carousel.min.js") }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset("js/magnific-popup.js") }}"></script>
    <script src="{{ asset("js/main.js") }}"></script>
    <script src="{{ asset("js/app.js") }}"></script>
</body>

</html>