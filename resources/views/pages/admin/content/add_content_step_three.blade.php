@extends('layouts.main.admin-dashboard')

@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <form action="{{ route('admin.content.step.three.save', $dataArr['content']->id) }}" method="POST" id="content_form"
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
                                                                {{-- <div class="card-header">
                                                                    <h4>Page No: {{ $pky + 1 }}</h4>
                                                                </div> --}}
                                                                <div class="card-body">
                                                                    <div class="form-field col-lg-12">
                                                                        <textarea id="section_two{{ $pky }}" name="section_two[{{ $pgVal['id'] }}]" placeholder="meta_description" class="form-control">
                                                                            @if(empty($pgVal['section_two']))
                                                                            @if ($dataArr['content']->template == 'one')
                                                                            <div class="inrSrvcImgPrt">
                                                                                <div class="container">
                                                                                    <ul>
                                                                                        <li><img src="{{asset('/public/assets/static-images/inner-service-img1.jpg')}}" alt="" /></li>
                                                                                        <li><img src="{{asset('/public/assets/static-images/inner-service-img2.jpg')}}" alt="" /></li>
                                                                                        <li><img src="{{asset('/public/assets/static-images/inner-service-img3.jpg')}}" alt="" /></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        
                                                                            <div class="srvcTstmnlRow">
                                                                                <div class="srvcBenefitLeftPrt">
                                                                                    <div class="srvcBenefitTextArea">
                                                                                        <div class="secHdn">
                                                                                            <h2>OUR SERVICE BENEFITS</h2>
                                                                                            <h3 class="hdnBrdr">Experience Innovation <br/>the Professional Way</h3>
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
                                                                                <div class="rightTestimonialPrt" style="background-image: url('https://ctaexpo.com/public/assets/static-images/about-us-img.jpg');" >
                                                                                    <div class="testimonialTextPrt">
                                                                                        <div class="secHdn">
                                                                                            <h2>TESTIMONIALS</h2>
                                                                                            <h3 class="hdnBrdr">WHAT OUR <br/>CLIENTS SAY</h3>
                                                                                        </div>
                                                                                        <p><i>It is not every construction company that can build a building from ground up and complete 80,000 sq. ft. of first class office improvement space in 13 months.</i></p>
                                                                                        <p class="testiAuthor">
                                                                                            <strong>Kent</strong> --posted on TripAdvisor
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @elseif ($dataArr['content']->template == 'two')
                                                                            <div class="secHdn">
                                                                                <h2>Portfolio</h2>
                                                                                <h3 class="hdnBrdr">our Latest <br>Projects</h3>
                                                                                <p>We specialize in author’s projects which represent your individuality. Our award-winning designers know how to create a perfect space for your. We stand for durable materials, qualitative work and innovative technologies. Enjoy our unique architectural solution and design projects! Archivolt.</p>
                                                                            </div>
                                                                            
                                                                            @endif
                                                                            @else
                                                                            {{ $pgVal['section_two'] }} 
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
                        
                        <button type="button"  style="float:left;border-radius: 12px;margin-top: 15px;background-color:cornflowerblue;"  class="btn btn-default btn-lg" onclick="window.location='{{ route('admin.content.step.two.update', $dataArr['content']->id) }}'">
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
                    var editor = CKEDITOR.replace('section_two{{ $pky }}', {
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
