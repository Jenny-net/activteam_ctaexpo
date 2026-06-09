@extends('layouts.main.layout')
@section('content')
<!-- ================ Banner Section Start ================ -->


<!-- ================ Inner Page One First Section Start ================ -->
<section class="inrPageOneFirstSec">
	<div class="container">
		{!! $page->section_one !!}
	</div>
</section>
<!-- ================ Inner Page One First Section End ================ -->


<!-- ================ Inner Page Service Section Start ================ -->
<section class="inrSrvcSec">
	{!! $page->section_two !!}
</section>
<!-- ================ Inner Page Service Section End ================ -->


<!-- ================ Inner Page Best Service Section Start ================ -->
<section class="inrBestSrvcSec">
	<div class="container">
		{!! $page->section_three !!}
	</div>
</section>
<!-- ================ Inner Page Best Service Section End ================ -->

<!-- ================ Inner Page Project Description Section Start ================ -->
<section class="inrProjectDescriptionSec">
	<div class="inrProjectDescriptionRow">
		{!! $page->section_four !!}
	</div>
</section>

<!-- ================ Inner Page Project Description Section End ================ -->
@endsection



