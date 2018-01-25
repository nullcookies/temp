@extends('massengers/layout/layout')

@section('content')

<div class="container-fluid fof-main">
	<div class="container">
		<span class="fof">404</span>
		<h2>Oops, sorry we can&#39;t find that page !</h2>
		<h5>Either something went wrong or the page dosn&#39;t exist anymore.</h5>
		<br/>
		<br/>
		<a href="{{url('/')}}" class="home-page">Home Page</a>
	</div>
</div>
	
@endsection