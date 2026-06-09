@extends('layouts.main.admin-dashboard')

@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <form action="{{ route('admin.Portfolio.update', $dataArr['content']->id) }}" method="POST" id="content_form"
            enctype="multipart/form-data">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        {{ csrf_field() }}

                       

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
                                            @include('includes.portfolio_nav_tabs')

                                            <div class="tab-content" style="overflow: hidden;width: 100%;">
                                                <div id="step2" class="tab-pane active" role="tabpanel">
                                                    <h2 class="por-Photo">Please provide Detail(s) of all
                                                        your pages</h2>
                                                    <div class="popup-form" style="width:100%" id="section1Holder">
                                                        @forelse ($dataArr['content']->pages as $pky => $pgVal)
                                                            <div class="card mt-2">

                                                                    

                                                                
                                                              
                                                                <div class="card-body">
                                                                    <div class="form-field form-field-col">
                                                                        <div class="form-field-grid2">
                                                                        <label>Page Name</label>
                                                                        <input type="text" class="form-control url-chck"
                                                                            name="page_name[{{ $pgVal['id'] }}]"
                                                                            placeholder="Page Name"
                                                                            value="{{ $pgVal['page_name'] }}"
                                                                            >
                                                                        </div>
                                                                        <div class="form-field-grid2">
                                                                            <label>Page Url</label>
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
                                                                        <input type="text" class="form-control url-chck"
                                                                            name="meta_title[{{ $pgVal['id'] }}]"
                                                                            placeholder="Meta Title"
                                                                            value="{{ $pgVal['meta_title'] }}" required>
                                                                        </div>
                                                                        <div class="form-field-grid2">
                                                                        <label>Meta Robots</label>
                                                                           <input type="text"
                                                                            class="form-control url-chck"
                                                                            name="meta_Robots[{{ $pgVal['id'] }}]"
                                                                            placeholder="Meta Robots"
                                                                            value="{{ $pgVal['meta_Robots'] }}"
                                                                            required>
                                                                        </div>
                                                                        <div class="form-field-grid2">
                                                                            <label>Meta Revisit After</label>
                                                                            <input type="text" class="form-control url-chck"
                                                                            name="meta_revisit_after[{{ $pgVal['id'] }}]"
                                                                            placeholder="Meta Revisit After"
                                                                            value="{{ $pgVal['meta_revisit_after'] }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-field">
                                                                        <label>Meta Description</label>
                                                                        <textarea name="meta_description[{{ $pgVal['id'] }}]" placeholder="Meta Description" required class="form-control">{{ $pgVal['meta_description'] }}</textarea>
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
                    {{-- <button type="button" class="buttonOne btn btn-default btn-lg"
                        style="float:left;border-radius: 12px;margin-top: 15px;background-color:cornflowerblue;" onclick="window.location='{{ route('admin.content') }}'">Cancel</button>
                   --}} <button type="submit" class="btn btn-success btn-lg" 
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

        
        document.getElementById(`generated-slug-${id}`).textContent = str;

        
        document.getElementById(`page_url_${id}`).value = str;
    }
</script>


<script>
   function sanitizePageUrl(input) {

    let pageUrlValue = input.value;


    pageUrlValue = pageUrlValue.replace(/\s+/g, '-');

    pageUrlValue = pageUrlValue.replace(/-+/g, '-');

    pageUrlValue = pageUrlValue.replace(/[^a-zA-Z0-9/-]/g, '');

    input.value = pageUrlValue;
}

</script>
@endpush