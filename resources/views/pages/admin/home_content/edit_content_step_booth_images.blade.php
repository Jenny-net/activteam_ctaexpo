@extends('layouts.main.admin-dashboard')

@section('content')
<div class="admin-body-area">
    <!-- Booking Status Section Start -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="category-list-area">
                        <div class="upload-right-col" id="fullDiv">
                            <div class="row">
                                <div class="col-lg-12">
                                    @include('includes.index_nav_tabs')

                                    <div class="tab-content" style="overflow: hidden; width: 100%;">
                                        <div id="step2" class="tab-pane active" role="tabpanel">
                                            <h2 class="por-Photo">Exhibition Booths
                                            </h2>



                                        <div class="popup-form" style="width: 100%" id="section1Holder">
                                            <div class="card mt-2 stepSixContentArea">
                                                <div id="sortable-images" class="fileManagerItemRow">
                                                    @php
                                                    
                                                    $sortedImages = $dataArr['page']->pageBoothImages->sortBy('order_by');
                                                    @endphp

                                                    @foreach ($sortedImages as $boothImage)
                                                    <div class="fileManagerItem" data-image-id="{{ $boothImage->id }}">
                                                        <img src="{{ asset('public/storage/file_manager/thumbnail_image/' . $boothImage->image->image_folder . '/' . $boothImage->image->thumbnail_image) }}"
                                                            alt="" />
                                                        <a class="fileManagerRemoveIcon"
                                                            href="{{ route('admin.home.page.booth.image.remove', $boothImage->id) }}"
                                                            onclick="return confirm('Are you sure to delete?');">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                        </div>

                                                <!-- Upload button placed outside the loop -->
                                                <div class="form-group">
                                                    <button type="button"
                                                        class="buttonThree btn btn-primary uploadButton"
                                                        data-id="{{ $dataArr['page']->id }}">Upload Gallery Images</button>
                                                </div>
                                                <div id="page_{{ $dataArr['page']->id }}_image-preview-container"
                                                    class="image-preview-container"></div>
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
            <button type="button"
                style="float:left;border-radius: 12px;margin-top: 15px;background-color:cornflowerblue;"
                class="btn btn-default btn-lg"
                onclick="window.location='{{ route('admin.homecontent.step.seven.second.update', $dataArr['page']->id) }}'">
                Back
            </button>
            <button type="button" class="btn btn-success btn-lg"
                style="float:right;border-radius: 12px;margin-top: 15px;"
                onclick="window.location='{{ route('admin.homecontent.step.eight.second.update', $dataArr['page']->id) }}'">
                Save </button>
        </div>
    </div>
</div>
<!-- Booking Status Section Start -->
@endsection

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
            let url = "{{ route('admin.filemanager.image.for.both', [':slug1', ':slug2']) }}"
            url = url.replace(":slug1", folder_id);
            url = url.replace(":slug2", page_id);
            $.get(url, (response) => {
                $("#imageUploadBody").empty();
                $('#imageUploadBody').append(response);
            });
            $('#imageUpload').show();
        });

        // Initialize sortable
        $("#sortable-images").sortable({
            update: function(event, ui) {

                var newOrder = $(this).sortable('toArray', {
                    attribute: 'data-image-id'
                });


                $.ajax({
                type: "POST",
                url: "{{ route('admin.homecontent.step.booth.save', $dataArr['page']->id) }}",
                data: {
                    newOrder: newOrder,
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {

                    console.log(response.message);


                    console.log(response.data);
                },
                error: function(xhr, status, error) {

                    console.error(error);
                }
            });

            }
        });
    });
</script>
@endpush()
