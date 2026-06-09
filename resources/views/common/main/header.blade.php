@php
    $logo = 'public/storage/banner_picture/' . @$logo->logo_image;
@endphp
<header class="{{ Route::is('search-filter') ? 'header-border' : '' }}">
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand"
                            @if (Auth::check()) href="{{ route('property_list') }}" @else href="{{ route('/') }}" @endif>
                            @if (@getimagesize($logo))
                                <img src="{{ asset($logo) }}" alt="">
                            @else
                                <img src="{{ asset('public/assets/images/logo.png') }}" alt="">
                            @endif
                        </a>
                        <button class="menu-button" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent">
                            <span class="icon-spar"></span>
                            <span class="icon-spar"></span>
                            <span class="icon-spar"></span>
                        </button>

                        <div class="navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                @if (Auth::check())
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#">Dashboard</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Manage
                                            Property</a>
                                        <div class="dropdown-menu animated">
                                            <a class="dropdown-item" href="{{ route('property_add') }}">Add Property</a>
                                            <a class="dropdown-item" href="{{ route('property_list') }}">Property
                                                List</a>
                                        </div>
                                    </li>
                                @else
                                    <li class="nav-item active">
                                        <a class="nav-link" href="{{ route('/') }}">Home</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#">Buy</a>
                                        {{-- data-toggle="dropdown" --}}
                                        <div class="dropdown-menu animated">
                                            <a class="dropdown-item state-show" href="#">Search by state</a>
                                        </div>
                                    </li>
                             
                                    @foreach ($menu as $menu)
                                        @if (count($menu->subMenu))
                                            <li class="nav-item dropdown">
                                                @if ($menu->menu_type == 'content')
                                                    <a class="nav-link dropdown-toggle"
                                                        href="{{ route('content.page', $menu->slug) }}">{{ $menu->menu_name }}</a>
                                                @else
                                                    <a class="nav-link dropdown-toggle"
                                                        href="{{ $menu->url }}">{{ $menu->menu_name }}</a>
                                                @endif
                                                {{-- data-toggle="dropdown" --}}
                                                <div class="dropdown-menu animated">
                                                    @foreach ($menu->subMenu as $subMenu)
                                                        @if ($subMenu->menu_type == 'content')
                                                            <a class="dropdown-item"
                                                                href="{{ route('content.page', $subMenu->slug) }}">{{ $subMenu->menu_name }}</a>
                                                        @else
                                                            <a class="dropdown-item"
                                                                href="{{ $subMenu->url }}">{{ $subMenu->menu_name }}</a>
                                                        @endif
                                                        @if (count($subMenu->subMenu))
                                                         <ul>
                                                                    @foreach ($subMenu->subMenu as $subMenu3)
                                                                        @if ($subMenu3->menu_type == 'content')
                                                                        <li>
                                                                            <a class="dropdown-item"
                                                                                href="{{ route('content.page', $subMenu3->slug) }}">{{ $subMenu3->menu_name }}</a>
                                                                       </li>
                                                                        @else
                                                                        <li>
                                                                            <a class="dropdown-item"
                                                                                href="{{ $subMenu3->url }}">{{ $subMenu3->menu_name }}</a>
                                                                        </li>
                                                                        @endif
                                                                    @endforeach
                                                          
                                                         </ul>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </li>
                                        @else
                                            <li class="nav-item">
                                                @if ($menu->menu_type == 'content')
                                                    <a class="nav-link"
                                                        href="{{ route('content.page', $menu->slug) }}">{{ $menu->menu_name }}</a>
                                                @else
                                                    <a class="nav-link"
                                                        href="{{ $menu->url }}">{{ $menu->menu_name }}</a>
                                                @endif
                                            </li>
                                        @endif
                                    @endforeach
                                   


                                @endif
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('contact.form') }}">Contact Us</a>
                                </li>
                            </ul>
                            <div class="d-inline my-2 my-lg-0">
                                <ul class="navbar-nav">
                                    @if (Auth::check())
                                        @if (!Auth::user()->credit_card)
                                            <li class="nav-item signin-btn">
                                                <a href="{{ route('property_list') }}" class="nav-link">
                                                    <i class="la la-sign-in"></i>
                                                    <span>{{ Auth::user()->name }}</span>
                                                </a>

                                            </li>
                                        @else
                                            <li class="nav-item dropdown auth-drop">
                                                <a class="nav-link dropdown-toggle" href="#"
                                                    data-toggle="dropdown"><i class="la la-sign-in"></i>
                                                    <span>{{ Auth::user()->name }}</span></a>
                                                <div class="dropdown-menu animated">
                                                    <a class="dropdown-item"
                                                        href="{{ route('property_plans') }}">Upgrade Plan</a>
                                                </div>
                                            </li>
                                        @endif
                                        <li class="nav-item submit-btn">
                                            <a href="{{ route('logout') }}" class="my-2 my-sm-0 nav-link sbmt-btn">
                                                <span>Logout</span>
                                            </a>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a href="javascript:void(0)" class="nav-link">
                                                <i class="la la-sign-in"></i>
                                                <span><b class="signin-op">Sign in</b></span>
                                                <!-- <span><b class="signin-op">Sign in</b> or <b class="reg-op">Register</b></span> -->
                                            </a>

                                        </li>
                                        @if (!Route::is('all-land-county'))
                                            <li class="nav-item submit-btn">
                                                <a href="{{ route('listing-plans') }}"
                                                    class="my-2 my-sm-0 nav-link sbmt-btn">
                                                    <i class="icon-plus"></i>
                                                    <span>Add a Listing</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                </ul>
                            </div>
                            <a href="#" title="" class="close-menu"><i class="la la-close"></i></a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>

</header>

<div class="popup" id="sign-popup">
    <h3>Sign In to your Account</h3>
    <span class="text-danger" id="general-error"></span>
    <div class="popup-form pop-all-gap">
        <form method="post" action="http://localhost/activteam/public/signin" name="login_form" id="login_form1">
            {{ csrf_field() }}
            <div class="form-field">
                <input type="text" name="email" id="email" placeholder="Email-Id">
                <span class="text-danger" id="email-error"></span>
            </div>
            <div class="form-field">
                <input type="password" name="password" id="password" placeholder="Password">
                <i class="fa fa-eye" id="show_pass"></i>
                <i class="fa fa-eye-slash" id="hide_pass" style="display: none;"></i>
                <span class="text-danger" id="password-error"></span>
            </div>
            <div class="form-cp">
                <div class="form-field">
                    <div class="input-field">
                        <input type="checkbox" name="ccc" id="cc1">
                        <label for="cc1">
                            <span></span>
                            <small>Remember me</small>
                        </label>
                    </div>
                </div>
                <a href="#" title="" id="fgt-pwd">Forgot Password????</a>
            </div>
            <!--form-cp end-->
            <!-- <button type="button" id="login" class="btn2">Sign In</button> -->
            <input type="submit" id="login123" class="btn2">Sign In..</button>
        </form>
    </div>
</div>
<!--popup end-->

<div class="popup" id="forgot-popup">
    <h3>Forgot Password ?</h3>
    <span class="text-danger" id="general-error"></span>
    <div class="popup-form pop-all-gap">
        <form method="post" action="javascript:void(0)" name="fwd_form" id="fwd_form">
            {{ csrf_field() }}
            <span class="text-success" id="fwd-scc"></span>
            <div class="form-field">
                <input type="email" name="email" placeholder="Enter Your Email">
                <span class="text-danger" id="fwd-error"></span>
            </div>
            <button type="button" id="fwd" class="btn2">Submit</button>
        </form>
    </div>
</div>
<!--popup end-->

<div class="popup" id="register-popup">
    <h3>Register</h3>
    <div class="popup-form pop-all-gap">
        <form>
            <div class="form-field">
                <input type="text" name="username" placeholder="Username">
            </div>
            <div class="form-field">
                <input type="text" name="email" placeholder="Email">
            </div>
            <div class="form-field">
                <input type="text" name="password" placeholder="Password">
            </div>
            <div class="form-cp">
                <div class="form-field">
                    <div class="input-field">
                        <input type="checkbox" name="ccc" id="cc2">
                        <label for="cc2">
                            <span></span>
                            <small>I agree with terms</small>
                        </label>
                    </div>
                </div>
                <a href="#" title="" class="signin-op">Have an account?</a>
            </div>
            <!--form-cp end-->
            <button type="submit" class="btn2">Register</button>
        </form>
    </div>
    <input type="hidden" id="_token" value="<?php echo csrf_token(); ?>">

</div>


<section class="map-banner" style="display: none;">
    <a href="javascript:;" class="close-state">
        <img src="{{ asset('public/assets/images/close-icon-big.png') }}" alt="">
    </a>
    <div class="container">
        <div class="midcont">

            <h2>Select a state</h2>
            <p>Which state is that? Hover over it to find out</p>
            <!-- <iframe src = "public/assets/images/map/index.html"  width="100%" ></iframe> -->
            <div id="info-box"></div>
            <script src="{{ asset('public/assets/images/map/js/svg.js') }}"></script>


        </div>
    </div>
</section>
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#fgt-pwd").click(function(e) {
                $('#sign-popup').removeClass('active');
                $('#forgot-popup').addClass('active');
            });
            $("#show_pass").click(function(e) {
                $("#password").attr("type", "text");
                $(this).hide();
                $("#hide_pass").show();
            });
            $("#hide_pass").click(function(e) {
                $("#password").attr("type", "password");
                $(this).hide();
                $("#show_pass").show();
            });

            $("#login").click(function(e) {
                var baseurl = "{{ env('APP_URL') }}";
                $.ajax({
                    type: 'POST',
                    url: baseurl + '/signin',
                    data: $('#login_form').serialize(),
                    success: function(response) {
                        if (response.data.is_login === '1') {
                            $("#login_form")[0].reset();
                            $("#sign-popup").modal('hide');

                            window.location.href = "{{ route('property_list') }}";
                        } else {
                            $("#general-error").html(response.message);
                            $("#email-error").html('');
                            $("#password-error").html('');
                        }
                    },
                    error: function(jqXHR, exception) {
                        var err = JSON.parse(jqXHR.responseText);

                        if (err.data.email !== 'undefined') {
                            $("#email-error").html(err.data.email[0]);
                            $("#general-error").html('');
                        }
                        if (err.data.password !== 'undefined') {
                            $("#password-error").html(err.data.password[0]);
                            $("#general-error").html('');
                        }
                    }

                });
            });


            $("body").click(function() {
                $('#forgot-popup').removeClass('active');
            });
            $("#fwd").click(function(e) {
                var baseurl = "{{ env('APP_URL') }}";
                $.ajax({
                    type: 'POST',
                    url: baseurl + '/user-forgotpassword',
                    data: $('#fwd_form').serialize(),
                    beforeSend: function() {
                        $('#fwd').prop('disabled', true);
                        $('#fwd').html('Sending...');
                    },
                    success: function(response) {
                        if (response.data.is_valid === '1') {
                            $("#fwd-error").html('');
                            $("#fwd_form")[0].reset();
                            $('#fwd').prop('disabled', false);
                            $('#fwd').html('Submit');
                            $("#forgot-popup").modal('hide');
                            $("#fwd-scc").html('Please check, a mail has been sent.');
                            setTimeout(function() {
                                $('#fwd-scc').fadeOut('slow');
                            }, 5000);

                            // window.location.href = "{{ route('user.success.mail') }}";
                        } else {
                            $('#fwd').html('Submit');
                            $('#fwd').prop('disabled', false);
                            $("#fwd-error").html(response.message);
                        }
                    },
                    error: function(jqXHR, exception) {
                        $('#fwd').prop('disabled', false);
                        var err = JSON.parse(jqXHR.responseText);

                        if (err.data.email !== 'undefined') {
                            $("#fwd-error").html(err.data.email[0]);
                        }
                    }

                });
            });
            $(".dropdown-menu").css('margin-top', -20);
            $(".dropdown").mouseover(function() {
                $(this).addClass('show').attr('aria-expanded', "true");
                $(this).find('.dropdown-menu').addClass('show');
            }).mouseout(function() {
                $(this).removeClass('show').attr('aria-expanded', "false");
                $(this).find('.dropdown-menu').removeClass('show');
            });
        });
    </script>
@endpush
