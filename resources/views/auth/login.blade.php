@extends('massengers/layout/layout')

@section('js')
    
@endsection

@section('content')

<div class="container-fluid">
	<div class="container center segoe massengers-login">
		<img src="{{asset('massengers/img/login-flowers.jpg')}}" class="img-responsive center-block">
		<h3>Welcome to our online store!</h3>
		<h2 class="caps">login or create an account</h2>
		<!--<div class="mass-border"></div>-->
	</div>
</div>
<div class="container-fluid pd-40">
	<div class="container"> 
		<div class="col-sm-5 col-md-5 login bg-f9f9f9">
			<form action="{{url('/login')}}" method="post">
			    {{csrf_field()}}
				<h3>Login</h3>
				<div class="form-group">
					<input type="email" name="email" required="required" class="form-control" placeholder="Email Address">
					@if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
				</div>	
				<div class="form-group">
					<input type="password" name="password" required="required" class="form-control" placeholder="Password">
					@if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
				</div>
				<a href="{{asset('/loginwithoutpassword')}}" class="forgot-pass" title="Forgot Your Password">Forgot Your Password?</a>
				<center>
			    	<button type="submit" class="btn btn-default" title="Sign in">Sign in</button>
				</center>
			</form>
				<p class="center">or</p>
				<div class="row pdl-8">
				<div class="col-sm-6 mobmb-10"><a href="{{ route('social.redirect', ['provider' => 'google']) }}" title="Login with Google"><img src="{{asset('massengers/img/g+.png')}}" width="150"></a></div>
				<div class="col-sm-6 mobmb-10"><a href="{{ route('social.redirect', ['provider' => 'facebook']) }}" title="Login with Facebook"><img src="{{asset('massengers/img/fb.png')}}" width="150"></a></div>
				</div>
		</div>
		<div class="col-sm-2"></div>
		<div class="col-sm-5 col-md-5 signup bg-f9f9f9">
			<h3>Sign Up</h3>
			<form action="{{url('/customregisteruser')}}"  method="post">
			    {{csrf_field()}}
				<div class="form-group">
					<input type="text" name="name" required="required" class="form-control" placeholder="Name">
					@if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
				</div>
				<div class="form-group">
					<input type="email" name="email" required="required" class="form-control" placeholder="Email Address">
					@if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
				</div>	
				<div class="form-group">
					<input type="password" required="required" name="password" class="form-control" placeholder="Password">
					@if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
				</div>
				<div class="form-group">
					<input type="password" required="required" name="password_confirmation" class="form-control" placeholder="Repeat Password">
					@if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
				</div>
				<center>
				    <button type="submit" class="btn btn-default" title="Submit">Submit</button>
    			</center>
			</form>
		</div>
	</div>
</div>

@endsection