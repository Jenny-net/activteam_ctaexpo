@extends('layouts.main.layout')
@section('content')
<section class="inrBestSrvcSec">
	<div class="container">
		{!! $page->section_one !!}
	</div>
	<div class="portfolioItmPrt">
		<div class="container-fluid">
			<ul>
				@foreach($massImages as $key => $image)
                    @if($key % 12 < 3)
                        <li><img src="{{ asset('public/storage/' . $image->mass_image) }}" alt="{{ $image->mass_image_alt }}"></li>
                    @endif
                @endforeach
				
			</ul>
		</div>
	</div>
</section>
<section class="inrPageTwoSecondSec">
	{!! $page->section_two !!}
	<div class="portfolioItmPrt">
		<div class="container-fluid">
			<ul>
				@foreach($massImages as $key => $image)
                    @if($key % 12 >= 3 && $key % 12 < 6)
                        <li><img src="{{ asset('public/storage/' . $image->mass_image) }}" alt="{{ $image->mass_image_alt }}"></li>
                    @endif
                @endforeach
				
			</ul>
		</div>
	</div>
	
</section>
<section class="inrBestSrvcSec">
	{!! $page->section_three !!}
	<div class="portfolioItmPrt">
		<div class="container-fluid">
			<ul>
				@foreach($massImages as $key => $image)
                    @if($key % 12 >= 6 && $key % 12 < 9)
                        <li><img src="{{ asset('public/storage/' . $image->mass_image) }}" alt="{{ $image->mass_image_alt }}"></li>
                    @endif
                @endforeach
				
			</ul>
		</div>
	</div>
	
</section>
<section class="inrPageTwoSecondSec">
	{!! $page->section_four !!}

	<div class="portfolioItmPrt">
		<div class="container-fluid">
			<ul>
				@foreach($massImages as $key => $image)
                    @if($key % 12 >= 9 && $key % 12 < 12)
                        <li><img src="{{ asset('public/storage/' . $image->mass_image) }}" alt="{{ $image->mass_image_alt }}"></li>
                    @endif
                @endforeach
				
			</ul>
		</div>
	</div>
</section>
@endsection




