@php
    $src = Auth::user()->profile_photo ? env('AWS_URL') . Auth::user()->profile_photo : asset('admin/images/no-user-image.png');
    $src_loader = asset('images/loader-animations.gif');
@endphp
<!DOCTYPE html>
<html lang="en-US">

<head>
    @include('includes.header')
    @stack('links')
</head>

<body class="pace-done">
    @include('includes.sidebar')
    <section class="dashboard-body dashboard-shrink">
        <div class="pace pace-inactive">
            <div class="pace-progress" data-progress-text="100%" data-progress="99"
                style="transform: translate3d(100%, 0px, 0px);">
                <div class="pace-progress-inner"></div>
            </div>
            <div class="pace-activity"></div>
        </div>
        <div class="header-toprow">
            <h1 class="page-title">
                <div class="formobbuttn">
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span></span><span></span><span></span><span></span>
                    </button>
                </div>
                <i class="fa icon-dashboard"></i>
            </h1>
            <div class="header-right-component">
                <ul>
                    <!-- for-web -->
                    <li class="hdr-srch">
                        <form>
                            <i class="fa fa-search"></i>
                            <input type="search" name="" placeholder="Search here...">
                        </form>
                    </li>
                    <!-- for-mob -->
                    <li class="hdr-srch-mob">
                        <form>
                            <a class="button3">
                                <i class="fa fa-search"></i>
                            </a>
                            <div class="inputsearch content2">
                                <input type="search" name="" placeholder="Search here...">
                            </div>

                        </form>
                    </li>
                    <li class="hdr-user-upload">
                        
                        <span class="user-pic">
                            <a id="profile-image" class="button2" href="javascript:void(0);" style="color: #4f4d42">
                                Hello, {{ Auth::user()->name }}
                            </a>
                        </span>

                        <div class="profile-setting content1">
                            <ul>
                                <li>
                                    <a href="javascript:void(0);" onclick="$('#myModalChangePassword').show();">
                                        <i class="fa fa-pencil"></i> Change Password
                                    </a>
                                </li>
                                <li><a href="{{ route('admin.logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        @include('includes.message')
        @include('includes.err-msg')
        @yield('content')
        <div class="notification-modal-popup" id="myModalChangePassword">
            <div class="noti-popup-box">
                <button class="noti-close-btn" onclick="$('#myModalChangePassword').hide();">X</button>
                <div class="noti-pop-hdn">
                    <h2>Change Password</h2>
                </div>
                <div class="noti-pop-body">
                    <div class="create-form">
                        <form method="POST" action="{{ route('admin.profile.change_password') }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Current Password</label>
                                        <input type="password" name="current_password" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Password Confirmation</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="category-submit">
                                <ul>
                                    <li>
                                        <button type="button" class="cancel-btn"
                                            onclick="$('#myModalChangePassword').hide();">
                                            Cancel
                                        </button>
                                    </li>
                                    <li>
                                        <button type="submit" class="submit-btn">Submit</button>
                                    </li>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <footer class="btm-main-footer">
            <div class="footer-row">
                <div class="copyright-txt">
                    @include('includes.footer-text')
                </div>
            </div>
        </footer>
    </section>
    @include('includes.footer')

    @stack('modal')

    @stack('script')

</body>

</html>
