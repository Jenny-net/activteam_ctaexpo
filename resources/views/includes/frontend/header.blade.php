<header>
    <div class="hdrContactTopPrt desk-ver">
        <div class="container">
            <div class="hdrContactInfo">
                <ul>
                    {{-- Phone Number One --}}
                    @if ($SettingMenu->first()->phone_number_one)
                        <li>
                            <span>{{ $SettingMenu->first()->country_name_one_label }}:</span>
                            <i class="fa fa-phone" aria-hidden="true"></i>
                           
                                {!! $SettingMenu->first()->phone_number_one !!}
                          
                        </li>
                    @endif

                    {{-- Phone Number Two --}}
                    @if ($SettingMenu->first()->phone_number_two)
                        <li>
                            <span>{{ $SettingMenu->first()->country_name_two_label }}:</span>
                            <i class="fa fa-phone" aria-hidden="true"></i>
                          
                                {!! $SettingMenu->first()->phone_number_two !!}
                           
                        </li>
                    @endif

                    {{-- Phone Number Three --}}
                    @if ($SettingMenu->first()->phone_number_three)
                        <li>
                            <span>{{ $SettingMenu->first()->country_name_three_label }}:</span>
                            <i class="fa fa-phone" aria-hidden="true"></i>

                                {!! $SettingMenu->first()->phone_number_three !!}
                           
                        </li>
                    @endif

                    {{-- Email --}}
                    @if ($SettingMenu->first()->email_address)
                        <li>
                            <span>Email id:</span>
                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                            <a href="mailto:{{ $SettingMenu->first()->email_address }}">
                                {{ $SettingMenu->first()->email_address }}
                            </a>
                        </li>
                    @endif

                   <li>
                    @if ($SettingMenu->first()->whatsapp_url)
                        <a href="{{ $SettingMenu->first()->whatsapp_url }}"
                           target="_blank"
                           rel="noopener"
                           title="Chat with us on WhatsApp"
                           aria-label="Chat with us on WhatsApp">
                            <i class="fa fa-whatsapp" aria-hidden="true"></i>
                            <span class="sr-only">Chat with us on WhatsApp</span>
                        </a>
                    @endif
                
                    @if ($SettingMenu->first()->teams_url)
                        <a href="{{ $SettingMenu->first()->teams_url }}"
                           target="_blank"
                           rel="noopener"
                           title="Join us on Microsoft Teams"
                           aria-label="Join us on Microsoft Teams">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span class="sr-only">Join us on Microsoft Teams</span>
                        </a>
                    @endif
                </li>

                </ul>

            </div>
        </div>
    </div>
    	<div class="hdrLogoMenuPrt">
		<div class="container">
			<div class="hdrLogoMenuRow">
				<div class="hdrLogo">
                    <a href="{{ route('web.index') }}">
                        @if ($SettingMenu->isNotEmpty() && $SettingMenu->first()->icon)
                            @php
                                $filename = pathinfo($SettingMenu->first()->icon, PATHINFO_FILENAME);
                                $cleanedFilename = preg_replace('/_\d+_[A-Za-z0-9]+/', '', $filename);
                                $altText = ucwords(str_replace('_', ' ', $cleanedFilename ?: 'Ctaexpo Logo'));
                            @endphp
                    
                            <img src="{{ asset('public/storage/' . $SettingMenu->first()->icon) }}"
                                 alt="{{ $altText }}"
                                 title="{{ $altText }}"
                                 width="150"
                                 height="60"
                                 loading="eager"
                                 fetchpriority="high">
                        @endif
                    </a>

				</div>
				<div class="hdrMenuPrt">
					<div class="collapse-button"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></div>
					<div class="header-menu">
 <ul class="slimmenu">
                                @foreach ($headerMenu as $menu)
                                    @if ($menu->subMenu->count() || $menu->content->count())
                                        <li>
                                            <a
                                                href="{{ $menu->page_url ? $menu->page_url : '#' }}">{{ $menu->menu_name }}</a>
                                            @if ($menu->subMenu->count() || $menu->content->count())
                                                <ul>
                                                    @foreach ($menu->subMenu as $subMenu)
                                                        <li>
                                                            <a
                                                                href="{{ $subMenu->page_url ? $subMenu->page_url : '#' }}">
                                                                {{ $subMenu->menu_name }}
                                                            </a>
                                                            @if ($subMenu->subMenu->count() || $subMenu->content->count())
                                                                <ul>
                                                                    @foreach ($subMenu->subMenu as $childSubMenu)
                                                                        <li>
                                                                            <a
                                                                                href="{{ $childSubMenu->page_url ? $childSubMenu->page_url : '#' }}">
                                                                                {{ $childSubMenu->menu_name }}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                    @if ($subMenu->content->count())
                                                                        @foreach ($subMenu->content as $content)
                                                                            @foreach ($content->pages as $page)
                                                                                @if ($content->is_completed)
                                                                                    <li>
                                                                                        <a
                                                                                            href="{{ route('web.page', $page->page_url) }}">
                                                                                            {{ $page->page_name }}
                                                                                        </a>
                                                                                    </li>
                                                                                @endif
                                                                            @endforeach
                                                                        @endforeach
                                                                    @endif
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                    @if ($menu->content->count())
                                                        @foreach ($menu->content as $content)
                                                            @foreach ($content->pages as $page)
                                                                @if ($content->is_completed)
                                                                    <li>
                                                                        <a
                                                                            href="{{ route('web.page', $page->page_url) }}">
                                                                            {{ $page->page_name }}
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            @endif
                                        </li>
                                    @else
                                        @if ($menu->page_url)
                                            <li class="active"><a
                                                    href="{{ $menu->page_url }}">{{ $menu->menu_name }}</a>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach

                            </ul>
					</div>
				</div>
			</div>
		</div>
	</div>


    <div class="hdrContactTopPrt mob-ver">
        <div class="container">
            <div class="hdrContactInfo">
                <ul>
                    {{-- Phone Number One --}}
                    @if ($SettingMenu->first()->phone_number_one)
                        <li>
                            <span>{{ $SettingMenu->first()->country_name_one_label }}:</span>
                            <i class="fa fa-phone" aria-hidden="true"></i>
                             {!! $SettingMenu->first()->phone_number_one !!}
                        </li>
                    @endif

                    {{-- Phone Number Two --}}
                    @if ($SettingMenu->first()->phone_number_two)
                        <li>
                            <span>{{ $SettingMenu->first()->country_name_two_label }}:</span>
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            {!! $SettingMenu->first()->phone_number_two !!}
                        </li>
                    @endif

                    {{-- Phone Number Three --}}
                    @if ($SettingMenu->first()->phone_number_three)
                        <li>
                            <span>{{ $SettingMenu->first()->country_name_three_label }}:</span>
                            <i class="fa fa-phone" aria-hidden="true"></i>
                             {!! $SettingMenu->first()->phone_number_three !!}
                        </li>
                    @endif

                    {{-- Email --}}
                    @if ($SettingMenu->first()->email_address)
                        <li>
                            <span>Email id:</span>
                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                            <a href="mailto:{{ $SettingMenu->first()->email_address }}">
                                {{ $SettingMenu->first()->email_address }}
                            </a>
                        </li>
                    @endif

                  {{-- Whatsapp & Teams --}}
                <li>
                    @if ($SettingMenu->first()->whatsapp_url)
                        <a href="{{ $SettingMenu->first()->whatsapp_url }}"
                           target="_blank"
                           rel="noopener"
                           title="Chat with us on WhatsApp"
                           aria-label="Chat with us on WhatsApp">
                            <i class="fa fa-whatsapp" aria-hidden="true"></i>
                            <span class="sr-only">Chat with us on WhatsApp</span>
                        </a>
                    @endif
                
                    @if ($SettingMenu->first()->teams_url)
                        <a href="{{ $SettingMenu->first()->teams_url }}"
                           target="_blank"
                           rel="noopener"
                           title="Join us on Microsoft Teams"
                           aria-label="Join us on Microsoft Teams">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span class="sr-only">Join us on Microsoft Teams</span>
                        </a>
                    @endif
                </li>

                </ul>

            </div>
        </div>
    </div>
</header>
