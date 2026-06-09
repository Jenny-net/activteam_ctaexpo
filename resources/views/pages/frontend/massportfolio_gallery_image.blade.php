@extends('layouts.main.layout')
@section('content')
<!-- ================ Gallery Body First Section Start ================ -->
<section class="galleryBodyFirstSec textContent">

	<div class="container">
		
		
	<div><h3 style="text-align: center;">{{ $contentTitle }}</h3>

	</div>

       
        
        <div class="galleryPrt">
			<div class="previews">
				<ul class="image-list">
					@forelse($portfolioImages as $index => $image)
						<li class="{{ $index < 10 ? 'active' : 'inactive' }}">
							<a href="#" data-full="{{ asset('public/storage/massgallery/' . $image->mass_gallery) }}">
								<img src="{{ asset('public/storage/massgallery/' . $image->mass_gallery) }}" />
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
				<img src="{{ asset('public/storage/massgallery/' . $portfolioImages[0]->mass_gallery) }}" />
			</div>
		</div>
		
		
		
{{--             
        <div class="container">
			<ul class="nav nav-tabs">
				
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#tab">gallery1</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#tab">gallery2</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#tab">gallery3</a>
					</li>
				
			</ul>
			
		</div> --}}

      
        
    </div>

</section>
<!-- ================ Gallery Body First Section End ================ -->


  
<!-- ================ Gallery Body Second Section Start ================ -->

<!-- ================ Gallery Body Second Section End ================ -->


<!-- ================ Gallery Body Third Section Start ================ -->

<!-- ================ Gallery Body Third Section End ================ -->


<!-- ================ Gallery Body Fourth Section Start ================ -->



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