<!DOCTYPE html>
<html lang="en-US">
<head>
    @include('includes.header')
</head>
<body>
<section class="login-body-bg">
	{{-- <img class="login-bg" src="{{ asset('public/admin/images/login-body-bg.jpg') }}" alt=""> --}}
	<div class="login-form">
		<div class="container">
            <div class="login-logo"><img src="{{asset('/public/assets/images/ctaexpo-logo.png')}}" alt=""></div>
            @yield('content')
            @include('includes.footer-text')
		</div>
	</div>
</section>
@include('includes.footer')
</body>
</html>
