@extends('layouts.main.admin-dashboard')

@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <form action="{{ route('admin.portfolio.content.step.two.save', $dataArr['content']->id) }}" method="POST" id="content_form"
            enctype="multipart/form-data">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        {{ csrf_field() }}

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
                                            <div class="col-lg-12 col-md-12">
                                                @include('includes.portfolio_nav_tabs')
                                            </div>

                                            <div class="tab-content" style="overflow: hidden;width: 100%;">
                                                <div id="step2" class="tab-pane active" role="tabpanel">
                                                    <h2 class="por-Photo">Exhibition Stand Build Program. Which One is The Right for You?</h2>
                                                    <div class="popup-form" style="width:100%" id="section1Holder">
                                                        <div class="card mt-2">
                                                            <div class="card-body">
                                                                <div class="form-field col-lg-12">
                                                                    <textarea id="section_two" class="form-control ck-editor" name="section_two" placeholder="meta_description">{{ $dataArr['page']->section_two ?? '' }}</textarea>

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
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    {{-- <button type="button" style="float:left;border-radius: 12px;margin-top: 15px;background-color:cornflowerblue;" class="btn btn-default btn-lg" onclick="window.location='{{ route('admin.homecontent.step.two.update', $dataArr['content']->id) }}'">
                        Back
                    </button>   --}}
                    <button type="submit" class="btn btn-success btn-lg" style="float:right;border-radius: 12px;margin-top: 15px;">Save & Next</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Booking Status Section Start -->
@stop

@push('script')
<script>
    $(document).ready(function() {
         
            CKEDITOR.replace('section_two', {
                filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form',
                allowedContent: true
            }).on('required', function(evt) {
                this.showNotification('This field is required.', 'warning');
                evt.cancel();
            });

            // Populate CKEditor with saved content
            var savedContent = {!! json_encode($dataArr['content']->section_two ?? '') !!};
            CKEDITOR.instances[element.id].setData(savedContent);
     
    });
</script>
@endpush
