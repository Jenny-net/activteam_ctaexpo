@extends('layouts.main.admin-dashboard')

@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <form action="{{ route('admin.content.step.two.save', $dataArr['content']->id) }}" method="POST" id="content_form"
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
                                                                        <textarea id="section_one{{ $pky }}" name="section_one[{{ $pgVal['id'] }}]" placeholder="meta_description"  class="form-control"> 
                                                                            @if(empty($pgVal['section_one']))
                                                                                    @if ($dataArr['content']->template == 'one')
                                                                                        <div class="secHdn">
                                                                                            <h2>our services</h2>
                                                                                            <h3 class="hdnBrdr">Architecture</h3>
                                                                                        </div>
                                                                                        <div class="inrPageOneFirstSecRow">
                                                                                            <div class="inrPageOneFirstSecLeftPrt">
                                                                                                <img src="{{asset('/public/assets/static-images/about-us-img.jpg')}}" alt="">
                                                                                            </div>
                                                                                            <div class="inrPageOneFirstSecRightPrt">
                                                                                                <p><strong>We apply innovative design solutions to enhance people’s residential wellbeing and to help workplaces succeed! All our team collaborates with our clients!</strong></p>
                                                                                                <p>All our team collaborates with our clients, across all of our 3 offices, which are located throughout the US. Our mission is to implement the outstanding design ideas and solutions for any project we’re working on… During that process we carefully combine client’s guidelines, technical possibilities, as well as the environmental issues. Engineering and interior design solutions that we deliver are usually born after a collaborative process.</p>
                                                                                                <p>All our team collaborates with our clients, across all of our 3 offices, which are located throughout the US. Our mission is to implement the outstanding design ideas and solutions for any project we’re working on… During that process we carefully combine client’s guidelines, technical possibilities, as well as the environmental issues. Engineering and interior design solutions that we deliver are usually born after a collaborative process.</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    @elseif ($dataArr['content']->template == 'two')
                                                                                    <div class="container">
                                                                                        <div class="portfolioHdnRow">
                                                                                            <div class="portfolioHdnLeftPrt">
                                                                                                <div class="secHdn">
                                                                                                    <h2>Portfolio</h2>
                                                                                                    <h3 class="hdnBrdr">our Latest <br>Projects</h3>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="portfolioHdnRightPrt">
                                                                                                <p>We specialize in author’s projects which represent your individuality. Our award-winning designers know how to create a perfect space for your. We stand for durable materials, qualitative work and innovative technologies. Enjoy our unique architectural solution and design projects! Archivolt.</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="portfolioItmPrt">
                                                                                        <div class="container-fluid">
                                                                                            <ul>
                                                                                                <li>
                                                                                                    <img src="{{asset('/public/assets/static-images/project-pic1.jpg')}}" alt="">
                                                                                                </li>
                                                                                                <li>
                                                                                                    <img src="{{asset('/public/assets/static-images/project-pic3.jpg')}}" alt="">
                                                                                                </li>
                                                                                                <li>
                                                                                                    <img src="{{asset('/public/assets/static-images/project-pic2.jpg')}}" alt="">
                                                                                                </li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                    @endif
                                                                            @else
                                                                             {{ $pgVal['section_one'] }} 
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
                        
                    <button type="button"  style="float:left;border-radius: 12px;margin-top: 15px;background-color:cornflowerblue;"  class="btn btn-default btn-lg" onclick="window.location='{{ route('admin.content.edit', $dataArr['content']->id) }}'">
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
            @if ($dataArr['content']->pages->count())
                @foreach ($dataArr['content']->pages as $pky => $pgVal)
                    var editor = CKEDITOR.replace('section_one{{ $pky }}', {
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
