<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset("admin/images/favicon.png") }}">
    <link rel="stylesheet" href="{{ asset("admin/vendor/owl-carousel/css/owl.carousel.min.css") }}">
    <link rel="stylesheet" href="{{ asset("admin/vendor/owl-carousel/css/owl.theme.default.min.css") }}">
    <link href="{{ asset("admin/vendor/jqvmap/css/jqvmap.min.css") }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("admin/vendor/toastr/css/toastr.min.css") }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="{{ asset("admin/css/style.css") }}" rel="stylesheet">
    <script src="{{ asset("admin/js/login.js") }}"></script>
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <img class="logo-abbr" src="{{ asset("admin/images/logo.png") }}" alt="">
                <img class="logo-compact" src="{{ asset("admin/images/logo-text.png") }}" alt="">
                <img class="brand-title" src="{{ asset("admin/images/logo-text.png") }}" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-bell"></i>
                                    <div class="pulse-css"></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    
                                </div>
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Main Menu</li>
                    <li><a href="../">Home</a></li>
                    <li><a href="../events">Events</a></li>
                    {{-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./index.html">Dashboard 1</a></li>
                            <li><a href="./index2.html">Dashboard 2</a></li>
                        </ul>
                    </li> --}}
                    <li class="nav-label">Persons</li>
                    <li><a href="../ministers"><i class="icon icon-single-04"></i><span class="nav-text">Ministers</span></a></li>
                    <li><a href="../admins"><i class="icon icon-single-04"></i><span class="nav-text">Admins</span></a></li>
                    
                    
                    
                    <li class="nav-label">Resources</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-app-store"></i><span class="nav-text">Media</span></a>
                        <ul aria-expanded="false">
                            <li><a href="../message-series">Message Series</a></li>
                            <li><a href="../messages">Messages</a></li>
                            <li><a href="../photos">Photos</a></li>
                            <li><a href="../videos">Videos</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void()" class="has-arrow" aria-expanded="false"><i class="icon icon-form"></i><span class="nav-text">Publications</span></a>
                        <ul aria-expanded="false">
                            <li><a href="../books">Books</a></li>
                            <li><a href="../devotionals">Devotionals</a></li>
                            <li><a href="../articles">Articles</a></li>
                            <li><a href="../magazines">Magazines</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void()" class="has-arrow" aria-expanded="false"><i class="icon icon-globe-2"></i><span class="nav-text">Components</span></a>
                        <ul aria-expanded="false">
                            <li><a href="../page_headers">Page Headers</a></li>
                            <li><a href="../about-us">About Us</a></li>
                        </ul>
                    </li>
                    <li><a href="widget-basic.html" aria-expanded="false"><i class="icon icon-globe-2"></i><span
                                class="nav-text">Widget</span></a></li>
                    <li class="nav-label">Forms</li>
                </ul>
            </div>


        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        @yield('content')


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">Quixkit</a> 2019</p>
                <p>Distributed by <a href="https://themewagon.com/" target="_blank">Themewagon</a></p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{asset("admin/vendor/global/global.min.js")}}"></script>
    <script src="{{asset("admin/js/quixnav-init.js")}}"></script>
    <script src="{{asset("admin/js/custom.min.js")}}"></script>
    <script src="{{asset("admin/vendor/toastr/js/toastr.min.js")}}"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    {{-- <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script> --}}
    {{-- <script
      src="https://cdn.tiny.cloud/1/k530srq7vhjqq3ygv20mx0yz47dzcas8g8l7x6ctfnjqxc14/tinymce/6/tinymce.min.js"
      referrerpolicy="origin"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@2/dist/tinymce-jquery.min.js"></script> --}}
    <script src="{{asset("admin/js/app.js")}}"></script>
</body>

</html>
