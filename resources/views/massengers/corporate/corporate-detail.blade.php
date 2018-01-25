@extends('massengers/layout/layout')

@section('content')
<div class="container-fluid pd-50">
	<div class="container">
		<div class="well">
			<h3>Vanilla Fruit Cake &amp; Raspberry Fruit Wine</h3>
		</div>
		<div class="col-md-7">
			<div class="col-md-8 corp-pdt-box">
				<img src="{{asset('massengers/img/cake1.png')}}" id="myImage"/>
			</div>
			<div class="col-md-4 corp-pdt-img">
				<ul>
					<li>
						<a href="javascript:;" onclick="document.getElementById('myImage').src='massengers/img/cake1.png'"><img src="{{asset('massengers/img/cake1.png')}}"/></a>
					</li>
					<li>
						<a href="javascript:;" onclick="document.getElementById('myImage').src='massengers/img/cake1.png'"><img src="{{asset('massengers/img/cake1.png')}}"/></a>
					</li>
					<li>
						<a href="javascript:;" onclick="document.getElementById('myImage').src='massengers/img/cake1.png'"><img src="{{asset('massengers/img/cake1.png')}}"/></a>
					</li>
					<li>
						<a href="javascript:;" onclick="document.getElementById('myImage').src='massengers/img/cake1.png'"><img src="{{asset('massengers/img/cake1.png')}}"/></a>
					</li>
				</ul>	
			</div>
		</div>
		<div class="col-md-5">
			<h3 class="c-black myriad">Vanilla Fruit Cake &amp; Raspberry Fruit Wine</h3>
			<form class="corporate-form">
				<div class="form-group">
					<label for="name"><i class="fa fa-user"></i> Name</label>
					<input type="text" class="fcc" id="name">
				</div>
				<div class="form-group">
					<label for="number"><i class="fa fa-mobile"></i> Number:</label>
					<input type="text" class="fcc" id="number">
				</div>
				<div class="form-group">
					<label for="email"><i class="fa fa-envelope-o"></i> Email:</label>
					<input type="text" class="fcc" id="email">
				</div>
				<div class="form-group">
					<label for="quantity"><i class="fa fa-sort-amount-asc"></i> Quantity:</label>
					<input type="number" min="0" class="fcc" id="quantity">
				</div>
				<div class="form-group">
					<label for="companyname"><i class="fa fa-building"></i> Company Name:</label>
					<input type="text" class="fcc" id="companyname">
				</div>
				<button type="submit" class="pay-btn">Submit</button>
			</form>
		</div>
	</div>
</div>
@endsection