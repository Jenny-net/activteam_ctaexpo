@extends('layouts.main.admin-dashboard')

@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <form action="{{ route('admin.content.step.five.one.save', $dataArr['content']->id) }}" method="POST" id="content_form"
            enctype="multipart/form-data">
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
                                                               
                                                                <div class="card-body">
                                                                    <div class="form-field col-lg-12">
                                                                        <textarea id="section_four{{ $pky }}" name="section_four[{{ $pgVal['id'] }}]" placeholder="meta_description" class="form-control">
                                                                            @if(empty($pgVal['section_four']))
                                                                            @if ($dataArr['content']->template == 'one') 
                                                                            <div class="inrProjectDescriptionLeftPrt">
                                                                                <div class="inrProjectDescriptionLeftContentArea">
                                                                                    <div class="secHdn">
                                                                                        <h2>DESCRIPTION</h2>
                                                                                        <h3 class="hdnBrdr">PROJECT <br/>DESCRIPTION</h3>
                                                                                    </div>
                                                                                    <p>Size : 16121 sq m<br>Location : New York United States <br>Creative Director : Anozu Joe <br>Project start : 2015 june <br>Project finish : 2016 august <br>Value : $40m.</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="inrProjectDescriptionRightPrt">
                                                                                <div class="inrProjectDescriptionRightContentArea">
                                                                                    <div class="secHdn">
                                                                                        <h2>DESCRIPTION</h2>
                                                                                        <h3 class="hdnBrdr">PROJECT <br/>DESCRIPTION</h3>
                                                                                    </div>
                                                                                    <p>Our research phase is very important. We do our best to plan every possible outcome, which would affect the budget and time of finishing the project:</p>
                                                                                    <ul class="dfltList">
                                                                                        <li>Based on your project, get only what's needed</li>
                                                                                        <li>Cost effective, to secure construction process</li>
                                                                                        <li>Premium quality. We always get the best people</li>
                                                                                    </ul>
                                                                                    <p>Through this experience Warmhouse  has acquired a high level of expertise in the design and realisation of high-profile and luxury schemes.</p>
                                                                                </div>
                                                                            </div>
                                                                            @elseif ($dataArr['content']->template == 'two')
                                                                            <div class="exclusiveProjectPrt">
                                                                                <div class="exclusiveProjectLeftHdnPrt">
                                                                                    <div class="exclusiveProjectHdn">
                                                                                        <div class="secHdn">
                                                                                            <h2>Advantages</h2>
                                                                                            <h3 class="hdnBrdr">Working On <br>Exclusive Projects</h3>
                                                                                        </div>
                                                                                        <p>All our team collaborates with our clients, across all of our 3 offices, which are located throughout the US. Our mission is to implement the outstanding design ideas and solutions for any project we’re working on… During that process we carefully combine client’s guidelines, technical possibilities, as well as the environmental issues. Engineering and interior design solutions that we deliver are usually born after a collaborative process.</p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="exclusiveProjectRightTextPrt">
                                                                                    <div class="exclusiveProjectTxt">
                                                                                        <div class="secHdn">
                                                                                            <h2>Advantages</h2>
                                                                                            <h3 class="hdnBrdr">Working On <br>Exclusive Projects</h3>
                                                                                        </div>
                                                                                        <p>All our team collaborates with our clients, across all of our 3 offices, which are located throughout the US. Our mission is to implement the outstanding design ideas and solutions for any project we’re working on… During that process we carefully combine client’s guidelines, technical possibilities, as well as the environmental issues. Engineering and interior design solutions that we deliver are usually born after a collaborative process.</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            @endif
                                                                            @else
                                                                            {{ $pgVal['section_four'] }} 
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
                        
                        <button type="button"  style="float:left;border-radius: 12px;margin-top: 15px;background-color:cornflowerblue;"  class="btn btn-default btn-lg" onclick="window.location='{{ route('admin.content.step.four.update', $dataArr['content']->id) }}'">
                            Back
                        </button>
                    <button type="submit" class="btn btn-success btn-lg"
                        style="float:right;border-radius: 12px;margin-top: 15px;">Complete</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Booking Status Section Start -->
@stop

@push('script')
    <script>
        $(document).ready(function() {
            @if ($dataArr['content']->pages->count())
                @foreach ($dataArr['content']->pages as $pky => $pgVal)
                    var editor = CKEDITOR.replace('section_four{{ $pky }}', {
                        filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                        filebrowserUploadMethod: 'form',
                        allowedContent: true
                    });
                    editor.on('required', function(evt) {
                        editor.showNotification('This field is required.', 'warning');
                        evt.cancel();
                    });
                @endforeach
            @endif
        });
    </script>
@endpush
