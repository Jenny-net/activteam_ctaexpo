@extends('layouts.main.admin-dashboard')

@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <form action="{{ route('admin.massportfoliogallery.save') }}" method="POST" id="content_form" enctype="multipart/form-data">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        {{ csrf_field() }}

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Content Title</label>
                                <input type="text" class="form-control" name="content_title" id="content_title"
                                    placeholder="Content Title" required>
                            </div>
                        </div>

                       

                       

                        <div class="col-lg-12 col-md-12">
                            <div class="category-list-area">
                                <?php $dataArr['adsListingId'] = '0babb379-9256-4340-9f0f-12587e59b749'; ?>
                                <div class="upload-right-col" id="fullDiv">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @include('includes.mass_portfolio_gallery_tab')

                                            <div class="tab-content" style="overflow: hidden; width: 100%;">
                                                <div id="step1" class="tab-pane active" role="tabpanel">
                                                    <h2 class="por-Photo">Please provide your page's info</h2>
                                                    <div class="popup-form" id="repeatDiv">
                                                        <div class="card mt-2">
                                                            <div class="card-header">
                                                                <h4>Page No: 1</h4>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="form-field form-field-col">
                                                                    <div class="form-field-grid2">
                                                                    <label>Page Name</label>
                                                                    <input type="text" class="form-control url-chck"
                                                                        name="page_name[]" placeholder="Page Name"
                                                                        value="" />
                                                                    </div>
                                                                   


                                                                    <div class="form-field-grid2">
                                                                        <div class="form-group">
                                                                            <label>Page URL (Include Base URL)</label>
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend urlShowFormField">
                                                                                    <span class="input-group-text">{{ env('APP_URL') }}</span>
                                                                                </div>
                                                                                <input type="text" class="form-control url-chck urlFormField" name="page_url[]" placeholder="Page URL" required   onkeypress="if(event.key === ' ') { event.preventDefault(); this.value += '-'; } else if (event.key === '/') { return true; } else { return /[0-9a-zA-Z]/i.test(event.key); }">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-field form-field-col">
                                                                    <div class="form-field-grid2">
                                                                        <label>Meta Title</label>
                                                                    <input type="text" class="form-control url-chck"
                                                                        name="meta_title[]" placeholder="Meta Title"
                                                                        value="" required>
                                                                    </div>

                                                                    <div class="form-field-grid2">
                                                                        <label>Meta Robots</label>
                                                                    <input type="text" class="form-control url-chck"
                                                                        name="meta_Robots[]" placeholder="Meta Robots"
                                                                        value="" required>
                                                                    </div>
                                                                      
                                                                    <div class="form-field-grid2">
                                                                        <label>Meta Revisit After</label>
                                                                    <input type="text" class="form-control url-chck"
                                                                     name="meta_revisit_after[]" placeholder="Meta Revisit After"
                                                                     value="" required> 
                                                                    </div>
                                                                       
                                                                </div>
                                                                <div class="form-field">
                                                                    <label>Meta Description</label>
                                                                    <textarea name="meta_description[]" placeholder="Meta Description" required class="form-control"></textarea>
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
                            style="float: left; border-radius: 12px; margin-top: 15px; background-color: cornflowerblue;"
                            onclick="window.location='{{ route('admin.massportfoliogallery') }}'">Cancel</button>
                        <button type="submit" class="btn btn-success btn-lg"
                            style="float: right; border-radius: 12px; margin-top: 15px;">Save & Next</button>
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

        $('#repeatDiv').on('input', 'input[name^="page_url"]', function() {
            var inputValue = $(this).val();


            var pageUrlValue = inputValue.replace(/[^a-zA-Z0-9/-\s]/g, '');


            pageUrlValue = pageUrlValue.replace(/\s+/g, '-');

            $(this).val(pageUrlValue);
        });
    });
</script>



    <script>
        // Function to handle custom Page URL input
        function handleCustomPageUrl(inputField) {
            $(document).ready(function() {
        $('input[name^="page_url"]').on('input', function() {
            var inputValue = $(this).val();


            var pageUrlValue = inputValue.replace(/[^a-zA-Z0-9/-]/g, '-');


            pageUrlValue = pageUrlValue.replace(/-+/g, '-');


            $(this).val(pageUrlValue);
        });
    
    });
        }
    
        $("#pageNo").blur(function() {
            var value = $(this).val();
            if (value === '') {
                return false;
            }
            if ($(this).is('[readonly]')) {
                return false;
            }
            $("#pageNo").prop("readonly", true);
            jQuery("#noOfPage").val(value);
            var repeatDiv = jQuery("#repeatDiv");
            console.log(value);
            for (var i = 1; i < value; i++) {
                var con = '<div class="card mt-2">\
                    <div class="card-header">\
                        <h4>Page No: ' + (i + 1) + '</h4>\
                    </div>\
                    <div class="card-body">\
                        <div class="popup-form">\
                            <div class="form-field form-field-col">\
                                <div class="form-field-grid2">\
                                    <label>Page Name</label>\
                                    <input type="text" class="form-control url-chck" name="page_name[]" placeholder="Page Name"  >\
                                </div>\
                                <div class="form-field-grid2">\
                                 \ <div class="form-group">\
                                    <label>Page URL (Include Base URL)</label>\
                                         \  <div class="input-group">\
                                                  <div class="input-group-prepend urlShowFormField">\
                                                         \<span class="input-group-text">{{ env('APP_URL') }}</span>\
                                                              \</div>\
                                                              <input type="text" class="form-control url-chck urlFormField" name="page_url[]" placeholder="Page URL" required  >\
                                                                 </div>\
                                                                  </div>\
                                                            </div>\
                            </div>\
                            <div class="form-field form-field-col">\
                                <div class="form-field-grid2">\
                                    <label>Meta Title</label>\
                                    <input type="text" class="form-control url-chck" name="meta_title[]"  placeholder="Meta Title" required="">\
                                </div>\
                                <div class="form-field-grid2">\
                                    <label>Meta Robots</label>\
                                    <input type="text" class="form-control url-chck" name="meta_Robots[]"  placeholder="Meta Robots" required="">\
                                </div>\
                                <div class="form-field-grid2">\
                                    <label>Meta Revisit After</label>\
                                    <input type="text" class="form-control url-chck" name="meta_revisit_after[]"  placeholder="Meta Revisit After" required="">\
                                </div>\
                            </div>\
                            <label>Meta Description</label>\
                            <div class="form-field">\
                                <textarea id="my-editor' + i + '"  name="meta_description[]"  placeholder="Meta Description" required="" class="form-control"></textarea>\
                            </div>\
                        </div>\
                    </div>\
                </div>';
                repeatDiv.append(con);
            }
        });
    </script>
    
    



    <script>
        $(document).ready(function() {
        $('input[name^="page_url"]').on('input', function() {
            var inputValue = $(this).val();


            var pageUrlValue = inputValue.replace(/[^a-zA-Z0-9/-]/g, '-');


            pageUrlValue = pageUrlValue.replace(/-+/g, '-');


            $(this).val(pageUrlValue);
        });
    });
    </script>
    
@endpush
