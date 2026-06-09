@extends('layouts.main.layout')
@section('content')


<!-- ================ Banner Section Start ================ -->
<section class="bannerSec">
	<div class="bannerImg">
		<img src="{{ asset('/public/frontend/images/banner.jpg') }}" alt="">
	</div>
</section>
<!-- ================ Banner Section End ================ -->



<!-- ================ Template Five Start ================ -->
<!-- Template Five First Section -->
{{-- <section class="templateFiveFirstSec">
	<div class="container">
		{!! $page->section_one !!}
		<div class="clear"></div>
	</div>
</section>


<!-- Template Five Second Section -->
<section class="templateFiveSecondSec lightGrayBg">
	<div class="container">
		{!! $page->section_two !!}
		<div class="clear"></div>
	</div>
</section>


<!-- Template Five Third Section -->
<section class="templateFiveThirdSec">
	<div class="container">
		{!! $page->section_three !!}
	</div>
</section>


<!-- Template Five Fourth Section -->
<section class="templateFiveFourthSec lightBlueBg">
	<div class="container">
		{!! $page->section_four !!}
	</div>
</section> --}}

<!-- Template Five First Section -->
<section class="templateFiveFirstSec textContent">
	<div class="container">
		{!! $page->section_one !!}
		<div class="clear"></div>
	</div>
</section>


<!-- Template Five Second Section -->
<section class="templateFiveSecondSec lightGrayBg textContent">
	<div class="container">
		{!! $page->section_two !!}
		<div class="clear"></div>
	</div>
</section>


<!-- Template Five Third Section -->
<section class="templateFiveThirdSec textContent">
	<div class="container">
		{!! $page->section_three !!}
	</div>
</section>


<!-- Template Five Fourth Section -->
<section class="templateFiveFourthSec lightBlueBg textContent">
	<div class="container">
		{!! $page->section_four !!}
	</div>
</section>



<!-- ================ Template Five End ================ -->



@endsection
<!-- ================ Template Five End ================ -->


