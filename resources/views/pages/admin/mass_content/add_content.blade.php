@extends('layouts.main.admin-dashboard')

@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <form action="{{ route('admin.masscontent.save') }}" method="POST" id="content_form" enctype="multipart/form-data">
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
                       <input type="hidden" name="content_type" value="mass">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Select Template</label>
                                <select class="form-control" name="template" required>
                                    <option value="">Select Template</option>
                                    <option value="one">Template One</option>
                                    <option value="two">Template Two</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>No of pages</label>
                                <input type="number" name="no_of_pages" value="{{ old('no_of_pages', '1') }}" class="form-control" min="1" id="pageNo" required>
                            </div>
                            
                            {{-- <div class="form-group">
                                <label>No of pages</label>
                                <input type="number" name="no_of_pages" value="1" class="form-control" min="1"
                                    id="pageNo" required>
                            </div> --}}
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="category-list-area">
                                <?php $dataArr['adsListingId'] = '0babb379-9256-4340-9f0f-12587e59b749'; ?>
                                <div class="upload-right-col" id="fullDiv">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @include('includes.mass_nav_tabs')

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
                                                                    {{-- <div class="form-field-grid2">
                                                                        <label>Page Url</label>
                                                                        <input type="text" class="form-control url-chck"
                                                                            name="page_url[]" id="page_url_0"
                                                                            placeholder="Page Url" value="" required
                                                                            readonly="">
                                                                    </div> --}}


                                                                    <div class="form-field-grid2">
                                                                        <div class="form-group">
                                                                            <label>Page URL (Include Base URL)</label>
                                                                            
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend urlShowFormField">
                                                                                    <span class="input-group-text">{{ env('APP_URL') }}</span>
                                                                                </div>
                                                                                <input type="text" class="form-control url-chck urlFormField" name="page_url[]" placeholder="Page URL"   onkeypress="if(event.key === ' ') { event.preventDefault(); this.value += '-'; } else if (event.key === '/') { return true; } else { return /[0-9a-zA-Z]/i.test(event.key); }">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-field form-field-col">
                                                                    <div class="form-field-grid2">
                                                                    <label>Meta Title</label>
                                                                    
                                                                    <input type="text" class="form-control url-chck"
                                                                        name="meta_title[]" placeholder="Meta Title"
                                                                        value="" >
                                                                    </div>

                                                                    <div class="form-field-grid2">
                                                                    <label>Meta Robots</label>
                                                                    
                                                                    <input type="text" class="form-control url-chck"
                                                                        name="meta_Robots[]" placeholder="Meta Robots"
                                                                        value="" >
                                                                    </div>
                                                                      
                                                                    <div class="form-field-grid2">
                                                                        <label>Meta Revisit After</label>
                                                                        
                                                                    <input type="text" class="form-control url-chck"
                                                                     name="meta_revisit_after[]" placeholder="Meta Revisit After"
                                                                     value="" > 
                                                                    </div>
                                                                    <div class="form-field-grid2">
                                                                        <label>Meta Canonical</label>
                                                                        
                                                                    <input type="text" class="form-control url-chck"
                                                                     name="meta_canonical[]" placeholder="Meta Canonical"
                                                                     value="" > 
                                                                    </div>
                                                                       
                                                                </div>
                                                                <div class="form-field">
                                                                    <label>Meta Description</label>
                                                                    
                                                                    <textarea name="meta_description[]" placeholder="Meta Description"  class="form-control"></textarea>
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
                            onclick="window.location='{{ route('admin.masscontent') }}'">Cancel</button>
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
                                                              <input type="text" class="form-control url-chck urlFormField" name="page_url[]" placeholder="Page URL"   >\
                                                                 </div>\
                                                                  </div>\
                                                            </div>\
                            </div>\
                            <div class="form-field form-field-col">\
                                <div class="form-field-grid2">\
                                    <label>Meta Title</label>\
                                    <input type="text" class="form-control url-chck" name="meta_title[]"  placeholder="Meta Title" ="">\
                                </div>\
                                <div class="form-field-grid2">\
                                    <label>Meta Robots</label>\
                                    <input type="text" class="form-control url-chck" name="meta_Robots[]"  placeholder="Meta Robots" ="">\
                                </div>\
                                <div class="form-field-grid2">\
                                    <label>Meta Revisit After</label>\
                                    <input type="text" class="form-control url-chck" name="meta_revisit_after[]"  placeholder="Meta Revisit After" ="">\
                                </div>\
                                <div class="form-field-grid2">\
                                    <label>Meta Canonical</label>\
                                    <input type="text" class="form-control url-chck" name="meta_canonical[]"  placeholder="Meta canonical" ="">\
                                </div>\
                            </div>\
                            <label>Meta Description</label>\
                            <div class="form-field">\
                                <textarea id="my-editor' + i + '"  name="meta_description[]"  placeholder="Meta Description" ="" class="form-control"></textarea>\
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









    $(document).ready(function() {
    // Function to handle custom Page URL input
    $('input[name^="page_url"]').on('input', function() {
        var inputValue = $(this).val();
        var pageUrlValue = inputValue.replace(/[^a-zA-Z0-9/-]/g, '-');
        pageUrlValue = pageUrlValue.replace(/-+/g, '-');
        $(this).val(pageUrlValue);
    });

    // Function to validate all fields before form submission
    $('#content_form').submit(function(event) {
        // Prevent the default form submission behavior
        event.preventDefault();

        var isValid = true;

        // Validate each field
        $('.card-body').each(function() {
            var cardBody = $(this);
            var pageName = cardBody.find('input[name^="page_name"]');
            var pageUrl = cardBody.find('input[name^="page_url"]');
            var metaTitle = cardBody.find('input[name^="meta_title"]');
            var metaRobots = cardBody.find('input[name^="meta_Robots"]');
            var metaRevisitAfter = cardBody.find('input[name^="meta_revisit_after"]');
            var metaCanonical = cardBody.find('input[name^="meta_canonical"]');
            var metaDescription = cardBody.find('textarea[name^="meta_description"]');

            // Check if any field is empty
            if (pageName.val() === '') {
                displayErrorMessage(pageName, 'Page Name is required.');
                isValid = false;
            } else {
                removeErrorMessage(pageName);
            }

            if (pageUrl.val() === '') {
                displayErrorMessage(pageUrl, 'Page URL is required.');
                isValid = false;
            } else {
                removeErrorMessage(pageUrl);
            }

            if (metaTitle.val() === '') {
                displayErrorMessage(metaTitle, 'Meta Title is required.');
                isValid = false;
            } else {
                removeErrorMessage(metaTitle);
            }

            if (metaRobots.val() === '') {
                displayErrorMessage(metaRobots, 'Meta Robots is required.');
                isValid = false;
            } else {
                removeErrorMessage(metaRobots);
            }

            if (metaRevisitAfter.val() === '') {
                displayErrorMessage(metaRevisitAfter, 'Meta Revisit After is required.');
                isValid = false;
            } else {
                removeErrorMessage(metaRevisitAfter);
            }

            if (metaCanonical.val() === '') {
                displayErrorMessage(metaCanonical, 'Meta Canonical is required.');
                isValid = false;
            } else {
                removeErrorMessage(metaCanonical);
            }

            if (metaDescription.val() === '') {
                displayErrorMessage(metaDescription, 'Meta Description is required.');
                isValid = false;
            } else {
                removeErrorMessage(metaDescription);
            }
        });

        // If all fields are valid, submit the form
        if (isValid) {
            this.submit();
        }
    });

    // Function to display error message below the field
    function displayErrorMessage(field, message) {
        // Check if error message already exists
        if (!field.parent().find('.text-danger').length) {
            field.parent().append('<small class="text-danger">' + message + '</small>');
        }
    }

    // Function to remove error message if field is filled
    function removeErrorMessage(field) {
        field.parent().find('.text-danger').remove();
    }
});

// ==================

    </script>
    
    
@endpush
