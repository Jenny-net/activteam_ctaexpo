@extends('layouts.main.admin-dashboard')

@section('content')
<div class="admin-body-area">
    <!-- Edit Section Start -->
    <div class="booking-status-sec category-list-sec">
        <div class="category-list-hdn">
            <h2>{{ $dataArr['page_title'] }}</h2>
            <h3 class="create-cat">
                <a href="{{ route('admin.social') }}">Back</a>
            </h3>
        </div>

        <div class="category-list-area">
            <form action="{{ route('admin.social.update', $dataArr['social']->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
               
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Social Icon</label>
                                <input type="file" name="social_icon" class="form-control-file" accept="image/*" onchange="previewImage('social_icon', 'iconPreview', this);">
                                <img id="iconPreview" src="{{ asset('public/storage/' . $dataArr['social']->social_icon) }}" alt="Icon Preview" class="img-preview">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group" id="page_url_field">
                                <label>SOCIAL SITE URL</label>
                                <input type="text" name="social_url" class="form-control" id="page_url" value="{{ $dataArr['social']->url }}">
                            </div>
                        </div>
                    </div>
                </div>

                <br/>

                <button class="submit-btn subbtn" type="submit">Update</button>
            </form>
        </div>
    </div>
</div>
<!-- Edit Section Start -->
@stop

@push('script')
<script>
    function previewImage(inputName, previewId, inputElement) {
        var preview = document.getElementById(previewId);
        var file = inputElement.files[0];
        var reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush
