@extends('layouts.main.admin-dashboard')

@section('content')
<div class="admin-body-area">
    <form action="{{ route('admin.homecontent.step.two.save', $dataArr['page']->id ) }}" method="POST" id="content_form"
        enctype="multipart/form-data">
        <div class="card">
        <div class="card-body">
        <div class="row">
        {{ csrf_field() }}
        <!-- Your form content here -->
        <div class="col-lg-12 col-md-12">
            <div class="category-list-area">
                <div class="upload-right-col" id="fullDiv">
                    <div class="row">
                        <div class="col-lg-12">
                            @include('includes.index_nav_tabs') 
                            
                            <div class="tab-content" style="overflow: hidden;width: 100%;">
                                <div id="step2" class="tab-pane active" role="tabpanel">
                                    <h2 class="por-Photo">Please provide details of the 1st section of
                                         your index page</h2>
                                    <div class="popup-form" style="width:100%" id="section1Holder">
                                        @foreach ($dataArr['pages'] as $pgVal)
                                            <div class="card mt-2">
                                                @if ($pgVal->pageBoxContent)
                                                    @foreach ($pgVal->pageBoxContent->content as $key => $content)
                                                        <div class="card-body contentStepItemBox">
                                                            <div class="form-field col-lg-12 fileFormField">
                                                                <input type="file"
                                                                name="image[{{ $pgVal['id'] }}][]"
                                                                class="form-control"
                                                                id="original-image-{{ $pgVal['id'] }}-{{ $key }}"
                                                                onchange="previewImages('original-image-{{ $pgVal['id'] }}-{{ $key }}', 'original-preview-{{ $pgVal['id'] }}-{{ $key }}')"
                                                                accept="image/*">
                                                            <div
                                                                id="original-preview-{{ $pgVal['id'] }}-{{ $key }}">
                                                                 <div class="preview-image">
                                                                    <img
                                                                        src="{{ asset('public/storage/page_box_image/') . '/' . $content->image }}">
                                                                </div> 
                                                            </div><br>  
                                                            </div>
                                                            <div class="form-field col-lg-12">
                                                                <input type="text"
                                                                    name="heading[{{ $pgVal['id'] }}][]"
                                                                    class="form-control"
                                                                    value="{{ $content->heading }}">
                                                            </div>
                                                            <div class="form-field col-lg-12">
                                                                <textarea name="description[{{ $pgVal['id'] }}][]" class="form-control"> {{ $content->description }} </textarea>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    @for ($loop = 0; $loop < 4; $loop++)
                                                        <div class="card-body contentStepItemBox">
                                                            <div class="form-field col-lg-12 fileFormField">
                                                                <input type="file"
                                                                name="image[{{ $pgVal['id'] }}][]"
                                                                class="form-control"
                                                                id="original-image-{{ $pgVal['id'] }}-{{ $loop }}"
                                                                onchange="previewImages('original-image-{{ $pgVal['id'] }}-{{ $loop }}', 'original-preview-{{ $pgVal['id'] }}-{{ $loop }}')"
                                                                accept="image/*" required>
                                                            <div
                                                                id="original-preview-{{ $pgVal['id'] }}-{{ $loop }}">
                                                            </div>
                                                            <br> 
                                                            </div>
                                                            <div class="form-field col-lg-12">
                                                                <input type="text"
                                                                    name="heading[{{ $pgVal['id'] }}][]"
                                                                    class="form-control" required />
                                                            </div>
                                                            <div class="form-field col-lg-12">
                                                                <textarea name="description[{{ $pgVal['id'] }}][]" class="form-control" required> </textarea>
                                                            </div>
                                                        </div>
                                                    @endfor
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="card-footer">
        <button type="button"  style="float:left;border-radius: 12px;margin-top: 15px;background-color:cornflowerblue;"  class="btn btn-default btn-lg" onclick="window.location='{{ route('admin.homecontent.step.one.update', $dataArr['page']->id) }}'">
            Back
        </button> 
        {{-- <button type="button"  style="float:left;border-radius: 12px;margin-top: 15px;background-color:cornflowerblue;"  class="btn btn-default btn-lg" onclick="window.location='{{ route('admin.homecontent.step.one.update', $dataArr['page']->id) }}'">
            Back
        </button>   --}}
        <button type="submit" class="btn btn-success btn-lg"
        style="float:right;border-radius: 12px;margin-top: 15px;">Save & Next</button>
        
    </div>
    </form>
</div>

@endsection

@push('script')
    <script>
        function previewImages(inputId, previewContainerId) {
            var previewContainer = document.getElementById(previewContainerId);
            var file = document.getElementById(inputId).files[0];

            var reader = new FileReader();

            reader.onload = function(e) {
                var img = document.createElement('img');
                img.src = e.target.result;

                var previewDiv = document.createElement('div');
                previewDiv.className = 'preview-image';
                previewDiv.appendChild(img);

                $(`#${previewContainerId}`).empty();
                previewContainer.appendChild(previewDiv);
            };

            reader.readAsDataURL(file);
        }
    </script>
@endpush