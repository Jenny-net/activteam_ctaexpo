@extends('layouts.main.admin-dashboard')

@section('content')
<div class="admin-body-area">
    <!-- Edit Settings Section Start -->
    <div class="booking-status-sec category-list-sec">
        <div class="category-list-hdn">
            <h2>Edit Settings</h2>
            <h3 class="create-cat">
                <a href="{{ route('admin.setting') }}">Back</a>
            </h3>
        </div>

        <div class="category-list-area">
            <form action="{{ route('admin.setting.update', ['id' => $dataArr['settingArr']->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                


                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label>Logo</label>
                        <input type="file" name="icon" class="form-control-file" accept="image/*" onchange="previewImage('icon', 'iconPreview', this);">
                        <img id="iconPreview" src="{{ asset('public/storage/' . $dataArr['settingArr']->icon) }}" alt="Current Icon" class="img-preview">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label>Fav Icon</label>
                        <input type="file" name="fav_icon" class="form-control-file" accept="image/*" onchange="previewImage('favIcon', 'favIconPreview', this);">
                        <img id="favIconPreview" src="{{ asset('public/storage/' . $dataArr['settingArr']->fav_icon) }}" alt="Current Fav Icon" class="img-preview">
                    </div>
                </div>

                

                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label>Contact us text </label>
                        <input type="text" name="contact_us_heading" class="form-control" value="{{$dataArr['settingArr']->contact_us_heading}}" required>
                    </div>
                </div>
                
                <div class="row">

                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>Country Name one Label</label>
                            <input type="text" name="country_name_one_label" class="form-control" value="{{$dataArr['settingArr']-> country_name_one_label}}" >
                        </div>
                    </div> 
                   
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>Phone Number one</label>
                            <input type="text" name="phone_number_one" class="form-control" value="{{$dataArr['settingArr']-> phone_number_one}}" >
                        </div>
                    </div> 

                     <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>Country Name Two Label</label>
                            <input type="text" name="country_name_two_label" class="form-control" value="{{$dataArr['settingArr']-> country_name_two_label}}" >
                        </div>
                    </div> 
                   
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>Phone Two Number</label>
                            <input type="text" name="phone_number_two" class="form-control" value="{{$dataArr['settingArr']-> phone_number_two}}" >
                        </div>
                    </div> 
                     <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>Country Name Three Label</label>
                            <input type="text" name="country_name_three_label" class="form-control" value="{{$dataArr['settingArr']-> country_name_three_label}}" >
                        </div>
                    </div> 
                   
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>Phone Number Three</label>
                            <input type="text" name="phone_number_three" class="form-control" value="{{$dataArr['settingArr']-> phone_number_three}}" >
                        </div>
                    </div> 
                   
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>Email label</label>
                            <input type="text" name="email_label" class="form-control" value="{{$dataArr['settingArr']->email_label}}" >
                        </div>
                    </div> 
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label> Email Address</label>
                            <input type="email" name="email_address" class="form-control" value="{{$dataArr['settingArr']->email_address}}">
                        </div>
                    </div>

                    {{-- <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label> Email Url</label>
                            <input type="text" name="email_link" class="form-control" value="{{$dataArr['settingArr']->email_link}}" >
                        </div>
                    </div> --}}

                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label> Whatsapp Url</label>
                            <input type="text" name="whatsapp_url" class="form-control" value="{{$dataArr['settingArr']->whatsapp_url}}" >
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label> Teams Url</label>
                            <input type="text" name="teams_url" class="form-control" value="{{$dataArr['settingArr']->teams_url}}" >
                        </div>
                    </div>
                   

                   

                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="contact_our_project" class="form-control" value="{{$dataArr['settingArr']->contact_our_project}}" >
                        </div>
                    </div> 
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>Footer Copy Rights </label>
                            <input type="text" name="copy_right" class="form-control" value="{{$dataArr['settingArr']->copy_right}}" required>
                        </div>
                    </div>


                    <div class="tab-content" style="overflow: hidden;width: 100%;">
                        <div id="step2" class="tab-pane active" role="tabpanel">
                            <h2 class="por-Photo">To prepare an exhibition stand design request, please send us</h2>
                            <div class="popup-form" style="width:100%" id="section1Holder">
                                <div class="card mt-2">
                                    <div class="card-body">
                                        <div class="form-field col-lg-12">
                                            <textarea id="contact_notes_area" class="form-control ck-editor" name="contact_notes_area" placeholder="contact notes area">{{$dataArr['settingArr']->contact_notes_area}}</textarea>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <button class="submit-btn subbtn" type="submit">Submit</button>
            </form>
        </div>
    </div>
    <!-- Edit Settings Section End -->
</div>
@stop

@push('script')
<script>
   function previewImage(inputId, previewId, input) {
    var preview = document.getElementById(previewId);
    var file = input.files[0];
    var reader = new FileReader();

    reader.onload = function (e) {
        preview.src = e.target.result;
    };

    if (file) {
        reader.readAsDataURL(file);
    } else {
        // Make sure to use the correct previewId here
        preview.src = "{{ asset('public/storage/') }}" + '/' + inputId.split(' ')[0] + '/' + inputId.split(' ')[1];
    }
}

</script>

<script>
    $(document).ready(function() {
         
            CKEDITOR.replace('contact_notes_area', {
                filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form',
                allowedContent: true
            }).on('required', function(evt) {
                this.showNotification('This field is required.', 'warning');
                evt.cancel();
            });

            var savedContent = {!! json_encode($dataArr['settingArr']->contact_notes_area ?? '') !!};
            CKEDITOR.instances[element.id].setData(savedContent);
     
     
    });
</script>


@endpush
