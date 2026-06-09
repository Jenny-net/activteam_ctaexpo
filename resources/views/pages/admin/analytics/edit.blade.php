@extends('layouts.main.admin-dashboard')
@section('content')
<div class="admin-body-area">
    
    <!-- Booking Status Section Start -->
    <form action="{{ route('admin.analytics.update', ['id' => $analytics->id]) }}" method="POST"  enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="category-list-area">
                
                            <div class="upload-right-col" id="fullDiv">
                                <div class="row">
                                    <div class="col-lg-12">
                                        

                                        <div class="tab-content" style="overflow: hidden; width: 100%;">
                                            <div id="step1" class="tab-pane active" role="tabpanel">
                                        
                                                <div class="popup-form" id="repeatDiv">
                                                    <div class="card mt-2">
                                                        <div class="form-field">
                                                            <label for="tracking_code">Google Analytics Tracking Code:</label>
                                                            <textarea name="tracking_code" id="tracking_code" required class="form-control">{{ $analytics->tracking_code }}</textarea>
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
                        style="float: right; border-radius: 12px; margin-top: 15px;">Save </button>
                </div>
            </div>
        </div>
    </form>

</div>

<!-- Booking Status Section Start -->
@stop