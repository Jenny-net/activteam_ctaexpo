@extends('layouts.main.admin-dashboard')

@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec category-list-sec">
            <div class="category-list-hdn">
                <h2>Content Management</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.massportfoliogallery.add') }}">Add new Mass gallery</a>
                </h3>
            </div>

            <div class="category-list-area">

                <!-- User List Area -->
                <div class="datatable">
                    <div class="card-body">
                        <table class="table" id="bootstrap-data-table">

                            <thead>
                                <tr>
                                    <th>MassGallery Title</th>
                                   
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($dataArr['data'] as $massgallery)
                                <tr>
                                    <td title="Content Title">
                                        {{ $massgallery->content_title }}
                                    </td>
                                    <td title="Template">
                                        {{ $massgallery->template }}
                                    </td>
                                    
                                    <td title="Action">
                                         <a href="{{ route('admin.massportfoliogallery.edit', ['id' => $massgallery->id]) }}" title="Edit">
                                            <i class="fa fa-edit listing"></i>
                                        </a>  
                                      <a href="{{ route('admin.massportfoliogallery.content.remove', ['id' => $massgallery->id]) }}" title="Delete"
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
@stop
