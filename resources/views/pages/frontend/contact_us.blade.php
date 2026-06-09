@extends('layouts.main.layout')
@section('content')
<!-- ================ Contact Body Start ================ -->
<section class="contactBodySec textContent">

	<div class="container">
		<div class="contactHdn">
			<h1 class="titleHdn"> {!! $SettingMenu->first()->contact_us_heading !!}</h1>
			
			<p>{!! $SettingMenu->first()->contact_our_project !!} </b> <a href="https://api.whatsapp.com/send?phone={{ $SettingMenu->first()->whatsapp_link }}&text=Hello%20there"><img src="{{ asset('public/storage/' . $SettingMenu->first()->whatsapp_image) }}"  alt="whatsapp" /></a>  <b>{!! $SettingMenu->first()->skype_label !!}</b> <a href="{!! $SettingMenu->first()->skype_url !!}"><img src="{{ asset('public/storage/' . $SettingMenu->first()->skype_icon) }}" alt="skype"></a> E-mail: <a href="mailto:{!! $SettingMenu->first()->email_address !!}">{!! $SettingMenu->first()->email_address !!}</a> </p>
		</div>

		<div class="contactAddressRow">
			@forelse ($contactSetting as $setting)
			<div class="contactAddressClm">
				<h2>{{ $setting->contact_country_name }}</h2>
				<div class="contactAddressBox">
					<p>{{ $setting->contact_address }}</p>
					<p><span>{{ $setting->contact_tel_label }}</span>{{ $setting->contact_tel_number }}</p>
					<p><span>{{ $setting->contact_email_label }}</span> <a href="{{ $setting->contact_email_url }}">{{ $setting->contact_email_address }}</a></p>
					<p><span></span> <a href="{{ $setting->contact_site_url }}">{{ $setting->contact_site_name }}	</a></p>
				</div>
			</div>
            @empty

            @endforelse
		</div>

		<div class="contactPageListPrt">
           
            {!! $SettingMenu->first()->contact_notes_area !!}

			
		</div>
	</div>

</section>
<!-- ================ Contact Body End ================ -->

@endsection
