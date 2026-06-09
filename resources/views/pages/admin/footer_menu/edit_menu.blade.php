@extends('layouts.main.admin-dashboard')
@section('content')
<div class="admin-body-area">
<!-- Booking Status Section Start -->
<div class="booking-status-sec category-list-sec">
	<div class="category-list-hdn">
		<h2>Edit Menu</h2>
		<h3 class="create-cat">
			<a href="{{route('admin.footer.menu')}}">Back</a>
		</h3>
	</div>


	<div class="category-list-area">
		<form action="{{route('admin.footer.menu.update',$dataArr['menuArr']->id)}}" method="POST">
            {{ csrf_field() }}
            <div class="row">

               <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label>Parent Menu<small class="text-danger"> *leave for parent menu</small></label>
                        <select class="form-control" name="parent" id="parent_menu">

                            <option  value="" >--Select As Root--</option>
                            @foreach($dataArr["parentMenuArr"] as $pMenu)
                                <option value="{{$pMenu->id}}" {{ @$dataArr['menuArr']->parent_id == $pMenu->id ? "selected" : ""}}>{{$pMenu->menu_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> 
     
                
                
               <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label>Menu Name</label>
                        <input type="text" name="menu_name" class="form-control" value="{{$dataArr['menuArr']->menu_name}}" required>
                    </div>
                </div>


                <div class="col-lg-6 col-md-6">
                    <!-- Page URL input field -->
                    <div class="form-group" id="page_url_field">
                        <label>Page URL</label>
                        <input type="text" name="page_url" class="form-control" id="page_url" value="{{$dataArr['menuArr']->page_url}}" required>
                    </div>
                </div>
                

            </div>

           <button class="submit-btn subbtn" type="submit">Submit</button>
        </form>

	</div>
</div>

</div>
<!-- Booking Status Section Start -->
@stop

@push('script')
<script type="text/javascript">
   $(document).ready(function() {
    // Hide the page URL field by default
    $('#page_url_field').hide();

    // Show/hide the page URL field based on parent menu selection
    $('#parent_menu').change(function() {
        var val = $(this).val();
        if (val === '') {
            $('#page_url_field').hide();
        } else {
            $('#page_url_field').show();
        }
    });

    // Trigger the change event initially to handle pre-selected values
    $('#parent_menu').trigger('change');
});

</script>

@endpush
