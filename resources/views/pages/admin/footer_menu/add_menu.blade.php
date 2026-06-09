@extends('layouts.main.admin-dashboard')
@section('content')
<div class="admin-body-area">
<!-- Booking Status Section Start -->
<div class="booking-status-sec category-list-sec">
	<div class="category-list-hdn">
		<h2>Add Menu</h2>
		<h3 class="create-cat">
            <a href="{{route('admin.footer.menu')}}">Back</a>
		</h3>
	</div>


	<div class="category-list-area">
		<form action="{{route('admin.footer.menu.insert')}}" method="POST">
            {{ csrf_field() }}
            <div class="row">
                    
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label>Parent Menu<small class="text-danger"> *leave for parent menu</small></label>
                        <select class="form-control" name="parent" id="parent_menu">
                            <option value="">--Select As Root--</option>
                                @foreach($dataArr["parentMenuArr"] as $category)
                                    <option value="{{$category->id}}">{{$category->menu_name}}</option>
                                    @foreach($category->subMenu as $sub)
                                        <option value="{{$sub->id}}">-{{$sub->menu_name}}</option>
                                        @foreach($sub->subMenu as $subsub)
                                            <option value="{{$subsub->id}}">--{{$subsub->menu_name}}</option>
                                                @foreach($subsub->subMenu as $sub3)
                                                     <option value="{{$sub3->id}}">---{{$sub3->menu_name}}</option>
                                                @endforeach
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </select>
    
                        </div>
                    </div>

         
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>Menu Name</label>
                            <input type="text" name="menu_name" class="form-control" required>
                        </div>
                    </div>


                    <div class="col-lg-6 col-md-6">
                        <!-- Page URL input field -->
                        <div class="form-group" id="page_url_field">
                            <label>Page URL</label>
                            <input type="text" name="page_url" class="form-control" id="page_url"> <!-- Add id="page_url" here -->
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
    $(document).ready(function(e){
        $('#parent_menu').change(function(){
            var val = $(this).val();
            if (val === '') {
                $('#page_url_field').hide();
            } else {
                $('#page_url_field').show();
            }
        });

        // Initially hide the Page URL field on page load
        $('#page_url_field').hide();
    });
</script>




@endpush
