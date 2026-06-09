@extends('layouts.main.admin-dashboard')

@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec category-list-sec">
            <div class="category-list-hdn">
                <h2>Content Management</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.masscontent.add') }}">Add new content</a>
                </h3>
            </div>

            <div class="category-list-area">

                <!-- User List Area -->
                <div class="datatable">
                    <div class="card-body">
                        <table class="table" id="bootstrap-data-table">

                            <thead>
                                <tr>
                                    <th>MassContent Title</th>
                                    <th>Template</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($dataArr['data'] as $masscontent)
                                    <tr>
                                        <td title="Content Title">
                                            {{ $masscontent->content_title }}
                                        </td>
                                        <td title="Template">
                                            {{ $masscontent->template }}
                                        </td>
                                        
                                        <td title="Action">
                                             <a href="{{ route('admin.masscontent.edit', ['id' => $masscontent->id]) }}" title="Edit">
                                                <i class="fa fa-edit listing"></i>
                                            </a>  
                                            <a href="{{ route('admin.masscontent.remove', ['id' => $masscontent->id]) }}" title="Delete"
                                                onclick="return confirm('Are you sure that you want to delete content and under this content  {{ $masscontent->pages->count() }}  page?');">
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
