@extends('layouts.main.admin-dashboard')

@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec category-list-sec">
            <div class="category-list-hdn">
                <h2>Mass Content Management</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.replicatemasscontent.add') }}">Add new Replicate Mass content</a>
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
                                    <th>Date</th>
                                    <th>Number of Content</th>
                                    <th>Status</th>
                                    <th>Visibility</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($dataArr['data'] as $item)
                                    <tr>
                                        <td>{{ $item->content_title }}</td>

                                        <td>{{ $item->template }}</td>

                                        <td>{{ $item->created_at->format('d M Y, h:i A') }}</td>

                                        <td>{{ $item->pages->count() }}</td>

                                        <!-- Content Status -->
                                        <td>
                                            @if ((int) $item->is_completed === 0)
                                                <span class="badge badge-warning">In Progress</span>
                                            @elseif ((int) $item->is_completed === 1)
                                                <span class="badge badge-success">Complete</span>
                                            @endif

                                        </td>

                                        <!-- Visibility -->
                                        <td>
                                            @if ($item->is_completed == 1)
                                                <!-- Toggle Visibility Form -->
                                                <form
                                                    action="{{ route('admin.replicatemasscontent.content.visibility', $item->id) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf

                                                    <label class="switch">
                                                        <input type="checkbox" name="content_visibility_status"
                                                            onchange="this.form.submit()"
                                                            {{ $item->content_visibility_status == 'public' ? 'checked' : '' }}>
                                                        <span class="slider round"></span>
                                                    </label>

                                                    <span style="font-weight: bold; margin-left: 8px;">
                                                        {{ $item->content_visibility_status == 'public' ? 'Published' : 'Private' }}
                                                    </span>
                                                </form>
                                            @else
                                                <span class="badge badge-secondary">Complete content to enable
                                                    visibility</span>
                                            @endif
                                        </td>


                                        <!-- Action -->
                                        <td>
                                            <a href="{{ route('admin.replicatemasscontent.edit', ['id' => $item->id]) }}"
                                                title="Edit">
                                                <i class="fa fa-edit listing"></i>
                                            </a>

                                            <a href="{{ route('admin.replicatemasscontent.remove', ['id' => $item->id]) }}"
                                                onclick="return confirm('Are you sure you want to delete this content and {{ $item->pages->count() }} pages under it?');"
                                                title="Delete">
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
