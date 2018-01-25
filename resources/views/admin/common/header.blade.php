<!-- Header -->

<?php 

$dashboard = new App\Http\Controllers\Admin\Homepage\DashboardController;
$data = $dashboard->getTrial();

?>

<div class="site-header">
    
	<nav class="navbar navbar-light">
		<div class="navbar-left">
			<a class="navbar-brand" href="{{url('/'.ADMIN_URL_PATH)}}">
				<span class="text-white">{{PROJECT_NAME}}</span>
			</a>
			<div class="toggle-button dark sidebar-toggle-first float-xs-left hidden-md-up">
				<span class="hamburger"></span>
			</div>
			<div class="toggle-button-second dark float-xs-right hidden-md-up">
				<i class="ti-arrow-left"></i>
			</div>
			<div class="toggle-button dark float-xs-right hidden-md-up" data-toggle="collapse" data-target="#collapse-1">
				<span class="more"></span>
			</div>
		</div>
		<div class="navbar-right navbar-toggleable-sm collapse" id="collapse-1">
		
			<ul class="nav navbar-nav float-md-right">
			    @if($data['trial'])
					<li class="nav-item dropdown hidden-sm-down">
						<div class="chart-easy chart-easy-sm" id="chart-easy" data-percent="{{$data['perc']}}"><span>{{$data['trialDiff']}}</span></div>
						<p class="daysleft">{{$data['text']}}</p>
						<button style="cursor:pointer;" class="subnow-btn" onclick="window.location.href = 'http://www.techturtle.in/selection_theme/package_pricing.php'">Subscribe Now</button>
					</li>
				@endif
			
				<li class="nav-item dropdown" id="notificationNav">
					<a class="nav-link" href="javascript:;" data-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-bell"></i>
						<span class="hidden-md-up ml-1">Tasks</span>
						<span class="tag tag-success top">{{DB::table('notification')->count()}}</span>
					</a>
					<div class="dropdown-tasks dropdown-menu dropdown-menu-right animated fadeInUp">
						<?php $notifications = DB::table('notification')->orderBy('created_at','desc')->paginate(5) ?>
						
						@foreach($notifications as $notification)
						<div class="t-item">
							<div class="mb-0-5">
								<a class="text-black" href="javascript:;"><strong>{{substr($notification->title, 0, 30)}}</strong></a>
								<span class="float-xs-right text-muted">{{$notification->type}}</span>
							</div>
							<p>
								{!! substr($notification->content, 0,100) !!}
							</p>
							<span class="text-muted">{{date_format(date_create($notification->created_at), 'D d-m-Y H:i')}}</span>
						</div>
						@endforeach
						
						<a class="dropdown-more" href="{{url('/admin/notices')}}">
							<strong>View all Notifications</strong>
						</a>
					</div>
				</li>
				<li class="nav-item dropdown hidden-sm-down">
					<a href="#" data-toggle="dropdown" aria-expanded="true">
						<span class="avatar box-32">
							<img src="{{url('/images/user_male.png')}}" alt="">
						</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right animated fadeInUp">
						<a class="dropdown-item" href="{{url('/logout')}}"><i class="ti-power-off mr-0-5"></i> Sign out</a>
					</div>
				</li>
			</ul>
			
			<div class="header-form float-md-left ml-md-2">
				{!! Form::open(array('method' => 'get', 'action' => ['Admin\Orders\OrdersController@trackOrderRequest'])) !!}
					<input type="text" name="oid" class="form-control b-a" placeholder="Search for...">
					<button type="submit" class="btn bg-white b-a-0">
						<i class="ti-search"></i>
					</button>
				{!! Form::close() !!}
			</div>
		</div>
	</nav>
</div>