@extends('layouts.main.admin-dashboard')

@section('content')
<style>
    .toggle-container {
        display: inline-block;
        width: 60px;
        height: 30px;
        background-color: #ccc;
        border-radius: 15px;
        position: relative;
    }

    /* Style for the toggle button */
    .toggle-button {
        width: 30px;
        height: 30px;
        background-color: #fff;
        border-radius: 50%;
        position: absolute;
        left: 0;
        transition: transform 0.3s;
    }

    /* Style for the checked (on) state of the toggle button */
    .toggle-container input:checked + .toggle-button {
        transform: translateX(30px);
        background-color: #f7992b; /* Change the background color to blue */
    }

    /* Hide the checkbox input */
    .toggle-container input {
        display: none;
    }
</style>
<div class="admin-body-area">


    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <!-- Booking Status Section Start -->
    <div class="booking-status-sec category-list-sec">
        <div class="category-list-hdn">
            <h2>slider Menu Management</h2>
            <h3 class="create-cat">
                <a href="{{ route('admin.slider.add') }}">Add new slide</a>
            </h3>
        </div>

        <div class="category-list-area">
            <!-- User List Area -->
            <div class="datatable">
                <div class="card-body">
                    <table class="table" id="bootstrap-data-table">
                        <thead>
                            <tr>
                                <th>Titel</th>
                                <th>Banner Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sliders as $slider)
                                <tr>
                                    <td title="slide Name">
                                        {{ $slider->heading }}
                                    </td>
                                    <td title="Banner Image">
                                        @if (Str::endsWith($slider->slider_file, ['.jpg', '.jpeg', '.png', '.gif', '.webp']))
                                            <img src="{{ asset('public/storage/' . $slider->slider_file) }}" alt="Banner Image" class="social-icon" style="width: 30px; height: 30px; border-radius: 50%;">
                                            @elseif (Str::endsWith($slider->slider_file, ['.mp4']))
                                            
                                            <video poster="{{ asset('storage/video_thumbnails/' . pathinfo($slider->slider_file, PATHINFO_FILENAME) . '.jpg') }}" controls preload="none" style="width: 30px; height: 30px;">
                                                <source src="{{ asset('storage/' . $slider->slider_file) }}" type="video/mp4">
                                               
                                            </video>

                                            
                                        @endif
                                    </td>
                                    
                                    
                                    <td>
                                        <label class="toggle-container">
                                            <input
                                                type="checkbox" class="slider-toggle" data-slider-id="{{ $slider->id }}" data-slider-status="{{ $slider->status ? '1' : '0' }}" {{ $slider->status ? 'checked' : '' }} >
                                            
                                            <span class="toggle-button"></span>
                                        </label>
                                    </td>
                                    <td title="Action">
                                        <a href="{{ route('admin.slider.edit', ['id' => $slider->id]) }}" title="Edit">
                                            <i class="fa fa-edit listing"></i>
                                        </a>
                                        <a href="{{ route('admin.slider.remove', $slider->id) }}" title="Delete" onclick="return confirm('If you delete this menu then page content will delete. Are you sure to delete?');">
                                            <i class="fa fa-trash chat"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Booking Status Section Start -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<script>
    $(document).ready(function () {
        
        $('.slider-toggle').on('change', function () {
            const sliderId = $(this).data('slider-id');
            const sliderStatus = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                type: 'POST',
                url: '{{ route('admin.slider.updateStatus') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    sliderId: sliderId,
                    sliderStatus: sliderStatus
                },
                success: function (response) {
                    alert('Slider status updated successfully');
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>

@stop
