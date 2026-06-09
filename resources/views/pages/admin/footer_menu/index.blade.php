@extends('layouts.main.admin-dashboard')
@section('content')
<div class="admin-body-area">
<!-- Booking Status Section Start -->
<div class="booking-status-sec category-list-sec">
	<div class="category-list-hdn">
		<h2>Footer Menu Management</h2>
		<h3 class="create-cat">
			<a href="{{route('admin.footer.menu.add')}}">Add new menu</a>
		</h3>
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
							{{-- <th>URL</th>
							<th>Page Title</th>
							<th>Keyword</th> --}}
							<th>Action</th>
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
								<a href="{{ route('admin.footer.menu.edit',$menu->id) }}" title="Edit">
									<i class="fa fa-edit listing"></i>
								</a>
								<a href="{{ route('admin.footer.menu.remove',$menu->id) }}" title="Delete" onclick="return confirm('If you delete this menu then page content will delete. Are you sure to delete?');">
									<i class="fa fa-trash chat"></i>
								</a>
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
