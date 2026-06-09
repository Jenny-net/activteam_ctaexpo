@extends('layouts.main.admin-dashboard')

@section('content')
<div class="admin-body-area">
    <!-- Booking Status Section Start -->
    <div class="booking-status-sec category-list-sec">
        <div class="category-list-hdn">
            <h2>Social Menu Management</h2>
            <h3 class="create-cat">
                <a href="{{ route('admin.social.add') }}">Add new social media</a>
            </h3>
        </div>

        <div class="category-list-area">
            <!-- User List Area -->
            <div class="datatable">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Social icon</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataArr['socialArr'] as $social)
                                <tr>
                                    <td title="Social Icon">
                                        <img src="{{ asset('public/storage/' . $social->social_icon) }}" alt="Social Icon" class="social-icon" style="width: 30px; height: 30px; border-radius: 50%;">
                                    </td>
                                    <td title="Action">
                                        <a href="{{ route('admin.social.edit', $social->id) }}" title="Edit">
                                            <i class="fa fa-edit listing"></i>
                                        </a>
                                        <a href="{{ route('admin.social.remove', $social->id) }}" title="Delete" onclick="return confirm('If you delete this menu then page content will delete. Are you sure to delete?');">
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
@stop
