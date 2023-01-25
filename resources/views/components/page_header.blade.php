<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s" style="
                                                                                background-image: url({{ $background_image }}) !important;
                                                                                background-size: cover !important;
                                                                                background-repeat: no-repeat !important;
                                                                                background-position: top right !important;                                                                                
">
    <div class="container">
        <h1 class="display-3 mb-3 animated slideInDown">{{ $page_name }}</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a class="text-body" href="{{ env('APP_URL') }}">Home</a></li>
                {{ $breadcrumbs }}
                {{-- <li class="breadcrumb-item"><a class="text-body" href="#">Pages</a></li>
                <li class="breadcrumb-item text-dark active" aria-current="page">About Us</li> --}}
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->