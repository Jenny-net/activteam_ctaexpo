@extends('layouts.main.layout')
@section('content')



<section class="portfolioSec">
	{!! $page->section_one !!}
</section>

<section class="inrPageTwoSecondSec">
	<div class="container">
		<div class="secHdn">
			{!! $page->section_two !!}
		</div>
		<div class="inrPageTwoSecondSecItemRow">
			{!! $page->section_three !!}
		</div>
	</div>
</section>



<section class="projectSec inrPageTwoThirdSec">
	<div class="exclusiveProjectPrt">
		{!! $page->section_four !!}
	</div>
</section>



<section class="inrPageTwoFourthSec">
	<div class="container">
		{!! $page->section_five !!}
	</div>
</section>



@endsection
