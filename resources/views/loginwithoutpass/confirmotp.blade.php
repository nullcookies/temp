@extends('massengers/layout/layout')

@section('js')

<script>
    function resendotp(email){
        $.ajax({
           url: "{{url('/sendotp')}}" ,
           type: 'post',
           data: {email:email},
           dataType: 'json',
           beforeSend: function(){
               swal({
						  title: 'Processing..',
						  text: 'please do not referesh the page',
						  showCancelButton: false,
						  showConfirmButton: false
						});
           },
           success: function(result){
               swal('Otp send successfully');
           },
           error: function(data){
            errorsHtml = '';
			$.each(data.responseJSON, function(key, value) {
				if($.isArray(value)){
					errorsHtml += value[0];
				}else{
					errorsHtml += value;
				}
				return false;
            });
			swal(errorsHtml, '', 'error');  
           },
        });
    }
    
    
    
    
    $(document).ready(function(){
        $('#otpform').on('submit', function(event){
            event.preventDefault();
            var formdata = $(this).serialize();
            $.ajax({
               url: "{{url('/confirm-otp')}}" ,
               type: 'post',
               data: formdata,
               dataType: 'json',
               beforeSend: function(){
                   swal({
    						  title: 'Processing..',
    						  text: 'please do not referesh the page',
    						  showCancelButton: false,
    						  showConfirmButton: false
    						});
               },
               success: function(result){
                   swal('Otp successfully verified');
                   location.reload();
               },
               error: function(data){
                errorsHtml = '';
    			$.each(data.responseJSON, function(key, value) {
    				if($.isArray(value)){
    					errorsHtml += value[0];
    				}else{
    					errorsHtml += value;
    				}
    				return false;
                });
    			swal(errorsHtml, '', 'error');  
               },
            });
        });
        
    });
</script>

@endsection

@section('content')

<div class="container-fluid">
	<div class="container center segoe">
		<img src="{{asset('massengers/img/login-flowers.jpg')}}" class="img-responsive center-block">
		<h3 class="caps text-left">Welcome to Massengers</h3>
		<!--<div class="mass-border"></div>-->
	</div>
</div>
<div class="container-fluid pd-40">
	<div class="container"> 
		<div class="col-sm-5 col-md-5 login bg-f9f9f9">
				<div class="row mt-60">
				<div class="col-sm-6"><a href="{{ route('social.redirect', ['provider' => 'google']) }}" title="Login With Google"><img src="{{asset('massengers/img/g+.png')}}" width="150"></a></div>
				<div class="col-sm-6"><a href="{{ route('social.redirect', ['provider' => 'facebook']) }}" title="Login With Facebook"><img src="{{asset('massengers/img/fb.png')}}" width="150"></a></div>
				</div>
		</div>
		<div class="col-sm-2"></div>
		<div class="col-sm-5 col-md-5 step4 bg-f9f9f9">
			<p class="center">Please Enter verification code (OTP) sent to: {{Session::get('otpemail')}} {{strlen(Session::get('otpmobile')) ? '
			&' : ''}} {{Session::get('otpmobile')}} </p>
			<form id="otpform">
			    {{csrf_field()}}
				<div class="form-group">
				    <input type="hidden" required="required" name="email" value="{{Session::get('otpemail')}}" />
					<input type="text" id="emailid" name="otp" class="form-control center" placeholder="Enter Code">
				</div>
				<a href="javascript:;" style="margin-bottom:10px;" onclick="resendotp('{{Session::get('email')}}')" title="Resend OTP">Resend OTP</a>
				<center>
				<button type="submit" class="btn btn-default" title="Continue">Continue</button>
				</center>
			</form>
		</div>
	</div>
</div>	

@endsection