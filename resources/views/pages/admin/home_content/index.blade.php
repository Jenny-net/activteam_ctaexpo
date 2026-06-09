
@extends('layouts.main.admin-dashboard')
@section('content')
<div class="admin-body-area">
    <!-- Booking Status Section Start -->
    <div class="booking-status-sec category-list-sec">
        <div class="category-list-hdn">
            <h2>Home Content Management</h2>
            {{-- <h3 class="create-cat">
                <a href="{{route('admin.analytics.add')}}">Add Analytics</a>
            </h3> --}}
        </div>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
        <div class="category-list-area">

            <!-- User List Area -->
            <div class="datatable">
                <div class="card-body">
                    <table class="table" id="bootstrap-data-table">
                        <thead>
                            <tr>
                                <th>Content</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataArr['data'] as $page)
                                <tr>
                                    <td title="Content Title">
                                        <!-- Display content here, for example: -->
                                        {{ $page->page_name }}
                                    </td>
                                    <td title="Action">
                                        <a href="{{ route('admin.home.content.edit', ['id' => $page->id]) }}" title="Edit">
                                            <i class="fa fa-edit listing"></i>
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