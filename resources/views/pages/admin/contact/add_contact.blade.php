@extends('layouts.main.admin-dashboard')

@section('content')
<div class="admin-body-area">
    <!-- Booking Status Section Start -->
    <div class="booking-status-sec category-list-sec">
        <div class="category-list-hdn">
            <h2>Add new Contact details</h2>
            
        </div>

        <div class="category-list-area">
            <form action="{{ route ('admin.Contacts.save') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group" id="page_url_field">
                                <label> COUNTRY NAME</label>
                                <input type="text" name="contact_country_name" class="form-control" id="country name" style="width: 900px; height: 50px;">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group" id="page_url_field">
                                <label>ADDRESS</label>
                                <input type="text" name="contact_address" class="form-control" id="contact address" style="width: 900px; height: 50px;">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group" id="page_url_field">
                                <label>TEL LABEL</label>
                                <input type="text" name="contact_tel_label" class="form-control" id="contact tel label" style="width: 900px; height: 50px;">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group" id="page_url_field">
                                <label>TEL NUMBER</label>
                                <input type="text" name="contact_tel_number" class="form-control" id="contact number" style="width: 900px; height: 50px;">
                            </div>
                        </div>


                        <div class="col-lg-6 col-md-6">
                            <div class="form-group" id="page_url_field">
                                <label>EMAIL LABEL</label>
                                <input type="text" name="contact_email_label" class="form-control" id="contact mail label" style="width: 900px; height: 50px;">
                            </div>
                        </div>
                        
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group" id="page_url_field">
                                <label>EMAIL ADDRESS</label>
                                <input type="email" name="contact_email_address" class="form-control" id="contact email address" style="width: 900px; height: 50px;">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group" id="page_url_field">
                                <label>EMAIL URL</label>
                                <input type="text" name="contact_email_url" class="form-control" id="contact email url" style="width: 900px; height: 50px;">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group" id="page_url_field">
                                <label>SITE NAME</label>
                                <input type="text" name="contact_site_name" class="form-control" id="contact site name" style="width: 900px; height: 50px;">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group" id="page_url_field">
                                <label>SITE URL</label>
                                <input type="text" name="contact_site_url" class="form-control" id="site url" style="width: 900px; height: 50px;">
                            </div>
                        </div>

                       
                    </div>
                </div>

                <br/>

                <button class="submit-btn subbtn" type="submit">Submit</button>
                <button class="create-cat" type="button" style="margin-left: 10px;"><a href="{{route('admin.Contacts')}}">Back</a></button>
            </form>
        </div>
    </div>
</div>
<!-- Booking Status Section Start -->
@stop

@push('script')

@endpush
