@extends('layouts.main.admin-dashboard')

@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <form action="{{ route('admin.content.step.four.template.one.save', $dataArr['content']->id) }}" method="POST"
            id="content_form" enctype="multipart/form-data">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        {{ csrf_field() }}


                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Content Title</label>
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
                                </select>
                            </div>
                        </div>

                    


                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>No of pages</label>
                                <input type="number" name="no_of_pages" value="{{ $dataArr['content']->pages->count() }}"
                                    class="form-control" min="1" id="pageNo" disabled>
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
                                                    <h2 class="por-Photo">Please provide details of 1st section(s) of all
                                                        your pages</h2>
                                                    <div class="popup-form" style="width:100%" id="section1Holder">
                                                        @forelse ($dataArr['content']->pages as $pky => $pgVal)
                                                            <div class="card mt-2">
                                                                <div class="card-header">
                                                                    <h4>Page No: {{ $pky + 1 }}</h4>
                                                                </div>
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
                                                                        <div class="card-body">
                                                                            <div class="form-field col-lg-12">
                                                                                <input type="file"
                                                                                    name="image[{{ $pgVal['id'] }}][]"
                                                                                    class="form-control"
                                                                                    id="original-image-{{ $pgVal['id'] }}-{{ $loop }}"
                                                                                    onchange="previewImages('original-image-{{ $pgVal['id'] }}-{{ $loop }}', 'original-preview-{{ $pgVal['id'] }}-{{ $loop }}')"
                                                                                    accept="image/*" required><br>
                                                                                <div
                                                                                    id="original-preview-{{ $pgVal['id'] }}-{{ $loop }}">
                                                                                </div><br>
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
                                                        @empty
                                                        @endforelse
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
                    <button type="button" class="buttonOne btn btn-default btn-lg"
                        style="float:left;border-radius: 12px;margin-top: 15px;background-color:cornflowerblue;"
                        onclick="window.location='{{ route('admin.content') }}'">Cancel</button>
                    <button type="submit" class="buttonTwo btn btn-success btn-lg"
                        style="float:right;border-radius: 12px;margin-top: 15px;">Save & Next</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Booking Status Section Start -->
@stop

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
