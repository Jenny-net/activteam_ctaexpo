@extends('layouts.main.admin-dashboard')

@section('content')
    <div class="admin-body-area">
        <!-- Content markup goes here -->
        <form action="{{ route('admin.massportfoliogallery.update', $dataArr['content']->id) }}" method="POST" id="content_form"
            enctype="multipart/form-data">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        {{ csrf_field() }}
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Content Title</label>
                                <input type="text" class="form-control" name="content_title" id="content_title"
                                    placeholder="Content Title" value="{{ $dataArr['content']->content_title }}">
                            </div>
                        </div>
                       <input type="hidden" name="template" value="massportfolio" >
                        {{-- <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>No of pages</label>
                                <input type="number" name="no_of_pages" value="{{ $dataArr['content']->pages->count() }}"
                                    class="form-control" min="1" disabled>
                            </div>
                        </div> --}}
                        <div class="col-lg-12 col-md-12">
                            <div class="category-list-area">
                                <div class="upload-right-col" id="fullDiv">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @include('includes.mass_portfolio_gallery_tab')
                                            <div class="tab-content" style="overflow: hidden;width: 100%;">
                                                <div id="step2" class="tab-pane active" role="tabpanel">
                                                    <h2 class="por-Photo">Please provide Detail of  your page</h2>
                                                    <div class="popup-form" style="width:100%" id="section1Holder">
                                                        @forelse ($dataArr['content']->pages as $pky => $pgVal)
                                                            <div class="card mt-2">
                                                                <div class="card-header">
                                                                    <h4>Page No: {{ $pky + 1 }}</h4>
                                                                </div> 
                                                                <div class="card-body">
                                                                    <div class="form-field form-field-col">
                                                                        <div class="form-field-grid2">
                                                                        <label>Page Name</label>
                                                                        <input type="text" class="form-control url-chck"
                                                                            name="page_name[{{ $pgVal['id'] }}]"
                                                                            placeholder="Page Name"
                                                                            value="{{ $pgVal['page_name'] }}"
                                                                            >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        </div>
                                                                        <div class="input-group">
                                                                            <div class="form-field-grid2">
                                                                            <label>Page Url</label>
                                                                            <input type="text"
                                                                                class="form-control url-chck"
                                                                                name="page_url[{{ $pgVal['id'] }}]"
                                                                                id="page_url_{{ $pky }}"
                                                                                placeholder="Page Url"
                                                                                value="{{ env('APP_URL') }}{{ $pgVal['page_url'] }}"
                                                                                required  onkeypress="if(event.key === ' ') { event.preventDefault(); this.value += '-'; } else if (event.key === '/') { return true; } else { return /[0-9a-zA-Z]/i.test(event.key); }" >
                                                                            <div class="input-group-append-button-copy">
                                                                                <span class="input-group-text copy-icon"
                                                                                    onclick="copyPageUrl({{ $pky }})"
                                                                                    id="copy_icon_{{ $pky }}">&#128203;</span>
                                                                            </div>
                                                                          </div>
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
                                                                            <input type="text" class="form-control url-chck"
                                                                                name="meta_Robots[{{ $pgVal['id'] }}]"
                                                                                placeholder="Meta Robots"
                                                                                value="{{ $pgVal['meta_Robots'] }}" required>
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
                    <button type="button" class="buttonOne btn btn-default btn-lg"
                        style="float:left;border-radius: 12px;margin-top: 15px;background-color:cornflowerblue;"
                        onclick="window.location='{{ route('admin.massportfoliogallery') }}'">Cancel</button>
                    <button type="submit" class="btn btn-success btn-lg"
                        style="float:right;border-radius: 12px;margin-top: 15px;">Save & Next</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Booking Status Section Start -->
@stop

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script>
        function createSlug(input, id) {
            // Convert the string to lowercase and remove leading/trailing whitespaces
            let str = input.value.toLowerCase().trim();

            // Replace spaces and special characters with a hyphen using regular expressions
            str = str.replace(/\s+/g, '-') // Replace spaces with hyphen
                .replace(/[^a-z0-9-]/g, ''); // Remove special characters except hyphen

            // Remove consecutive hyphens
            str = str.replace(/-+/g, '-');
            let random_int = Math.floor(Math.random() * 999999)
            url = `{{ env('APP_URL') }}${str}-${random_int}`

            // Set the value of the page_url input field
            document.getElementById(`page_url_${id}`).value = url;
        }

        function copyPageUrl(id) {
            
            const pageUrlField = document.querySelector(`#page_url_${id}`);
            pageUrlField.select();
            document.execCommand('copy');
            const copyIcon = document.querySelector(`#copy_icon_${id}`);
            copyIcon.innerHTML = '&#10003;'; // Checkmark symbol
            copyIcon.style.color = 'green';
            toastr.success('Page URL copied!', 'Success');
        }
    </script>



@endpush
