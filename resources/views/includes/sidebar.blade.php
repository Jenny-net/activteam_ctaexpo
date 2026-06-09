@php
    $controller_arr = explode(
        '\\',
        request()
            ->route()
            ->getAction()['controller'],
    );
    $controllerArr = explode('@', end($controller_arr));
    $controller_name = $controllerArr[0];
@endphp

<!-- ===================== Main Sidebar Section Start ===================== -->
<section class="main-sidebar full-menu" id="main-sidebar">
    <!-- for desktop view -->
    <button class="navbar-toggler open" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span></span><span></span><span></span><span></span>
    </button>


    <div class="main-sidebar-nav mCustomScrollbar">

        <ul>
           
            <li class="{{ $controller_name == 'MenuController' ? 'active' : '' }}"><a
                    href="{{ route('admin.menu') }}"><i class="fa fa-list"></i> <span>Header Menu</span></a></li>
            <li class="{{ $controller_name == 'FooterMenuController' ? 'active' : '' }}"><a
                    href="{{ route('admin.footer.menu') }}"><i class="fa fa-list"></i> <span>Footer Menu</span></a></li>
            <li class="{{ $controller_name == 'SliderController' ? 'active' : '' }}"><a
                href="{{ route('admin.slider.index') }}"><i class="fa fa-sliders" aria-hidden="true"></i><span>Slider Managment</span></a></li>
            <li class="{{ $controller_name == 'HomeController' ? 'active' : '' }}"><a
                    href="{{ route('admin.home.content') }}"><i class="fa fa-home" aria-hidden="true"></i></i> <span>Home Content</span></a>
            </li>        
            <li class="{{ $controller_name == 'ContentController' ? 'active' : '' }}"><a
                    href="{{ route('admin.content') }}"><i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Content</span></a></li>
            <li class="{{ $controller_name == 'MassContentController' ? 'active' : '' }}"><a
                        href="{{ route('admin.masscontent') }}"><i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Mass Content</span></a></li>
             <li class="{{ $controller_name == 'ReplicateMassContentController' ? 'active' : '' }}"><a
                   href="{{ route('admin.replicatemasscontent') }}"><i class="fa fa-list"></i> <span>Mass Replicate</span></a></li>                  
            <li class="{{ $controller_name == 'AnalyticsController' ? 'active' : '' }}"><a
                        href="{{ route('admin.analytics') }}"><i class="fa fa-list"></i> <span>Google Analytics</span></a></li>
             <li class="{{ $controller_name == 'NoscriptAnalyticsController' ? 'active' : '' }}"><a
                                href="{{ route('admin.noscriptanalytics') }}"><i class="fa fa-list"></i> <span>Noscript Analytics</span></a></li>             

            <li class="{{ $controller_name == 'SettingController' ? 'active' : '' }}"><a
                        href="{{ route('admin.setting') }}"><i class="fa fa-cog" aria-hidden="true"></i>
                        <span>Setting</span></a> </li>
           
        
           <li class="{{ $controller_name == 'SocialController' ? 'active' : '' }}"><a
                  href="{{ route('admin.social') }}"><i class="fa fa-list"></i> <span>Social Manager</span></a></li>
         
            
                

              

        </li>
        </ul>
    </div>





</section>



<!-- ===================== Main Sidebar Section End ===================== -->
