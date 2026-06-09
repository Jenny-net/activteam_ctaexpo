@extends('layouts.main.admin-dashboard')

@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <form action="{{ route('admin.banner.content.save', $dataArr['content']->id) }}" method="POST" id="content_form" enctype="multipart/form-data">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        {{ csrf_field() }}

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Page Name</label>
                                <input type="text" class="form-control" name="content_title" id="content_title"
                                    placeholder="Content Title" value="{{ $dataArr['content']->content_title }}" disabled>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Select Template</label>
                                <select class="form-control" name="template" disabled>
                                    <option value="">Select Teplate</option>
                                    <option {{ $dataArr['content']->template == 'one' ? 'selected' : '' }} value="1">
                                        Template One</option>
                                    <option {{ $dataArr['content']->template == 'two' ? 'selected' : '' }} value="2">
                                        Template Two</option>
                                        <option {{ $dataArr['content']->template == 'three' ? 'selected' : '' }} value="2">
                                            Template Three</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Select Menu</label>
                                <select class="form-control" name="menu_id" disabled>
                                    <option>{{ $dataArr['content']->menu->menu_name }}</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-lg-12 col-md-12">
                            <div class="category-list-area">
                                <div class="upload-right-col" id="fullDiv">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @include('includes.nav_tabs')

                                            <div class="tab-content" style="overflow: hidden;width: 100%;">
                                                <div id="step2" class="tab-pane active" role="tabpanel">
                                                    <h2 class="por-Photo">Please provide Banner image with Content</h2>
                                                    <div class="popup-form" style="width:100%" id="section1Holder">

                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="form-group">
                                                                <label>Inner Page Banner</label>
                                                                <input type="file" class="form-control-file" name="inner_page_banner" accept="image/*" {{ ($dataArr['innerBannerPagedata'] && $dataArr['innerBannerPagedata']->banner_page_content) ? '' : 'required' }}>
                                                                <small class="form-text text-muted">Upload an image for the inner page banner.</small>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="form-group">
                                                                <label>Image Preview</label>
                                                                <div class="image-preview" id="imagePreview">
                                                                    @if($dataArr['innerBannerPagedata'] && $dataArr['innerBannerPagedata']->banner_page_content)
                                                                        <img src="{{ asset('public/storage/' . json_decode($dataArr['innerBannerPagedata']->banner_page_content)->image) }}" class="img-thumbnail" width="100">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="form-group">
                                                                <label for="banner_heading">Banner Heading</label>
                                                                <input type="text" class="form-control" name="banner_headings" placeholder="Banner Heading" value="{{ $dataArr['innerBannerPagedata'] ? json_decode($dataArr['innerBannerPagedata']->banner_page_content)->heading : '' }}" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="form-group">
                                                                <label for="banner_description">Banner Description</label>
                                                                <textarea class="form-control" name="banner_descriptions" placeholder="Banner Description" required>{{ $dataArr['innerBannerPagedata'] ? json_decode($dataArr['innerBannerPagedata']->banner_page_content)->description : '' }}</textarea>
                                                            </div>
                                                        </div>

                                                        <!-- ... Add other fields here ... -->

                                                    </div>
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
                    <button type="button" style="float:left;border-radius: 12px;margin-top: 15px;background-color:cornflowerblue;" class="btn btn-default btn-lg" onclick="window.location='{{ route('admin.content.edit', $dataArr['content']->id) }}'">Back</button>
                    <button type="submit" class="btn btn-success btn-lg" style="float:right;border-radius: 12px;margin-top: 15px;">Save & Next</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Booking Status Section Start -->
@stop

@push('script')
    <script>
        $(document).ready(function () {
            $('input[name="inner_page_banner"]').on('change', function (e) {
                var file = e.target.files[0];
                var previewId = $('#imagePreview');

                if (file) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        previewId.html('<img src="' + e.target.result + '" class="img-thumbnail" width="100">');
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewId.html('');
                }
            });
        });
    </script>
@endpush
