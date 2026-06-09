@extends('layouts.main.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec category-list-sec">
            <div class="category-list-hdn">
                <h2>Content Management</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.content.add') }}">Add new content</a>
                </h3>
            </div>

            <div class="category-list-area">

                <!-- User List Area -->
                <div class="datatable">
                    <div class="card-body">
                        <table class="table" id="bootstrap-data-table">

                            <thead>
                                <tr>
                                    <th>Content Title</th>
                                    <th>Menu Name</th>
                                    <th>Template</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($dataArr['contentArr'] as $content)
                                    <tr>
                                        <td title="Content Title">
                                            {{ @$content->content_title }}
                                        </td>
                                        <td title="Menu Name">
                                            {{ @$content->menu->parentMenu->menu_name ? $content->menu->parentMenu->menu_name . ' >> ' : '' }}
                                            {{ @$content->menu->menu_name }}
                                        </td>
                                        <td title="Template">
                                            Template {{ ucwords($content->template) }}
                                        </td>
                                        <td title="Action">
                                            <a href="{{ route('admin.content.edit', $content->id) }}" title="Edit">
                                                <i class="fa fa-edit listing"></i>
                                            </a>
                                            <a href="{{ route('admin.content.remove', $content->id) }}" title="Delete"
                                                onclick="return confirm('Are you sure to delete?');">
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
