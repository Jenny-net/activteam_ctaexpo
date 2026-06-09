<div class="card-body">

    @forelse ($folders as $folder)
        <a href="javascript:void(0)" class="folderName" data-pageId="{{ $page_id }}"
            data-folderId="{{ $folder->id }}">{{ str_replace('_', ' ', strtoupper($folder->image_folder)) }}</a><br />
    @empty
        <h2>No Data Available</h2>
    @endforelse

</div>