<div class="popupFixedHeightOne">
<div class="card-body">
    <form action="{{ route('admin.content.step.eight.upload', $page_id) }}" method="post" enctype="multipart/form">
        {{ csrf_field() }}
        @forelse ($images as $key => $img)
            <div class="preview-image">
                <input type="checkbox" id="{{ $key }}" name="image[]" value="{{ $img->id }}">
                <img src="{{ asset('public/storage/file_manager/thumbnail_image/') . '/' . $img->image_folder . '/' . $img->thumbnail_image }}"
                    alt="" for="{{ $key }}" />
            </div>
        @empty
            <h2>No Data Available</h2>
        @endforelse
        @if ($images->count())
            <div class="flexBtnRow">
                <button type="submit" class="btn btn-success btn-lg"
                    style="float:right;border-radius: 12px;margin-top: 15px;">Upload</button>
        @endif
        <a href="#" class="uploadButton" data-id="{{ $page_id }}">Back</a>
    </form>
</div>
</div>
