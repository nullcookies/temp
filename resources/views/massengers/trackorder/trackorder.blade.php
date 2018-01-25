@extends('massengers/layout/layout')

@section('js')

    <script>
        
        $(document).ready(function(){
            $('#trackorderform').on('submit', function(event){
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
					url: "{{url('/trackorder')}}",
					type: 'POST',
					dataType: 'html',
					data: form_data,
					beforeSend: function(){
						
					},
					success: function(result){
						$('#trackresult').html(result);
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
						
					}
				});
            });
        });
    </script>
@endsection

@section('content')
	
<div class="container-fluid pd-30 aboutuscrumb">
	<div class="container">
		<ol class="breadcrumb ms-breadcrumb">
		  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
		  <li class="breadcrumb-item active"><a>Track Order</a></li>
		</ol>
	</div>
</div>
<div class="container-fluid">
    <form method="post" id="trackorderform">
    <div class="container trackall pdb-50">
        <!--<h2 class="rob-reg bold">Track Order</h2>-->
        <div class="col-md-12 trackit mobpd0 roboto-light">
            <div class="col-md-6 tabm10">
                <div class="form-group">
                    <label class="control-label col-sm-3" for="orderid-track">Order Id*</label>
                    <div class="col-sm-9">
                      <input name="orderid" type="text" class="form-control" id="orderid-track">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-sm-3" for="emailid-track">Email Id*</label>
                    <div class="col-sm-9">
                      <input name="email" type="text" class="form-control" id="emailid-track"> 
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mobpd0 deskmar-50 pd-20">
            <center><button type="submit" class="btn btn-default btn-track2" title="Track Order">Track Order</button></center>
            <div id="trackresult" class="col-md-12 mobpd0 center">
        
            </div>
        </div>
    </div>
    </form>
    <div class="container trackall pdb-50">
        
    </div>
</div>

<!--<div class="container-fluid tracker">
	<div class="container">
		<div class="col-sm-6 track-order">
			<h2 class="center c-red">Track Order</h2>
			<p class="center">Track all your orders by entering your order id or by your registered email address</p>
			<br/>
			<form class="trackform">
				<div class="form-group">
					<input type="text" placeholder="Order ID" class="form-control">
				</div>
				<h2 class="center or">OR</h2>
				<div class="form-group">
					<input type="text" placeholder="Email/Mobile Number" class="form-control">
				</div>
				<div class="form-group center">
					<button type="button" class="btn btn-track">Track Order</button>
				</div>
			</form>
		</div>
		<div class="col-sm-6 center roboto delivery-box">
			<img src="{{asset('massengers/img/delivery-truck.png')}}">
			<h3 class="c-red">Massengers Delivery</h3>
			<h4 class="c-red"><i class="fa fa-phone"></i> <a href="tel:+91-9582212488">+91-9582212488</a></h4>
			<h4 class="c-red"><i class="fa fa-mail"></i> <a href="mailto:info@massengers.com">info@massengers.com</a></h4>
		</div>
	</div>
</div>-->


@endsection