@extends('layouts.main.admin-dashboard')

@section('content')
<style>
    .fixed-image {
        max-width: 100px; 
        height: auto;
    }
    
</style>
<div class="admin-body-area">
    <!-- Booking Status Section Start -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <label>Select Menu</label>
                        <select class="form-control" name="menu_id" disabled>
                            <option>{{ $dataArr['content']->menu->menu_name }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    @include('includes.portfolio_nav_tabs')
                    
                </div>
                <div>
                    <button type="button" id="showPortfolioModalBtn" data-toggle="modal" data-target="#portfolioModal">
                        Add New Portfolio
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Portfolio Gallery Modal -->
<div class="modal fade" id="portfolioModal" tabindex="-1" role="dialog" aria-labelledby="portfolioModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.Portfolio.gallery.insert', $dataArr['content']->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="portfolioModalLabel">Add New Portfolio Gallery</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="gallery-image">Gallery Image</label>
                        <input type="file" class="form-control-file" id="gallery-image" name="gallery_image" accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <img id="image-preview" src="#" alt="Image Preview" class="fixed-image" style="max-width: 200px; display: none;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
            
        </div>
    </div>
</div><div class="card">
    <div class="card-body">
        <h4>Portfolio Galleries</h4>
        <div class="popup-form" style="width: 100%" id="section1Holder">
            <div class="card mt-2 stepSixContentArea">
                <div id="sortable-images" class="fileManagerItemRow">
                    @foreach ($dataArr['portfolioGalleries'] as $portfolioGallery)
                        @if ($portfolioGallery->page_id == $dataArr['pageId'])
                            <div class="fileManagerItem" data-image-id="{{ $portfolioGallery->id }}">
                                <img src="{{ asset('public/storage/gallery/' . $portfolioGallery->gallery_image) }}"
                                    alt="{{ $portfolioGallery->portfolio_name }}" />
                                <a class="fileManagerRemoveIcon"
                                    href="{{ route('admin.portfolio.remove.gallery.image', $portfolioGallery->id) }}"
                                    onclick="return confirm('Are you sure to delete?');">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        
    </div>
</div>

<div class="card-footer">
   
    <button type="button" class="btn btn-success btn-lg"
    style="float:right;border-radius: 12px;margin-top: 15px;"
    onclick="window.location='{{ route('admin.portfolio.content.step.one.mass.page.url.update', $dataArr['content']->id) }}'">
    Save </button>
</div>



@push('script')
<script>
     $(document).ready(function() {
        document.getElementById("gallery-image").addEventListener("change", function () {
        var preview = document.getElementById("image-preview");
        var fileInput = document.getElementById("gallery-image");

        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = "block";
            };

            reader.readAsDataURL(fileInput.files[0]);
        } else {
            preview.src = "#";
            preview.style.display = "none";
        }
    });
        
  
 });
   
</script>
@endpush



@stop
