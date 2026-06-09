{{-- @extends('layouts.main.admin-dashboard')

@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->

        <div class="card">
            <div class="card-body">
                <div class="row">



                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label>Content Title</label>
                            <input type="text" class="form-control" name="content_title" id="content_title"
                                placeholder="Content Title" value="{{ $dataArr['content']->content_title }}" disabled>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label>Select Template</label>
                            <select class="form-control" name="template" disabled>
                                <option value="">Select Teplate</option>
                                <option {{ $dataArr['content']->template == 'one' ? 'selected' : '' }} value="1">
                                    Template One</option>
                                <option {{ $dataArr['content']->template == 'two' ? 'selected' : '' }} value="2">
                                    Template Two</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label>Select Menu</label>
                            <select class="form-control" name="menu_id" disabled>
                                <option>{{ $dataArr['content']->menu->menu_name }}</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label>No of pages</label>
                            <input type="number" name="no_of_pages" value="{{ $dataArr['content']->pages->count() }}"
                                class="form-control" min="1" id="pageNo" disabled>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="category-list-area">
                            <div class="upload-right-col" id="fullDiv">
                                <div class="row">
                                    <div class="col-lg-12">
                                        @include('includes.nav_tabs')

                                        <div class="tab-content" style="overflow: hidden; width: 100%;">
                                            <div id="step2" class="tab-pane active" role="tabpanel">
                                                <h2 class="por-Photo">Please provide details of 5th section(s) of all
                                                    your pages</h2>
                                                <div class="popup-form" style="width: 100%" id="section1Holder">
                                                    @forelse ($dataArr['content']->pages as $pky => $pgVal)
                                                        <div class="card mt-2 stepSixContentArea">
                                                            <div class="card-header">
                                                                <h4>Page No: {{ $pky + 1 }}</h4>
                                                            </div>
                                                            <div class="fileManagerItemRow">
                                                                @foreach ($pgVal->pageImages as $pageImage)
                                                                    <div class="fileManagerItem">
                                                                        <img src="{{ asset('public/storage/file_manager/thumbnail_image/') . '/' . $pageImage->image->image_folder . '/' . $pageImage->image->thumbnail_image }}"
                                                                            alt="" />
                                                                        <a class="fileManagerRemoveIcon"
                                                                            href="{{ route('admin.page.image.remove', $pageImage->id) }}"
                                                                            onclick="return confirm('Are you sure to delete?');">
                                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                                        </a>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="button"
                                                                    class="buttonThree btn btn-primary uploadButton"
                                                                    data-id="{{ $pgVal->id }}">Upload Gallery
                                                                    Images</button>
                                                            </div>

                                                            <div id="page_{{ $pgVal->id }}_image-preview-container"
                                                                class="image-preview-container"></div>
                                                        </div>
                                                    @empty
                                                        No pages found.
                                                    @endforelse
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
                <button type="button" class="buttonOne btn btn-default btn-lg"
                    style="float:left;border-radius: 12px;margin-top: 15px;background-color:cornflowerblue;"
                    onclick="window.location='{{ route('admin.content') }}'">Cancel</button>
                <button type="button" class="btn btn-success btn-lg"
                    style="float:right;border-radius: 12px;margin-top: 15px;"
                    onclick="window.location='{{ route('admin.content.step.three.update', $dataArr['content']->id) }}'">Next</button>
            </div>
        </div>

    </div>

    <!-- Booking Status Section Start -->
@stop
@push('modal')
    <div class="notification-modal-popup" id="imageUpload">
        <div class="noti-popup-box">
            <button class="noti-close-btn" onclick="$('#imageUpload').hide();">X</button>
            <div class="noti-pop-hdn">
                <h2>File Manager</h2>
            </div>
            <div class="noti-pop-body ImgUploadPopupBody" id="imageUploadBody">
            </div>
        </div>
    </div>
@endpush()

@push('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.uploadButton', function() {
                let page_id = $(this).data('id');
                let url = "{{ route('admin.filemanager.folder', ':slug') }}"
                url = url.replace(":slug", page_id);
                $.get(url, (response) => {
                    $('#imageUploadBody').append(response);
                });
                $("#imageUploadBody").empty();
                $('#imageUpload').show();
            });

            $(document).on('click', '.folderName', function() {
                let page_id = $(this).attr('data-pageId');
                let folder_id = $(this).attr('data-folderId');
                let url = "{{ route('admin.filemanager.image', [':slug1', ':slug2']) }}"
                url = url.replace(":slug1", folder_id);
                url = url.replace(":slug2", page_id);
                $.get(url, (response) => {
                    $("#imageUploadBody").empty();
                    $('#imageUploadBody').append(response);
                });
                $('#imageUpload').show();
            })
        });
    </script>
@endpush() --}}
