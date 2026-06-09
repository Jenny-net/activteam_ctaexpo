<section class="footerContactSec">
	<div class="container">
		<div class="ftrContactRow">
			<div class="ftrContactLeftPrt">
				<h2>{{ $SettingMenu->first()->contact_us_heading }}</h2>
				<p>{!! $SettingMenu->first()->contact_notes_area !!}</p>
			</div>
			<div class="ftrContactRightPrt">
				<h2>{{ $SettingMenu->first()->contact_us_heading }}</h2>
				<ul>
					@if($SettingMenu->first()->phone_number_one)
						<li>
							<span>{{ $SettingMenu->first()->country_name_one_label }}:</span>
							<i class="fa fa-phone" aria-hidden="true"></i>
							 {!! $SettingMenu->first()->phone_number_one !!}
						</li>
					@endif

					@if($SettingMenu->first()->phone_number_two)
						<li>
							<span>{{ $SettingMenu->first()->country_name_two_label }}:</span>
							<i class="fa fa-phone" aria-hidden="true"></i>
							 {!! $SettingMenu->first()->phone_number_two !!}
						</li>
					@endif

					@if($SettingMenu->first()->phone_number_three)
						<li>
							<span>{{ $SettingMenu->first()->country_name_three_label }}:</span>
							<i class="fa fa-phone" aria-hidden="true"></i>
							 {!! $SettingMenu->first()->phone_number_three !!}
						</li>
					@endif

					@if($SettingMenu->first()->email_address)
						<li>
							<span>Email id:</span>
							<i class="fa fa-envelope-o" aria-hidden="true"></i>
							<a href="mailto:{{ $SettingMenu->first()->email_address }}">
								{{ $SettingMenu->first()->email_address }}
							</a>
						</li>
					@endif

					@if($SettingMenu->first()->contact_our_project)
						<li>
							<span>Address:</span>
							<i class="fa fa-map-marker" aria-hidden="true"></i>
							{{ $SettingMenu->first()->contact_our_project }}
						</li>
					@endif

				<li>
					@if($SettingMenu->first()->whatsapp_url)
						<a href="{{ $SettingMenu->first()->whatsapp_url }}"
						target="_blank"
						rel="noopener"
						title="Chat with us on WhatsApp"
						aria-label="Chat with us on WhatsApp">
							<i class="fa fa-whatsapp" aria-hidden="true"></i>
							<span class="sr-only">Chat with us on WhatsApp</span>
						</a>
					@endif

				</li>
				<li>		
				
					@if($SettingMenu->first()->teams_url)
						<a href="{{ $SettingMenu->first()->teams_url }}"
						target="_blank"
						rel="noopener"
						title="Join us on Microsoft Teams"
						aria-label="Join us on Microsoft Teams">
							<i class="fa fa-users"></i>
							<span class="sr-only">Join us on Microsoft Teams</span>
						</a>
					@endif
				</li>
				<li>
						@foreach($socialIcon as $social)
							@if(!empty($social->url))
								<a href="{{ $social->url }}"
								target="_blank"
								rel="noopener noreferrer"
								style="display:inline-block; margin-right:10px;">
									<img src="{{ asset('public/storage/' . $social->social_icon) }}"
										alt="Social Icon">
								</a>
							@endif
						@endforeach
				</li>
          

				</ul>
			</div>
		</div>
	</div>
</section>

<section class="footerSec">
	<div class="container">
		<div class="ftrRow">
			<div class="ftrLeftPrt">
				<p class="copyright">&copy; {{ $SettingMenu->first()->copy_right }}</p>
			</div>
			@foreach($footerMenu as $menu)
				@if($menu->parent_id == 0)
					<div class="ftrRightPrt">
						<h2>{{ $menu->menu_name }}</h2>
						<ul>
							@foreach($footerMenu as $childMenu)
								@if($childMenu->parent_id === $menu->id)
									<li><a href="{{ $childMenu->page_url }}">{{ $childMenu->menu_name }}</a></li>
								@endif
							@endforeach
						</ul>
					</div>
				@endif
			@endforeach
		</div>
	</div>
</section>
