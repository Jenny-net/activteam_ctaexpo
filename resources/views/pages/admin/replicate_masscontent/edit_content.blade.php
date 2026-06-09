@extends('layouts.main.admin-dashboard')

@section('content')
<div class="admin-body-area">
    <form action="{{ route('admin.replicatemasscontent.update', $dataArr['content']->id) }}"
          method="POST" id="content_form" enctype="multipart/form-data">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    {{ csrf_field() }}

                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label>Content Title</label>
                            <input type="text" class="form-control" name="content_title"
                                   value="{{ $dataArr['content']->content_title }}">
                            <span class="text-danger error-field" id="error_content_title"></span>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label>Select Template</label>
                            <select class="form-control" name="template">
                                <option value="">Select Template</option>
                                <option {{ $dataArr['content']->template == 'one' ? 'selected' : '' }} value="one">Template One</option>
                                <option {{ $dataArr['content']->template == 'two' ? 'selected' : '' }} value="one">Template Two</option>
                                
                            </select>
                            <span class="text-danger error-field" id="error_template"></span>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label>No of pages</label>
                            <input type="number" class="form-control" 
                                   value="{{ $dataArr['content']->pages->count() }}" disabled>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="category-list-area">

                            <div class="upload-right-col" id="fullDiv">
                                <div class="row">
                                    <div class="col-lg-12">

                                        @include('includes.replicate_nav_tab')

                                        <div class="tab-content">
                                            <div id="step2" class="tab-pane active">

                                                <h2 class="por-Photo">Please provide Detail(s) of all your pages</h2>

                                                <div class="popup-form" id="section1Holder">

                                                    @foreach ($dataArr['content']->pages as $pky => $pgVal)

                                                    <div class="card mt-2">
                                                        <div class="card-header">
                                                            <h4 style="display:inline-block;">Page No: {{ $pky + 1 }}</h4>
                                                              @if ($dataArr['content']->pages->count() > 1)
                                                                        <a href="{{ route('admin.replicatemasscontent.page.remove', $pgVal['id']) }}"
                                                                            onclick="return confirm('Are you sure you want to delete this page?')"
                                                                            style="float:right; font-size:20px; cursor:pointer; color:red;">
                                                                            <i class="fa fa-trash"></i>
                                                                        </a>
                                                         @endif
                                                        </div>
                                                       

                                                        <div class="card-body">

                                                            {{-- PAGE NAME + PAGE URL SIDE BY SIDE --}}
                                                            <div class="form-field form-field-col">
                                                                <div class="form-field-grid2">
                                                                    <label>Page Name</label>
                                                                    <input type="text" class="form-control"
                                                                           name="page_name[{{ $pgVal->id }}]"
                                                                           value="{{ $pgVal->page_name }}">
                                                                    <span class="text-danger error-field" id="error_page_name_{{ $pgVal->id }}"></span>
                                                                </div>

                                                                <div class="form-field-grid2">
                                                                    <label>Page URL</label>

                                                                    <div style="display:flex; width:100%; position:relative;">
                                                                        <input type="text" class="form-control"
                                                                               value="{{ env('APP_URL') }}"
                                                                               id="base_url_{{ $pky }}" readonly
                                                                               style="max-width:250px; background:#eee; border-right:0;">

                                                                        <input type="text" class="form-control"
                                                                               name="page_url[{{ $pgVal->id }}]"
                                                                               id="slug_{{ $pky }}"
                                                                               value="{{ $pgVal->page_url }}"
                                                                               oninput="updateFullUrl({{ $pky }})">

                                                                        <span class="input-group-text copy-icon"
                                                                              onclick="copyFullUrl({{ $pky }})"
                                                                              id="copy_icon_{{ $pky }}"
                                                                              style="cursor:pointer; margin-left:5px;">
                                                                            &#128203;
                                                                        </span>
                                                                    </div>

                                                                    <input type="hidden" id="final_url_{{ $pky }}">
                                                                    <span class="text-danger error-url" id="error_page_url_{{ $pgVal->id }}"></span>
                                                                </div>
                                                            </div>

                                                            {{-- META FIELDS IN 2-COLUMN GRID --}}
                                                            <div class="form-field form-field-col">

                                                                <div class="form-field-grid2">
                                                                    <label>Meta Title</label>
                                                                    <input type="text" class="form-control"
                                                                           name="meta_title[{{ $pgVal->id }}]"
                                                                           value="{{ $pgVal->meta_title }}">
                                                                    <span class="text-danger error-field" id="error_meta_title_{{ $pgVal->id }}"></span>
                                                                </div>

                                                                <div class="form-field-grid2">
                                                                    <label>Meta Robots</label>
                                                                    <input type="text" class="form-control"
                                                                           name="meta_Robots[{{ $pgVal->id }}]"
                                                                           value="{{ $pgVal->meta_Robots }}">
                                                                    <span class="text-danger error-field" id="error_meta_Robots_{{ $pgVal->id }}"></span>
                                                                </div>

                                                                <div class="form-field-grid2">
                                                                    <label>Meta Revisit After</label>
                                                                    <input type="text" class="form-control"
                                                                           name="meta_revisit_after[{{ $pgVal->id }}]"
                                                                           value="{{ $pgVal->meta_revisit_after }}">
                                                                    <span class="text-danger error-field" id="error_meta_revisit_after_{{ $pgVal->id }}"></span>
                                                                </div>

                                                                <div class="form-field-grid2">
                                                                    <label>Meta Canonical</label>
                                                                    <input type="text" class="form-control"
                                                                           name="meta_canonical[{{ $pgVal->id }}]"
                                                                           value="{{ $pgVal->meta_canonical }}">
                                                                    <span class="text-danger error-field" id="error_meta_canonical_{{ $pgVal->id }}"></span>
                                                                </div>

                                                            </div>

                                                            {{-- META DESCRIPTION --}}
                                                            <div class="form-field">
                                                                <label>Meta Description</label>
                                                                <textarea class="form-control"
                                                                          name="meta_description[{{ $pgVal->id }}]">{{ $pgVal->meta_description }}</textarea>
                                                                <span class="text-danger error-field" id="error_meta_description_{{ $pgVal->id }}"></span>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    @endforeach

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
                        onclick="window.location='{{ route('admin.replicatemasscontent') }}'">Cancel</button>

                 <button type="submit" class="btn btn-success btn-lg"
                        style="float:right;border-radius: 12px;margin-top: 15px;">Save & Next</button>
            </div>
        </div>

    </form>
</div>
@stop


@push('script')

<!-- AUTO-GENERATE FULL URL ON PAGE LOAD -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    @foreach ($dataArr['content']->pages as $pky => $pgVal)
        let base{{ $pky }} = document.getElementById("base_url_{{ $pky }}").value;
        let slug{{ $pky }} = document.getElementById("slug_{{ $pky }}").value.trim();
        document.getElementById("final_url_{{ $pky }}").value = base{{ $pky }} + slug{{ $pky }};
    @endforeach
});
</script>

<script>
function updateFullUrl(id) {
    let base = document.getElementById(`base_url_${id}`).value;
    let slug = document.getElementById(`slug_${id}`).value.trim();
   document.getElementById(`final_url_${id}`).value = base + slug;

}

function copyFullUrl(id) {
    let full = document.getElementById(`final_url_${id}`).value;

    if (!full) {
        let base = document.getElementById(`base_url_${id}`).value;
        let slug = document.getElementById(`slug_${id}`).value.trim();
        full = base + slug;
    }

    navigator.clipboard.writeText(full);

    const icon = document.getElementById(`copy_icon_${id}`);
    icon.innerHTML = "&#10003;";
    icon.style.color = "green";
}

</script>

<!-- AJAX FORM SAVE -->
<script>
$(document).ready(function () {

    $("#content_form").on("submit", function (e) {
        e.preventDefault();

        $(".error-field").text("");
        $(".error-url").text("");

        let formData = new FormData(this);

        $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,

            success: function (res) {
                window.location.href = res.redirect;
            },

            error: function (xhr) {

                // ============================
                // DUPLICATE URL (409 ERROR)
                // ============================
                if (xhr.status === 409) {
                    let id = xhr.responseJSON.page_id;
                    let msg = xhr.responseJSON.message;

                    $(`#error_page_url_${id}`).text(msg);
                    $(`input[name='page_url[${id}]']`).css("border", "2px solid red");
                }

                // ============================
                // VALIDATION ERRORS (422)
                // ============================
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (field, messages) {

                        if (field.includes(".")) {

                            // array field ex: page_url.22
                            let [key, id] = field.split(".");

                            if (key === "page_url") {
                                $(`#error_page_url_${id}`).text(messages[0]);
                                $(`input[name='page_url[${id}]']`).css("border", "2px solid red");
                            } else {
                                $(`#error_${key}_${id}`).text(messages[0]);
                            }

                        } else {
                            // single fields such as "content_title"
                            $(`#error_${field}`).text(messages[0]);
                        }
                    });
                }
            }
        });
    });

});
</script>

@endpush
