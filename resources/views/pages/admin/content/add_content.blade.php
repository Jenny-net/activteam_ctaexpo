 @extends('layouts.main.admin-dashboard')

@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <form action="{{ route('admin.content.save') }}" method="POST" id="content_form" enctype="multipart/form-data">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        {{ csrf_field() }}

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                @error('template')
                                    <small class="text-danger"> Template is required.</small>
                                @enderror
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
                                @error('menu_id')
                                    <small class="text-danger"> Menu is required.</small>
                                @enderror
                                <label>Select Menu</label>
                                <select class="form-control" name="menu_id">
                                    <option value="">--Select As Root--</option>
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
                                            @include('includes.nav_tabs')

                                            <div class="tab-content" style="overflow: hidden; width: 100%;">
                                                <div id="step1" class="tab-pane active" role="tabpanel">
                                                    <h2 class="por-Photo">Please provide your page's info</h2>
                                                    <div class="popup-form" id="repeatDiv">
                                                        <div class="card mt-2">
                                                          
                                                            <div class="card-body">
                                                                

                                                                <div class="form-field form-field-col">
                                                                    <div class="form-field-grid2">
                                                                        <label>Page Name</label>
                                                                            @error('page_name.*')
                                                                            <small class="text-danger">Page Name field is required.</small>
                                                                            @enderror
                                                                    
                                                                            <input type="text" class="form-control url-chck" name="page_name[]" id="page_name" placeholder="Page Name" 
                                                                            value="{{ old('page_name.0') }}" >
                                                                           
                                                                    </div>
                                                                    
                                                                    <div class="form-field-grid2">
                                                                        <label>Page Url</label>
                                                                        @error('page_url.*')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                        <input type="text" class="form-control url-chck page-url-input" name="page_url[]" id="page_url_0"
                                                                            placeholder="Page Url" value="{{ old('page_url.0') }}" >
                                                                            
                                                                    </div>
                                                                    
                                                                </div>

                                                                <div class="form-field form-field-col">
                                                                    <div class="form-field-grid2">
                                                                        <label>Meta Title</label>
                                                                        @error('meta_title.*')
                                                                        <small class="text-danger">Meta Title field is required.</small>
                                                                        @enderror
                                                                        <input type="text" class="form-control url-chck" name="meta_title[]" placeholder="Meta Title" value="{{ old('meta_title.0') }}">
                                                                   
                                                                    </div>
                                                                    <div class="form-field-grid2">
                                                                    <label>Meta Robots</label>
                                                                        @error('meta_Robots.*')
                                                                        <small class="text-danger">The Meta Robots field is required.</small>
                                                                         @enderror
                                                                    <input type="text" class="form-control url-chck"
                                                                        name="meta_Robots[]" placeholder="Meta Robots"
                                                                        value="{{ old('meta_Robots.0') }}" >
                                                                    </div>
                                                                    <div class="form-field-grid2">
                                                                    <label>Meta Revisit After</label>
                                                                    @error('meta_revisit_after.*')
                                                                    <small class="text-danger"> Meta Revisit After field is required.</small>
                                                                     @enderror
                                                                    <input type="text" class="form-control url-chck"
                                                                         name="meta_revisit_after[]" placeholder="Meta Revisit After"
                                                                         value="{{ old('meta_revisit_after.0') }}" >
                                                                    </div>
                                                                    <div class="form-field-grid2">
                                                                        <label>Meta Canonical</label>
                                                                        @error('meta_canonical.*')
                                                                        <small class="text-danger"> Meta Canonical field is required.</small>
                                                                        @enderror
                                                                        <input type="text" class="form-control url-chck"
                                                                             name="meta_canonical[]" placeholder="Meta Canonical"
                                                                             value="{{ old('meta_canonical.0') }}" >
                                                                        </div>
                                                                </div>
                                                                <div class="form-field">
                                                                    <label>Meta Description</label>
                                                                        @error('meta_description.*')
                                                                        <small class="text-danger"> Meta Description field is required.</small>
                                                                        @enderror
                                                                    <textarea name="meta_description[]" placeholder="Meta Description" value="{{ old('meta_description.0') }}" class="form-control"></textarea>
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
                            onclick="window.location='{{ route('admin.content') }}'">Cancel</button>
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
                    ')" required>\
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













