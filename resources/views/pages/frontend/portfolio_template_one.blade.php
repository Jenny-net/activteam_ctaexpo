@extends('layouts.main.layout')
@section('content')
<style>
	.custom-mass-url {
		display: flex;
	}
	
	.custom-mass-url p {
		margin-right: 10px; /* Add spacing between paragraphs */
	}
</style>
<!-- ================ Gallery Body First Section Start ================ -->
<section class="galleryBodyFirstSec textContent">

	<div class="container">
		{!! $page->section_two !!}
		
       

       
        
        <div class="galleryPrt">
			<div class="previews">
				<ul class="image-list">
					
						@forelse($portfolioImages as $index => $image)
							<li class="{{ $index < 10 ? 'active' : 'inactive' }}">
								<a href="#" data-full="{{ asset('public/storage/gallery/' . $image->gallery_image) }}">
									<img src="{{ asset('public/storage/gallery/' . $image->gallery_image) }}" />
								</a>
							</li>
						@empty
							
						@endforelse
					
					
				</ul>
				<div class="nextPreviousBtn">
					<a href="#" id="previous-button">Previous</a>
					<a href="#" id="next-button">Next</a>
				</div>
			</div>
			<div class="full">
				<img src="{{ asset('public/storage/gallery/' . $portfolioImages[0]->gallery_image) }}" />
			</div>
		</div>
		
		
		
            
        <div class="container">
			<div class="custom-mass-url">
				
				{!! $page->section_one !!}
				
			</div>
			
			
		</div>

      
        
    </div>

</section>
<!-- ================ Gallery Body First Section End ================ -->


  
<!-- ================ Gallery Body Second Section Start ================ -->
<section class="galleryBodySecondSec lightGrayBg textContent">

	<div class="container">
		{!! $page->section_three !!}

</section>
<!-- ================ Gallery Body Second Section End ================ -->


<!-- ================ Gallery Body Third Section Start ================ -->
<section class="galleryBodyThirdSec lightBlueBg textContent">

	<div class="container">
		{!! $page->section_four !!}
	</div>
	
</section>
<!-- ================ Gallery Body Third Section End ================ -->


<!-- ================ Gallery Body Fourth Section Start ================ -->
<section class="galleryBodyFourthSec textContent">

	<div class="container">
		{!! $page->section_five !!}
	</div>
	
</section>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var currentGroup = 0;
    var groupSize = 10;
    var portfolioImages = @json($portfolioImages);

    function updateGallery() {
        var activeItems = $('.image-list li');
        var startIdx = currentGroup * groupSize;
        var endIdx = (currentGroup + 1) * groupSize;

        activeItems.hide();
        activeItems.slice(startIdx, endIdx).show();

        // Show/Hide Previous and Next buttons
        if (currentGroup === 0) {
            $('#previous-button').hide();
        } else {
            $('#previous-button').show();
        }

        if (endIdx >= portfolioImages.length) {
            $('#next-button').hide();
        } else {
            $('#next-button').show();
        }
    }

    $('#next-button').on('click', function (e) {
        e.preventDefault();
        if ((currentGroup + 1) * groupSize < portfolioImages.length) {
            currentGroup++;
            updateGallery();
        }
    });

    $('#previous-button').on('click', function (e) {
        e.preventDefault();
        if (currentGroup > 0) {
            currentGroup--;
            updateGallery();
        }
    });

    // Initialize the gallery
    updateGallery();
</script>



<!-- ================ Gallery Body Fourth Section End ================ -->
@endsection