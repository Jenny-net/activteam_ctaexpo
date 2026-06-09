@extends('layouts.main.admin-dashboard')

@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <form action="{{ route('admin.content.update', $dataArr['content']->id) }}" method="POST" id="content_form"
            enctype="multipart/form-data">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        {{ csrf_field() }}

                                            <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Select Template</label>
                                <select class="form-control" name="template" required>
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
                                <select class="form-control" name="menu_id" required>

                                    @foreach ($dataArr['parentMenuArr'] as $category)
                                        <option {{ $dataArr['content']->menu_id == $category->id ? 'selected' : '' }}
                                            value="{{ $category->id }}">
                                            {{ $category->menu_name }}</option>
                                        @foreach ($category->subMenu as $sub)
                                            <option {{ $dataArr['content']->menu_id == $sub->id ? 'selected' : '' }}
                                                value="{{ $sub->id }}">
                                                -{{ $sub->menu_name }}</option>
                                            @foreach ($sub->subMenu as $subsub)
                                                <option {{ $dataArr['content']->menu_id == $subsub->id ? 'selected' : '' }}
                                                    value="{{ $subsub->id }}">--{{ $subsub->menu_name }}</option>
                                                @foreach ($subsub->subMenu as $sub3)
                                                    <option
                                                        {{ $dataArr['content']->menu_id == $sub3->id ? 'selected' : '' }}
                                                        value="{{ $sub3->id }}">---{{ $sub3->menu_name }}</option>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>


                       
                        <div class="col-lg-12 col-md-12">
                            <div class="category-list-area">
                                <div class="upload-right-col" id="fullDiv">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @include('includes.nav_tabs')

                                            <div class="tab-content" style="overflow: hidden;width: 100%;">
                                                <div id="step2" class="tab-pane active" role="tabpanel">
                                                    <h2 class="por-Photo">Please provide Detail(s) of all
                                                        your pages</h2>
                                                    <div class="popup-form" style="width:100%" id="section1Holder">
                                                        @forelse ($dataArr['content']->pages as $pky => $pgVal)
                                                            <div class="card mt-2">

                                                                    

                                                                
                                                                {{-- <div class="card-header">
                                                                    <h4>Page No: {{ $pky + 1 }}</h4>
                                                                </div> --}}
                                                                <div class="card-body">
                                                                    <div class="form-field form-field-col">
                                                                        <div class="form-field-grid2">
                                                                        <label>Page Name</label>
                                                                        @error('page_name.*')
                                                                        <small class="text-danger">Page Name field is required.</small>
                                                                        @enderror
                                                                        <input type="text" class="form-control url-chck"
                                                                            name="page_name[{{ $pgVal['id'] }}]"
                                                                            placeholder="Page Name"
                                                                            value="{{ $pgVal['page_name'] }}"
                                                                            >
                                                                        </div>
                                                                        <div class="form-field-grid2">
                                                                            <label>Page Url</label>
                                                                            @error('page_url.*')
                                                                            <small class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                            <input
                                                                                type="text"
                                                                                class="form-control url-chck"
                                                                                name="page_url[{{ $pgVal['id'] }}]"
                                                                                id="page_url_{{ $pky }}"
                                                                                placeholder="Page Url"
                                                                                value="{{ $pgVal['page_url'] }}"
                                                                                oninput="sanitizePageUrl(this)"
                                                                                required
                                                                            >
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-field form-field-col">
                                                                        <div class="form-field-grid2">
                                                                        <label>Meta Title</label>
                                                                        @error('meta_title.*')
                                                                        <small class="text-danger">Meta Title field is required.</small>
                                                                        @enderror
                                                                        <input type="text" class="form-control url-chck"
                                                                            name="meta_title[{{ $pgVal['id'] }}]"
                                                                            placeholder="Meta Title"
                                                                            value="{{ $pgVal['meta_title'] }}" >
                                                                        </div>
                                                                        <div class="form-field-grid2">
                                                                        <label>Meta Robots</label>
                                                                        @error('meta_Robots.*')
                                                                        <small class="text-danger">The Meta Robots field is required.</small>
                                                                         @enderror
                                                                           <input type="text"
                                                                            class="form-control url-chck"
                                                                            name="meta_Robots[{{ $pgVal['id'] }}]"
                                                                            placeholder="Meta Robots"
                                                                            value="{{ $pgVal['meta_Robots'] }}"
                                                                           >
                                                                        </div>
                                                                        <div class="form-field-grid2">
                                                                            <label>Meta Revisit After</label>
                                                                            @error('meta_revisit_after.*')
                                                                            <small class="text-danger"> Meta Revisit After field is required.</small>
                                                                            @enderror
                                                                            <input type="text" class="form-control url-chck"
                                                                            name="meta_revisit_after[{{ $pgVal['id'] }}]"
                                                                            placeholder="Meta Revisit After"
                                                                            value="{{ $pgVal['meta_revisit_after'] }}" >
                                                                        </div>
                                                                        <div class="form-field-grid2">
                                                                            <label>Meta Canonical</label>
                                                                            @error('meta_canonical.*')
                                                                            <small class="text-danger"> Meta Canonical field is required.</small>
                                                                            @enderror
                                                                            <input type="text" class="form-control url-chck"
                                                                            name="meta_canonical[{{ $pgVal['id'] }}]"
                                                                            placeholder="Meta Canonical"
                                                                            value="{{ $pgVal['meta_canonical'] }}" >
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-field">
                                                                        <label>Meta Description</label>
                                                                        @error('meta_description.*')
                                                                        <small class="text-danger"> Meta Description field is required.</small>
                                                                        @enderror
                                                                        <textarea name="meta_description[{{ $pgVal['id'] }}]" placeholder="Meta Description" class="form-control">{{ $pgVal['meta_description'] }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @empty
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
                        style="float:left;border-radius: 12px;margin-top: 15px;background-color:cornflowerblue;" onclick="window.location='{{ route('admin.content') }}'">Cancel</button>
                    <button type="submit" class="btn btn-success btn-lg"
                        style="float:right;border-radius: 12px;margin-top: 15px;">Save & Next</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Booking Status Section Start -->
@stop

@push('script')
    



<script>
    function updatePageUrl(input, id) {
        let str = input.value.toLowerCase().trim();
        str = str.replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');
        str = str.replace(/-+/g, '-');

        // Update the displayed slug in the <span> element
        document.getElementById(`generated-slug-${id}`).textContent = str;

        // Update the corresponding input field for the page URL
        document.getElementById(`page_url_${id}`).value = str;
    }
</script>


<script>
   function sanitizePageUrl(input) {
    // Get the input value
    let pageUrlValue = input.value;

    // Replace spaces with hyphens
    pageUrlValue = pageUrlValue.replace(/\s+/g, '-');

    // Remove consecutive hyphens
    pageUrlValue = pageUrlValue.replace(/-+/g, '-');

    // Remove special characters using a regular expression (except alphanumeric, hyphens, and slashes)
    pageUrlValue = pageUrlValue.replace(/[^a-zA-Z0-9/-]/g, '');

    // Set the sanitized value back to the input
    input.value = pageUrlValue;
}

</script>
@endpush
