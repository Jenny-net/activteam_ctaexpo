@extends('layouts.main.admin-dashboard')
@section('content')
<div class="admin-body-area">
<!-- Booking Status Section Start -->
<div class="booking-status-sec category-list-sec">
	<div class="category-list-hdn">
		<h2>Menu Management</h2>
		<h3 class="create-cat">
			<a href="{{route('admin.menu.add')}}">Add new menu</a>
		</h3>
	</div>
	<div style="color: red; font-size: small;"><p>Note: &#9733; Before deleting any menu, please note that your content data associated with the menu will be lost.</p></div>
	<div style="color: red; font-size: small;">
		<p>Note: &#9733; The main content menu cannot be updated or deleted form here. You can only update and delete the content from the content menu.</p>
	</div>
	
	<div class="category-list-area">

		<!-- User List Area -->
		<div class="datatable">
			<div class="card-body">
				<table class="table" id="bootstrap-data-table">

					<thead>
						<tr>
							<th>Menu Name</th>
							<th>Parent Menu</th>
							
							<th>edit</th>
							<th>delete</th>
						</tr>
					</thead>

					<tbody>
						@foreach($dataArr["menuArr"] as $menu)
						<tr>
							<td title="Menu Name">
								{{$menu->menu_name}}
							</td>
							<td title="Parent Menu">
								{{@$menu->parentMenu->menu_name}}
							</td>
							
							<td title="Action">
								@if($menu->page_type !== 'root_main_menu')
									<a href="{{ route('admin.menu.edit',$menu->id) }}" title="Edit">
										<i class="fa fa-edit listing"></i>
									</a>
								@endif
								
							</td>
							<td title="Action">
							@if($menu->page_type !== 'root_main_menu')
							<a href="{{ route('admin.menu.remove',$menu->id) }}" title="Delete" @if($menu->parent_id == 0) onclick="return confirm('If you delete this menu then all sub-menu and page content will delete. Are you sure to delete?');" @else onclick="return confirm('If you delete this menu then page content will delete. Are you sure to delete?');" @endif>
								<i class="fa fa-trash chat"></i>
							</a>
							@endif
							</td>
 						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

</div>
<!-- Booking Status Section Start -->
@stop
