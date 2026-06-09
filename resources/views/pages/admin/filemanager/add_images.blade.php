@extends('layouts.main.admin-dashboard')

@section('content')
    <title>Image Upload Form</title>
    <form action="{{ route('admin.filemanager.save') }}" method="post" enctype="multipart/form-data">
        <div class="admin-body-area">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        {{ csrf_field() }}
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <input type="text" name="image_folder" id="image_folder" class="form-control"
                                    placeholder="Image Folder" required /><br>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <input type="file" name="original_image[]" id="original-image"class="form-control"
                                    multiple onchange="previewImages('original-image', 'original-preview')"
                                    accept="image/*" required /><br>
                                <div id="original-preview"></div><br>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-lg"
                        style="float: left; border-radius: 12px; margin-top: 15px;">Save</button>
                </div>
            </div>
        </div>
    </form>

@stop
@push('script')
    <script>
        function previewImages(inputId, previewContainerId) {
            var previewContainer = document.getElementById(previewContainerId);
            var files = Array.from(document.getElementById(inputId).files);

            $("#original-preview").empty();
            files.forEach(function(file) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;

                    var previewDiv = document.createElement('div');
                    previewDiv.className = 'preview-image';
                    previewDiv.appendChild(img);

                    previewContainer.appendChild(previewDiv);
                };

                reader.readAsDataURL(file);
            });
        }
    </script>
@endpush
