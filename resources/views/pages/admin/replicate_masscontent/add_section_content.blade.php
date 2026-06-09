@extends('layouts.main.admin-dashboard')

@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <form action="{{ route('admin.replicatemasscontent.step.one.save', $dataArr['content']->id) }}" method="POST" id="content_form" enctype="multipart/form-data">
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
                                    <option {{ $dataArr['content']->template == "one" ? 'selected' : '' }} value="1">
                                        Template One</option>
                                    <option {{ $dataArr['content']->template == "two" ? 'selected' : '' }} value="2">
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
                                            @include('includes.replicate_nav_tab')

                                            <div class="tab-content" style="overflow: hidden;width: 100%;">
                                                <div id="step2" class="tab-pane active" role="tabpanel">
                                                    <h2 class="por-Photo">Please provide details of 2nd section(s) of all
                                                        your pages
                                                       
                                                        
                                                    </h2>
                                                        
                                                    <div class="popup-form" style="width:100%" id="section1Holder">
                                                        @forelse ($dataArr['content']->pages as $pky => $pgVal)
                                                            <div class="card mt-2">
                                                                <div class="card-header">
                                                                    <h4>Page No: {{ $pky + 1 }}</h4>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="form-field col-lg-12">
                                                                        <textarea id="section_one{{ $pky }}" name="section_one[{{ $pgVal['id'] }}]" placeholder="meta_description" class="form-control">
                                                                            @if(empty($pgVal['section_one']))
                                                                            @if ($dataArr['content']->template == 'one')
                                                                           
                                                                            
                                                                           

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
                        
                    <button type="button"  style="float:left;border-radius: 12px;margin-top: 15px;background-color:cornflowerblue;"  class="btn btn-default btn-lg" onclick="window.location='{{ route('admin.replicatemasscontent.edit', $dataArr['content']->id) }}'">
                        Back
                    </button>
                    <div class="button-group" style="float:right; margin-top: 15px;">
                        <button value="public" type="button" class="btn btn-success btn-lg me-2" 
                            style="border-radius: 12px;" id="publish-btn"> 
                            Save and Publish
                        </button>
                        <button value="private" type="button" class="btn btn-secondary btn-lg" 
                            style="border-radius: 12px;" id="draft-btn">
                            Save & Private
                        </button>
                    </div>
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
         // Handle button clicks for Save Draft and Save and Publish
         $('#publish-btn, #draft-btn').on('click', function() {
            // Create a hidden input to pass save_action
            let actionValue = $(this).val();
            $('<input>').attr({
                type: 'hidden',
                name: 'save_action',
                value: actionValue
            }).appendTo('#content_form');

            // Programmatically submit the form
            $('#content_form').submit();
        });
    </script>
@endpush
