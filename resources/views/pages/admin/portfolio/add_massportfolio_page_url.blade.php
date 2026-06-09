@extends('layouts.main.admin-dashboard')

@section('content')

<div class="admin-body-area">
    <form action="{{ route('admin.portfolio.content.step.one.mass.page.url.save', $dataArr['content']->id) }}" method="POST" id="content_form"
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
                        @include('includes.portfolio_nav_tabs')
                    </div>
    
                   
    
    
                    <div class="tab-content" style="overflow: hidden;width: 100%;">
                        <div id="step2" class="tab-pane active" role="tabpanel">
                            <h2 class="por-Photo">Mass Gallery Page Url</h2>
                            <div class="popup-form" style="width:100%" id="section1Holder">
                                <div class="card mt-2">
                                    <div class="form-field col-lg-12">
                                        <textarea id="section_one" class="form-control ck-editor" name="section_one" placeholder="meta_description">{{ $dataArr['page']->section_one ?? '' }}</textarea>
    
                                    </div>
                                </div>
                            </div>
                        </div>        
                   </div>
                                                   
                </div>
            </div>
            <div class="card-footer">
               
                <button type="submit" class="btn btn-success btn-lg" style="float:right;border-radius: 12px;margin-top: 15px;">Save & Next</button>
            </div>
        </div>
    </form>
    </div>




    @push('script')
    <script>
         $(document).ready(function() {
            CKEDITOR.replace('section_one', {
        filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form',
        allowedContent: true
    }).on('required', function(evt) {
        this.showNotification('This field is required.', 'warning');
        evt.cancel();
    });

    // Populate CKEditor with saved content
    var savedContent = {!! json_encode($dataArr['content']->section_one ?? '') !!};
    CKEDITOR.instances[element.id].setData(savedContent);
        });
            
      

       
    </script>
    @endpush

    @stop

     
   