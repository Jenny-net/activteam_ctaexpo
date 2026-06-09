@extends('layouts.main.admin-dashboard')

@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <form action="{{ route('admin.content.step.four.save', $dataArr['content']->id) }}" method="POST" id="content_form"
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
                                                                        <textarea id="section_three{{ $pky }}" name="section_three[{{ $pgVal['id'] }}]" placeholder="meta_description" class="form-control">
                                                                            @if(empty($pgVal['section_three']))
                                                                            @if ($dataArr['content']->template == 'one')
                                                                                    <div class="bestSrvcHdnRow">
                                                                                        <div class="secHdn">
                                                                                            <h2>OUR SERVICES</h2>
                                                                                            <h3 class="hdnBrdr">LOOK OUR <br/>BEST SERVICES</h3>
                                                                                        </div>
                                                                                        <div class="hdnText">
                                                                                            <p>Explore the history of the classic Lorem Ipsum passage and generate your own text using any number of characters, words, sentences or paragraphs. Commonly used as placeholder text in the graphic and print industries, Lorem Ipsum’s origins extend far back to a scrambled Latin passage.</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="bestSrvcItemPrt">
                                                                                        <ul>
                                                                                            <li>
                                                                                                <img class="bestSrvcItmImg" src="{{asset('/public/assets/static-images/best-service-item1.webp')}}" alt="" />
                                                                                                <div class="bestSrvcItmText">
                                                                                                    <h4>INTERIOR PLANING</h4>
                                                                                                    <p>A relaxing bathroom helps you start and end your day in good spirits. It’s beneficial to have well designed storage to keep an open, clean feel.</p>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li>
                                                                                                <img class="bestSrvcItmImg" src="{{asset('/public/assets/static-images/best-service-item2.webp')}}" alt="" />
                                                                                                <div class="bestSrvcItmText">
                                                                                                    <h4>LANDSPACING</h4>
                                                                                                    <p>We all are living busy lives, giving time to family, friends, and work, hence our bedroom is oftentimes the place where we go to relax and escape everyday life struggles.</p>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li>
                                                                                                <img class="bestSrvcItmImg" src="{{asset('/public/assets/static-images/best-service-item3.webp')}}" alt="" />
                                                                                                <div class="bestSrvcItmText">
                                                                                                    <h4>DECORATION</h4>
                                                                                                    <p>For improving entire appeal of the house homeowners can opt for the renovation projects. Unique renovation can completely.</p>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li>
                                                                                                <img class="bestSrvcItmImg" src="{{asset('/public/assets/static-images/best-service-item4.webp')}}" alt="" />
                                                                                                <div class="bestSrvcItmText">
                                                                                                    <h4>INTERIOR DESIGN</h4>
                                                                                                    <p>We combine decades of design projecting experience with an unrelenting dedication to setting new benchmarks in the lighting marketplace.</p>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li>
                                                                                                <img class="bestSrvcItmImg" src="{{asset('/public/assets/static-images/best-service-item5.webp')}}" alt="" />
                                                                                                <div class="bestSrvcItmText">
                                                                                                    <h4>ARCHITECTURE</h4>
                                                                                                    <p>We offer dozens of custom options - from special finishes to hand-applied gilding to a choice of leg styles on some pieces, and even more choices.</p>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li>
                                                                                                <img class="bestSrvcItmImg" src="{{asset('/public/assets/static-images/best-service-item6.webp')}}" alt="" />
                                                                                                <div class="bestSrvcItmText">
                                                                                                    <h4>STYLE SELECTION</h4>
                                                                                                    <p>We understand that most homeowners don’t undertake major exterior replacements and redesign projects more than once, and that’s why our goal.</p>
                                                                                                </div>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                
                                                                            @elseif ($dataArr['content']->template == 'two')
                                                                            
                                                                                <div class="inrPageTwoSecondSecItemBox">
                                                                                    <img class="bestSrvcItmImg" src="{{asset('/public/assets/static-images/best-service-item1.webp')}}" alt="">
                                                                                    <h4 >INTERIOR PLANING</h4>
                                                                                    <p style="color: black">A relaxing bathroom helps you start and end your day in good spirits. It’s beneficial to have well designed storage to keep an open, clean feel.</p>
                                                                                </div>
                                                                                <div class="inrPageTwoSecondSecItemBox">
                                                                                    <img class="bestSrvcItmImg" src="{{asset('/public/assets/static-images/best-service-item2.webp')}}" alt="">
                                                                                    <h4>LANDSPACING</h4>
                                                                                    <p>A relaxing bathroom helps you start and end your day in good spirits. It’s beneficial to have well designed storage to keep an open, clean feel.</p>
                                                                                </div>
                                                                                <div class="inrPageTwoSecondSecItemBox">
                                                                                    <img class="bestSrvcItmImg" src="{{asset('/public/assets/static-images/best-service-item3.webp')}}" alt="">
                                                                                    <h4>DECORATION</h4>
                                                                                    <p style="color: black">A relaxing bathroom helps you start and end your day in good spirits. It’s beneficial to have well designed storage to keep an open, clean feel.</p>
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
                        
                        <button type="button"  style="float:left;border-radius: 12px;margin-top: 15px;background-color:cornflowerblue;"  class="btn btn-default btn-lg" onclick="window.location='{{ route('admin.content.step.three.update', $dataArr['content']->id) }}'">
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
                    var editor = CKEDITOR.replace('section_three{{ $pky }}', {
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
