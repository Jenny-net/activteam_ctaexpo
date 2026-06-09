
@extends('layouts.main.admin-dashboard')

@section('content')
    <div class="admin-body-area">
        <!-- Content markup goes here -->
        <form action="{{ route('admin.masscontent.step.four.save', $dataArr['content']->id) }}" method="POST" id="content_form"  enctype="multipart/form-data">
            
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
                                    <option value="">Select Template</option>
                                    <option {{ $dataArr['content']->template == 'one' ? 'selected' : '' }} value="1">
                                        Template One</option>
                                    <option {{ $dataArr['content']->template == 'two' ? 'selected' : '' }} value="2">
                                        Template Two</option>
                                    <option {{ $dataArr['content']->template == 'three' ? 'selected' : '' }} value="3">
                                        Template Three</option>
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
                                            @include('includes.mass_nav_tabs')

                                            <div class="tab-content" style="overflow: hidden;width: 100%;">
                                                <div id="step2" class="tab-pane active" role="tabpanel">
                                                    <h2 class="por-Photo">Please provide details of 3rd section(s) of all
                                                        your pages
                                                        @if ($dataArr['content']->template == 'one')
                                                        <br><span style="color: red;">*Note: Preferred Image Size 458 × 289 </span>
                                                        @elseif ($dataArr['content']->template == 'two')
                                                            <br><span style="color: red;">*Note: Preferred Image Size 458 × 289</span>
                                                        @elseif ($dataArr['content']->template == 'three')
                                                            <br><span style="color: red;"> </span>
                                                        @endif
                                                    </h2>
                                                    <div class="popup-form" style="width:100%" id="section1Holder">
                                                        @forelse ($dataArr['content']->pages as $pky => $pgVal)
                                                            <div class="card mt-2">
                                                                 <div class="card-header">
                                                                    <h4>Page No: {{ $pky + 1 }}</h4>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="form-field col-lg-12">
                                                                        <textarea id="section_three{{ $pky }}" name="section_three[{{ $pgVal['id'] }}]" placeholder="meta_description" class="form-control">
                                                                            @if(empty($pgVal['section_three']))
                                                                            @if ($dataArr['content']->template == 'one')
                                                                            <div class="secHdn">
                                                                                <h3 class="hdnBrdr">Exhibition booth design and construction for Agritechnica.</h3>
                                                                            </div>
                                                                            @elseif ($dataArr['content']->template == 'two') 
                                                                            <div class="container">
                                                                                <div class="bestSrvcHdnRow">
                                                                                    <div class="secHdn">
                                                                                        <h3 class="hdnBrdr">An impressive atmosphere</h3>
                                                                                    </div>
                                                                                    <div class="hdnText">
                                                                                        <p>The booth design of Tamouh was unique with integrated elements from modern Arabian architecture. Guests were very impressed by both the project and the presentation. Modern Exhibition booth design is more powerful if local architecture is implemented, reflecting the exhibitor's culture.</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @endif
                                                                            @else
                                                                            {{ $pgVal['section_three'] }}  
                                                                            @endif
                                                                            
                                                                            
                                                                        </textarea>
                                                                    </div>
                                                                </div>
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
                    <button type="button" style="float:left;border-radius: 12px;margin-top: 15px;background-color:cornflowerblue;"  class="btn btn-default btn-lg" onclick="window.location='{{ route('admin.masscontent.step.three.update', $dataArr['content']->id) }}'">
                        Back
                    </button>
                    <button type="submit" class="btn btn-success btn-lg"
                        style="float:right;border-radius: 12px;margin-top: 15px;">Save & Next</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Booking Status Section Start -->
@stop

@push('script')
    <script>
        $(document).ready(function() {
            var template = "{{ $dataArr['content']->template }}";

            if (template !== 'three') {
                @if ($dataArr['content']->pages->count())
                    @foreach ($dataArr['content']->pages as $pky => $pgVal)
                        CKEDITOR.replace('section_three{{ $pky }}', {
                            filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                            filebrowserUploadMethod: 'form',
                            allowedContent: true
                        });
                    @endforeach
                @endif
            } else {
                @if ($dataArr['content']->pages->count())
                    @foreach ($dataArr['content']->pages as $pky => $pgVal)
                        CKEDITOR.replace('section_three{{ $pky }}', {
                            filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                            filebrowserUploadMethod: 'form',
                            allowedContent: true,
                            removeButtons: 'Image'
                        });
                    @endforeach
                @endif
            }
        });
    </script>
@endpush
