@extends('layouts.main.admin-dashboard')

@section('content')
<div class="admin-body-area">
    <!-- Booking Status Section Start -->
    <div class="booking-status-sec category-list-sec">
        <div class="category-list-hdn">
            <h2>Update Slider</h2>
            <h3 class="create-cat">
                
            </h3>
        </div>

        <div class="category-list-area">
            <form action="{{ route('admin.slider.update', $dataArr['slider']->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="col-lg-6 col-md-6">
                            
                            <div class="form-group">
                                <label>Slider image </label>
                                <input type="file" name="slider_file" class="form-control-file" accept="image/*" onchange="previewImageOrVideo('slider_file', 'previewContainer', this);">
                                <div id="previewContainer">
                                    @if($dataArr['slider'] && in_array(pathinfo($dataArr['slider']->slider_file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                        <img src="{{ asset('public/storage/' . $dataArr['slider']->slider_file) }}" alt="Slider Preview">
                                    @elseif($dataArr['slider'] && pathinfo($dataArr['slider']->slider_file, PATHINFO_EXTENSION) === 'mp4')
                                        <video autoplay muted loop controls width="320" height="240">
                                            <source src="{{ asset('public/storage/' . $dataArr['slider']->slider_file) }}" type="video/mp4">
                                        </video>
                                    @endif
                                </div>
                            </div>
                            
                        </div>

                        

                        

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group" id="heading">
                                <label>Text Area One:</label>
                                <input type="text" name="heading_section" class="form-control" id="heading_content" value="{{ $dataArr['slider']->heading }}" style="width: 900px; height: 50px;">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group" id="content">
                                <label>Text Area Two:</label>
                                <input type="text" name="content_section" class="form-control" id="content_section" value="{{ $dataArr['slider']->content }}" style="width: 900px; height: 50px;">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group" id="content">
                                <label>Read More:</label>
                                <input type="text" name="readmore_label" class="form-control" id="readmore_label" value="{{ $dataArr['slider']->readmore_label }}" style="width: 900px; height: 50px;">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group" id="content">
                                <label>Read More Page Url:</label>
                                <input type="text" name="page_url" class="form-control" id="page_url" value="{{ $dataArr['slider']->page_url }}" style="width: 900px; height: 50px;">
                            </div>
                        </div>
                        
                       
                    </div>
                </div>

                <br/>

                <button class="submit-btn subbtn" type="submit">Submit</button>
                <button class="create-cat" type="button" style="margin-left: 10px;"><a href="{{ route('admin.slider.index') }}">Back</a></button>

            </form>
        </div>
    </div>
</div>
<!-- Booking Status Section Start -->
@stop

@push('script')
<script>
    function previewImageOrVideo(inputName, previewContainerId, inputElement) {
    var previewContainer = document.getElementById(previewContainerId);
    var file = inputElement.files[0];

    if (file) {
        var fileType = file.type;

        if (fileType.startsWith('image')) {
            // Display image preview
            var imgPreview = document.createElement('img');
            imgPreview.src = URL.createObjectURL(file);
            imgPreview.alt = 'Slider Preview';
            imgPreview.className = 'img-preview';
            imgPreview.width = 320; // Set the width of the image
            imgPreview.height = 240; // Set the height of the image
            previewContainer.innerHTML = ''; // Clear previous preview
            previewContainer.appendChild(imgPreview);
        } else if (fileType === 'video/mp4') {
            // Display video preview
            var videoPreview = document.createElement('video');
            videoPreview.autoplay = true;
            videoPreview.muted = true;
            videoPreview.loop = true;
            videoPreview.controls = true; // Display video controls
            var source = document.createElement('source');
            source.src = URL.createObjectURL(file);
            source.type = 'video/mp4';
            videoPreview.appendChild(source);
            videoPreview.width = 320; // Set the width of the video
            videoPreview.height = 240; // Set the height of the video
            previewContainer.innerHTML = ''; // Clear previous preview
            previewContainer.appendChild(videoPreview);
        }
        
        previewContainer.style.display = 'block';
    } else {
        previewContainer.style.display = 'none';
        previewContainer.innerHTML = ''; // Clear preview
    }
}

function previewImage(inputId, playbtnPreview, inputElement) {
        var preview = document.getElementById(playbtnPreview);
        var file = inputElement.files[0];
        var reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block'; // Show the image preview
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
//             // Clear the preview if no file is selected
             preview.src = '';
             preview.style.display = 'none';
         }
     }
</script>
@endpush
