@extends('layouts.main.admin-dashboard')

@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <form action="{{ route('admin.Portfolio.save') }}" method="POST" id="content_form" enctype="multipart/form-data">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        {{ csrf_field() }}

                        
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Select Menu</label>
                                <select class="form-control" name="menu_id">
                                    @foreach ($dataArr['parentMenuArr'] as $category)
                                        <option value="{{ $category->id }}">{{ $category->menu_name }}</option>
                                        @foreach ($category->subMenu as $sub)
                                            <option value="{{ $sub->id }}">-{{ $sub->menu_name }}</option>
                                            @foreach ($sub->subMenu as $subsub)
                                                <option value="{{ $subsub->id }}">--{{ $subsub->menu_name }}</option>
                                                @foreach ($subsub->subMenu as $sub3)
                                                    <option value="{{ $sub3->id }}">---{{ $sub3->menu_name }}</option>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                      
                        <div class="col-lg-12 col-md-12">
                            <div class="category-list-area">
                                <?php $dataArr['adsListingId'] = '0babb379-9256-4340-9f0f-12587e59b749'; ?>
                                <div class="upload-right-col" id="fullDiv">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @include('includes.portfolio_nav_tabs')

                                            <div class="tab-content" style="overflow: hidden; width: 100%;">
                                                <div id="step1" class="tab-pane active" role="tabpanel">
                                                    <h2 class="por-Photo">Please provide your page's info1111</h2>
                                                    <div class="popup-form" id="repeatDiv">
                                                        <div class="card mt-2">
                                                          
                                                            <div class="card-body">
                                                                

                                                                <div class="form-field form-field-col">
                                                                    <div class="form-field-grid2">
                                                                        <label>Page Name</label>
                                                                       


                                                                            <input type="text" class="form-control url-chck" name="page_name[]" placeholder="Page Name" 
                                                                            value="" >
                                                                    </div>
                                                                    
                                                                    <div class="form-field-grid2">
                                                                        <label>Page Url</label>
                                                                        <input type="text" class="form-control url-chck page-url-input" name="page_url[]" id="page_url_0"
                                                                            placeholder="Page Url" value="" required>
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
        $("#pageNo").blur(function() {
            var value = $(this).val();
            if (value === '') {
                return false;
            }
            $("#pageNo").prop("readonly", true);
            jQuery("#noOfPage").val(value);
            var repeatDiv = jQuery("#repeatDiv");
            //jQuery("#fullDiv").empty();
            console.log(value);
            for (var i = 1; i < value; i++) {

                var con = '<div class="card mt-2">\
                                        <div class="card-header">\
                                            <h4>Page No: ' + (i + 1) +
                    '</h4>\
                                            </div><div class="card-body">\
                                                <div class="popup-form">\
                                                    <div class="form-field form-field-col">\
                                                        <input type="text" class="form-control url-chck" name="page_name[]" placeholder="Page Name" onblur="createSlug(this, ' +
                    (i + 1) +
                    ')" >\
                                                        <input type="text" class="form-control url-chck" name="page_url[]"  placeholder="Page Url" id="page_url_' +
                    (i + 1) + '" required="" readonly="">\
                                                        </div>\
                                                        <div class="form-field form-field-col">\
                                                            <input type="text" class="form-control url-chck" name="meta_revisit_after[]"  placeholder="Meta Revisit After" required="">\
                                                            <input type="text" class="form-control url-chck" name="meta_title[]"  placeholder="Meta Title" required="">\
                                                            <input type="text" class="form-control url-chck" name="meta_Robots[]"  placeholder="Mata Robots" required="">\
                                                            </div>\
                                                            <div class="form-field">\
                                                    <textarea id="my-editor' + i + '"  name="meta_description[]"  placeholder="Meta Description" required="" class="form-control"></textarea>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>';

                repeatDiv.append(con);
            }
        });
 



document.querySelectorAll('.page-url-input').forEach(function(input) {
    input.addEventListener('input', function() {
        replaceSpacesAndSpecialChars(this);
    });
});


function replaceSpacesAndSpecialChars(input) {
    let pageUrlValue = input.value;

    // Replace spaces with hyphens
    pageUrlValue = pageUrlValue.replace(/\s+/g, '-');

    // Remove consecutive hyphens
    pageUrlValue = pageUrlValue.replace(/-+/g, '-');

    // Remove special characters using a regular expression (except '/')
    pageUrlValue = pageUrlValue.replace(/[^a-zA-Z0-9/-]/g, '');

    // Set the Page URL field with the modified value
    input.value = pageUrlValue;
}




    </script>
@endpush 













