@extends('layouts.main.admin-dashboard')
@section('content')
<div class="admin-body-area">
<!-- Booking Status Section Start -->
<div class="booking-status-sec category-list-sec">
	<div class="category-list-hdn">
		<h2>Edit Menu</h2>
		<h3 class="create-cat">
			<a href="{{route('admin.menu')}}">Back</a>
		</h3>
	</div>


	<div class="category-list-area">
		<form action="{{route('admin.menu.update',$dataArr['menuArr']->id)}}" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label>Menu Name</label>
                        <input type="text" name="menu_name" class="form-control" value="{{$dataArr['menuArr']->menu_name}}" required>
                    </div>
                </div>
               
                <div class="form-group">
                    <label>Parent Menu<small class="text-danger"> *leave for parent menu</small></label>
                    <select class="form-control" name="parent">
                        <option value="">--Select As Root--</option>
                        @foreach($dataArr['parentMenus'] as $parentMenu)
                            @if($parentMenu->id != $dataArr['menuArr']->id && !$dataArr['thisMenuIsChildOfCurrent']($dataArr['menuArr'], $parentMenu))
                                <option value="{{ $parentMenu->id }}" @if($parentMenu->id == $dataArr['menuArr']->parent_id) selected @endif>{{ $parentMenu->menu_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                
                <div class="col-lg-6 col-md-6">
                   
                    <div class="form-group" >
                        <label>Page URL <small class="text-danger">optional (only used when you want to add a submenu URL, e.g., Europe-wide supply)</small> </label>
                        <input type="text" name="page_url" value="{{$dataArr['menuArr']->page_url}}" class="form-control" id="page_url"> 
                    </div>
                </div>



            </div>
            <br/>


           <button class="submit-btn subbtn" type="submit">Submit</button>
        </form>

	</div>
</div>

</div>
<!-- Booking Status Section Start -->
@stop

@push('script')
<script type="text/javascript">

    /* $(document).ready(function(e){
        $('#menu_type').change(function(){
            var val = $(this).val();
            if(val == 'content') {
                $('#url_div').hide();
                $('#url').prop("required", false);

                $('#content_div').show();
                $('.meta-sec').show();
            } else if(val == 'url') {
                $('#content_div').hide();

                $('#url_div').show();
                $('#url').prop("required", true);
                $('.meta-sec').hide();
            } else {
                $('#content_div').hide();
                $('#url_div').hide();
                $('.meta-sec').hide();
            }
        });
    });
*/

    function validateURL() {
        var textval = $('#url').val();
        var urlregex = new RegExp(
            "^(http:\/\/|https:\/\/|ftp:\/\/){1}([0-9A-Za-z]+\.)");
        var res = urlregex.test(textval);
        if(textval != "" && res == false) {
            $('.subbtn').attr("disabled", true);
            $('.err').show();
        } else {
            $('.subbtn').attr("disabled", false);
            $('.err').hide();
        }
    }
</script>
@endpush
