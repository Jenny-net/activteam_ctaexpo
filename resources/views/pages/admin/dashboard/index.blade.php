@extends('layouts.main.admin-dashboard')
@section('content')
<div class="admin-body-area">
	<!-- <div class="row">
		<div class="col-lg-8">
			
			<div class="quick-link-sec">
				<h2>Quick Links <span>navigate to important page links</span></h2>
				<ul>
					<li>
						<a href="{{ url('admin/store-vendor') }}"><img src="{{ asset('images/quick-link-icon1.png') }}" alt="">
						<h3>Store/Vendor <br/>Management</h3>
						<p>List of all store/venors who are currently associated.</p>
						<h4 class="quick-link-anchor">11 store/vendors associated</h4></a>
					</li>
					<li>
						<a href="{{ url('admin/beautician') }}"><img src="{{ asset('images/quick-link-icon2.png') }}" alt="">
						<h3>Beautician <br/>Management</h3>
						<p>List of all Instabeuty beautician who are currently associated.</p>
						<h4 class="quick-link-anchor">10 beautician asociated</h4></a>
					</li>
					<li>
						<a href="{{ url('admin/user') }}"><img src="{{ asset('images/quick-link-icon3.png') }}" alt="">
						<h3>Customer <br/>Management</h3>
						<p>List of all Instabeuty customer who are currently associated.</p>
						<h4 class="quick-link-anchor">21 customer asociated</h4></a>
					</li>
				</ul>
			</div>

			
			<div class="booking-status-sec">
				<h2>Today's Booking Satus <span>here is the list of all today's booking</span></h2>
				<div class="booking-table-row">
					<ul>
						<li class="booking-user">
							<img src="{{ asset('images/user.jpg') }}" alt="">
							<h3>Damon Zappariello</h3>
						</li>
						<li class="booking-code">IBH4605</li>
						<li class="booking-timing">5 Jan 2020, 9:40AM</li>
						<li class="booking-member">
							<img src="{{ asset('images/user.jpg') }}" alt="">
							<h4>Sandra</h4>
						</li>
						<li class="booking-view-more">
							<a href="#"><i class="fa fa-circle"></i><i class="fa fa-circle"></i><i class="fa fa-circle"></i></a>
							<div class="booking-view-dropdown">
								<ul>
									<li><a href="#"><i class="fa fa-eye"></i> View</a></li>
									<li><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
									<li><a href="#"><i class="fa fa-trash-o"></i> Remove</a></li>
								</ul>
		          </div>
						</li>
					</ul>
				</div>

				<div class="booking-table-row">
					<ul>
						<li class="booking-user">
							<img src="{{ asset('images/user.jpg') }}" alt="">
							<h3>Damon Zappariello</h3>
						</li>
						<li class="booking-code">IBH4605</li>
						<li class="booking-timing">5 Jan 2020, 9:40AM</li>
						<li class="booking-member">
							<img src="{{ asset('images/user.jpg') }}" alt="">
							<h4>Sandra</h4>
						</li>
						<li class="booking-view-more">
							<i class="fa fa-circle"></i><i class="fa fa-circle"></i><i class="fa fa-circle"></i>
						</li>
					</ul>
				</div>

				<div class="booking-table-row">
					<ul>
						<li class="booking-user">
							<img src="{{ asset('images/user.jpg') }}" alt="">
							<h3>Damon Zappariello</h3>
						</li>
						<li class="booking-code">IBH4605</li>
						<li class="booking-timing">5 Jan 2020, 9:40AM</li>
						<li class="booking-member">
							<img src="{{ asset('images/user.jpg') }}" alt="">
							<h4>Sandra</h4>
						</li>
						<li class="booking-view-more">
							<i class="fa fa-circle"></i><i class="fa fa-circle"></i><i class="fa fa-circle"></i>
						</li>
					</ul>
				</div>

				<div class="booking-table-row">
					<ul>
						<li class="booking-user">
							<img src="{{ asset('images/user.jpg') }}" alt="">
							<h3>Damon Zappariello</h3>
						</li>
						<li class="booking-code">IBH4605</li>
						<li class="booking-timing">5 Jan 2020, 9:40AM</li>
						<li class="booking-member">
							<img src="{{ asset('images/user.jpg') }}" alt="">
							<h4>Sandra</h4>
						</li>
						<li class="booking-view-more">
							<i class="fa fa-circle"></i><i class="fa fa-circle"></i><i class="fa fa-circle"></i>
							<div class="booking-view-dropdown">
								<ul>
									<li><a href="#"><i class="fa fa-eye"></i> View</a></li>
									<li><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
									<li><a href="#"><i class="fa fa-trash-o"></i> Remove</a></li>
								</ul>
		          </div>
						</li>
					</ul>
				</div>

				<div class="booking-table-row">
					<ul>
						<li class="booking-user">
							<img src="{{ asset('images/user.jpg') }}" alt="">
							<h3>Damon Zappariello</h3>
						</li>
						<li class="booking-code">IBH4605</li>
						<li class="booking-timing">5 Jan 2020, 9:40AM</li>
						<li class="booking-member">
							<img src="{{ asset('images/user.jpg') }}" alt="">
							<h4>Sandra</h4>
						</li>
						<li class="booking-view-more">
							<i class="fa fa-circle"></i><i class="fa fa-circle"></i><i class="fa fa-circle"></i>
						</li>
					</ul>
				</div>
			</div>

		
			<div class="newly-register-sec">
				
				<div class="customer-register wdth-100">
					<h2>Newly Registered Customers<span>List of today's registered customers</span></h2>
					<div class="newly-register-box">
						<ul id="about_txt_scroll" class="mCustomScrollbar">
						
							<li>
								<div class="register-user max-wdth-n">
									<article class="max-wdth-n">
										<p>No customer registered today</p>
									</article>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
	

			
			<div class="newly-register-sec">
				
				<div class="vendor-register wdth-49">
					<h2>Newly Registered Vendors<span>List of today's registered vendors</span></h2>
					<div class="newly-register-box">
						<ul id="about_txt_scroll" class="mCustomScrollbar">
							<li>
								<article>
									<p>No vendor registered today</p>
								</article>
							</li>
						</ul>
					</div>
				</div>

				
				<div class="vendor-register wdth-49">
					<h2>Newly Registered Mobile Professional<span>List of today's registered mobile professional</span></h2>
					<div class="newly-register-box">
						<ul id="about_txt_scroll" class="mCustomScrollbar">
							<li>
								<article>
									<p>No mobile professional registered today</p>
								</article>
							</li>
						</ul>
					</div>
				</div>
			</div>

		</div>

		<div class="col-lg-4">
		
		<div class="overview-sec">
			<h2>Overview <span>THIS MONTH</span></h2>
			<ul>
				<li class="overview-yellow-box">
					<a href="#"><img src="{{ asset('images/overview-icon1.png') }}" alt="">
					<h3 class="counter">10,555</h3>
					<p>Completed <br/>Bookings</p></a>
				</li>
				<li class="overview-blue-box">
					<a href="#"><img src="{{ asset('images/overview-icon2.png') }}" alt="">
					<h3 class="counter">555</h3>
					<p>Cancelled <br/>Bookings</p></a>
				</li>
				<li class="overview-pink-box">
					<a href="#"><img src="{{ asset('images/overview-icon3.png') }}" alt="">
					<h3 class="counter">334</h3>
					<p>New Client <br/>Registered</p></a>
				</li>
				<li class="overview-gray-box">
					<a href="#"><img src="{{ asset('images/overview-icon4.png') }}" alt="">
					<h3 class="counter">97</h3>
					<p>Pending <br/>Bookings</p></a>
				</li>
			</ul>
		</div>

		
		<div class="sales-management-sec">
			<h2>Sales Management <span>THIS MONTH</span></h2>
			<div class="sales-management-quote">
				<p>Remember to always check out appointments to get most of the reports.</p>
			</div>
			<div class="sales-management-graph">
				<img src="{{ asset('images/sales-management-graph.png') }}" alt="">
			</div>
		</div>

		
		<div class="top-sale-sec">
			<div class="sale-mobile-srvc">
				<h2>Top sales by mobile service <span>THIS MONTH</span></h2>
				<ul id="about_txt_scroll" class="mCustomScrollbar">
					<li>
						<div class="top-sale-user">
							<div class="top-sale-count">1</div>
							<h3>SALENA GOMEZ</h3>
						</div>
						<div class="top-sale-price">
							<h4>&euro; 450</h4>
						</div>
					</li>
					<li>
						<div class="top-sale-user">
							<div class="top-sale-count">2</div>
							<h3>SALENA GOMEZ</h3>
						</div>
						<div class="top-sale-price">
							<h4>&euro; 450</h4>
						</div>
					</li>
					<li>
						<div class="top-sale-user">
							<div class="top-sale-count">3</div>
							<h3>SALENA GOMEZ</h3>
						</div>
						<div class="top-sale-price">
							<h4>&euro; 450</h4>
						</div>
					</li>
					<li>
						<div class="top-sale-user">
							<div class="top-sale-count">4</div>
							<h3>SALENA GOMEZ</h3>
						</div>
						<div class="top-sale-price">
							<h4>&euro; 450</h4>
						</div>
					</li>
					<li>
						<div class="top-sale-user">
							<div class="top-sale-count">5</div>
							<h3>SALENA GOMEZ</h3>
						</div>
						<div class="top-sale-price">
							<h4>&euro; 450</h4>
						</div>
					</li>
				</ul>
			</div>
		</div>

		
		<div class="top-sale-sec">
			<div class="sale-store-owners">
				<h2>Top Sales by store owners <span>THIS MONTH</span></h2>
				<ul id="about_txt_scroll" class="mCustomScrollbar">
					<li>
						<div class="top-sale-user">
							<div class="top-sale-count">1</div>
							<h3>SALENA GOMEZ</h3>
						</div>
						<div class="top-sale-price">
							<h4>&euro; 450</h4>
						</div>
					</li>
					<li>
						<div class="top-sale-user">
							<div class="top-sale-count">2</div>
							<h3>SALENA GOMEZ</h3>
						</div>
						<div class="top-sale-price">
							<h4>&euro; 450</h4>
						</div>
					</li>
					<li>
						<div class="top-sale-user">
							<div class="top-sale-count">3</div>
							<h3>SALENA GOMEZ</h3>
						</div>
						<div class="top-sale-price">
							<h4>&euro; 450</h4>
						</div>
					</li>
					<li>
						<div class="top-sale-user">
							<div class="top-sale-count">4</div>
							<h3>SALENA GOMEZ</h3>
						</div>
						<div class="top-sale-price">
							<h4>&euro; 450</h4>
						</div>
					</li>
					<li>
						<div class="top-sale-user">
							<div class="top-sale-count">5</div>
							<h3>SALENA GOMEZ</h3>
						</div>
						<div class="top-sale-price">
							<h4>&euro; 450</h4>
						</div>
					</li>
				</ul>
			</div>
		</div>

		</div>

	</div> -->
	No data
</div>
@stop