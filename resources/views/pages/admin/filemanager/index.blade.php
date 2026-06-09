@extends('layouts.main.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec category-list-sec">
            <div class="category-list-hdn">
                <h2>File Manager</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.filemanager.add') }}">Add New Images</a>
                </h3>
                <h3 class="create-cat">
                    <a href="{{ route('admin.filemanager.update.folder.image') }}">Update Folder Images</a>
                </h3>
               
            </div>

            <div class="category-list-area">

                <!-- User List Area -->
                <div class="datatable">
                    <div class="card-body">
                        <div class="fileManagerItemRow">

                            @forelse ($folders as $folder => $images)
                                <div class="folderNameDiv">
                                    <h2 class="folderName">{{ str_replace('_', ' ', strtoupper($folder)) }}</h2>
                                </div>
                                @foreach ($images as $img)
                                    <div class="fileManagerItem">
                                        <img src="{{ asset('public/storage/file_manager/thumbnail_image/') . '/' . $img->image_folder . '/' . $img->thumbnail_image }}"
                                            alt="" />
                                            <p class="image-name">{{ explode('__-__', $img->original_image)[0] }}</p>

                                        <a class="fileManagerRemoveIcon"
                                            href="{{ route('admin.filemanager.remove', $img->id) }}"
                                            onclick="return confirm('Are you sure to delete?');"><i class="fa fa-trash-o"
                                                aria-hidden="true"></i></a>
                                    </div>
                                @endforeach
                            @empty
                                <h2>No Data Available</h2>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Booking Status Section Start -->
@stop
