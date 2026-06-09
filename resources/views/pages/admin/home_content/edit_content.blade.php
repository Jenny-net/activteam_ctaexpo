@extends('layouts.main.admin-dashboard')

@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <form action="{{ route('admin.home.content.update', ['id' => $dataArr['page']->id]) }}" method="POST" id="content_form" enctype="multipart/form-data">

            <input type="hidden" name="page_id" value="{{ $dataArr['page']->id }}">
      
           
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        {{ csrf_field() }}

                        <div class="col-lg-12 col-md-12">
                            <div class="category-list-area">
                                <div class="upload-right-col" id="fullDiv">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @include('includes.index_nav_tabs') 

                                            <div class="tab-content" style="overflow: hidden;width: 100%;">
                                                <div id="step1" class="tab-pane active" role="tabpanel">
                                                    <h2 class="por-Photo">Please provide Detail(s) of all
                                                        your pages</h2>
                                                    <div class="popup-form" style="width:100%" id="section1Holder">
                                                        
                                                        <div class="card mt-2">
                                                            <div class="card-body">
                                                                <div class="form-field form-field-col">
                                                                    <div class="form-field-grid2">
                                                                        <label>Page Name</label>
                                                                        <input type="text" class="form-control url-chck"
                                                                            name="page_name"
                                                                            placeholder="Page Name"
                                                                            value="{{ $dataArr['page']->page_name }}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-field form-field-col">
                                                                    <div class="form-field-grid2">
                                                                        <label>Meta Title</label>
                                                                        <input type="text" class="form-control url-chck"
                                                                            name="meta_title"
                                                                            placeholder="Meta Title"
                                                                            value="{{ $dataArr['page']->meta_title }}" required>
                                                                    </div>
                                                                    <div class="form-field-grid2">
                                                                        <label>Meta Robots</label>
                                                                        <input type="text"
                                                                            class="form-control url-chck"
                                                                            name="meta_Robots"
                                                                            placeholder="Meta Robots"
                                                                            value="{{ $dataArr['page']->meta_Robots }}"
                                                                            required>
                                                                    </div>
                                                                    <div class="form-field-grid2">
                                                                        <label>Meta Revisit After</label>
                                                                        <input type="text" class="form-control url-chck"
                                                                            name="meta_revisit_after"
                                                                            placeholder="Meta Revisit After"
                                                                            value="{{ $dataArr['page']->meta_revisit_after }}" required>
                                                                    </div>
                                                                    <div class="form-field-grid2">
                                                                        <label>Meta Canonica</label>
                                                                        <input type="text" class="form-control url-chck"
                                                                            name="meta_canonical"
                                                                            placeholder="Meta Canonical"
                                                                            value="{{ $dataArr['page']->meta_canonical }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-field">
                                                                    <label>Meta Description</label>
                                                                    <textarea name="meta_description" placeholder="Meta Description" required class="form-control">{{ $dataArr['page']->meta_description }}</textarea>
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
                </div>
                <div class="card-footer">
                    <button type="button" class="buttonOne btn btn-default btn-lg"
                        style="float:left;border-radius: 12px;margin-top: 15px;background-color:cornflowerblue;" onclick="window.location='{{ route('admin.home.content') }}'">Cancel</button>
                    <button type="submit" class="btn btn-success btn-lg"
                        style="float:right;border-radius: 12px;margin-top: 15px;">Save & Next</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Booking Status Section Start -->
@stop

@push('script')

@endpush
