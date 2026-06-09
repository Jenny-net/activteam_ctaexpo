@extends('layouts.main.admin-dashboard')
@section('content')
<div class="admin-body-area">
<!-- Booking Status Section Start -->
<div class="booking-status-sec category-list-sec">
	<div class="category-list-hdn">
		<h2>Add Menu</h2>
		<h3 class="create-cat">
            <a href="{{route('admin.menu')}}">Back</a>
		</h3>
	</div>


	<div class="category-list-area">
		<form action="{{route('admin.menu.insert')}}" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-6 col-md-6">
                     <div class="form-group">
                        <label>Parent Menu<small class="text-danger"> *leave for parent menu</small></label>
                        <select class="form-control" name="parent">
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
            </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label>Menu Name</label>
                        <input type="text" name="menu_name" class="form-control" required>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                   
                    <div class="form-group" >
                        <label>Page URL <small class="text-danger">optional (only used when you want to add a submenu URL, e.g., Europe-wide supply)</small> </label>
                        <input type="text" name="page_url" class="form-control" id="page_url"> 
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


</script>
@endpush
