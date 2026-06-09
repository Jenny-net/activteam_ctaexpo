<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <title>{{ @$page->meta_title ? $page->meta_title : 'Compackexpo' }}</title>
        <meta name="description" content="{{ @$page->meta_description ? $page->meta_description : 'Compackexpo – Exhibition Stand Builders & Contractors in Europe' }}" /> 
        <meta name="robots" content="{{ @$page->meta_Robots ? $page->meta_Robots : 'index,follow' }}" />
        <meta name="revisit after" content="{{ @$page->meta_revisit_after ? $page->meta_revisit_after : '3 days' }}" />
        <link rel="canonical" href="{{ @$page->meta_canonical ?? url()->current() }}">
        <!-- Google tag (gtag.js) -->
        @foreach ($analyticsData as $analytics)
        {!!html_entity_decode($analytics->tracking_code)!!}
        @endforeach
        
        <link rel="icon" type="image/x-icon" href="{{ asset('public/storage/' . $SettingMenu->first()->fav_icon) }}">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('/public/frontend/css/font-awesome.min.css') }}">
        <!-- Bootstrap -->
        <link type="text/css" href="{{ asset('/public/frontend/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Owl Carousel -->
        <link type="text/css" href="{{ asset('/public/frontend/css/owl.carousel.min.css') }}" rel="stylesheet">
        <!-- Gallery Css -->
        <link rel="stylesheet" href="{{ asset('/public/frontend/css/jquery.fancybox.css') }}">
        <!-- Animate Css -->
        <link type="text/css" href="{{ asset('/public/frontend/css/animate.css') }}" rel="stylesheet">
        <!-- Menu Css -->
        <link type="text/css" href="{{ asset('/public/frontend/css/slimmenu.css') }}" rel="stylesheet">
        
        <!-- Custom Css -->
        <link type="text/css" href="{{ asset('/public/frontend/css/style.css') }}" rel="stylesheet">

        
        
        <!-- Font Link -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700&display=swap" rel="stylesheet">


        @stack('links')
        <!-- endnew -->

    
   

</head>


<body>
   @foreach ($noscriptanalyticsData as $noscriptanalytics)
    {!!html_entity_decode($noscriptanalytics->tracking_code)!!}
    @endforeach
    @include('includes.frontend.header')
   
    
    @yield('content')

    @include('includes.frontend.footer')
    <!-- JS Start here -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
    
    <script>
        window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')
    </script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('/public/frontend/js/bootstrap.min.js') }}"></script>
    <!-- Owl Carousel JS -->
    <script src="{{ asset('/public/frontend/js/owl.carousel.min.js') }}"></script>
    <!-- Menu JS -->
    <script src="{{ asset('/public/frontend/js/easing.min.js') }}"></script>
    <script src="{{ asset('/public/frontend/js/slimmenu.min.js') }}"></script>
    <!-- Gallery js -->
    <script src="{{ asset('/public/frontend/js/jquery.fancybox.js?v=2.1.4') }}"></script>
    <!-- Custome js -->
    <script src="{{ asset('/public/frontend/js/custom.js') }}"></script>

    @stack('scripts')
</body>
</html>



