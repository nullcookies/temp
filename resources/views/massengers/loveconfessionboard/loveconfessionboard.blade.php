@extends('massengers/layout/layout')

@section('js')
    @if($errors->has('reply_name'))
        <script>
            swal('enter your name first','','error');
        </script>
    @endif
    
    @if($errors->has('reply_message'))
        <script>
            swal('enter your reply message','','error');
        </script>
    @endif
    
    @if(Session::has('replyerror'))
        <script>
            swal('please try again','','error');
        </script>
    @endif
    
    @if(Session::has('replysuccess'))
        <script>
            swal('Reply successfully Saved','','success');
        </script>
    @endif


	<script type="text/javascript">
		$(document).ready(function(){
			$('#love_confession_board_form').on('submit', function(event){
				event.preventDefault();
				var formData = $(this).serialize();
				$.ajax({
					url: "{{url('/saveloveconfession')}}",
					type: 'POST',
					dataType: 'json',
					data: formData,
					beforeSend: function(){
						swal({
						  title: 'Processing..',
						  text: 'please do not referesh the page',
						  showCancelButton: false,
						  showConfirmButton: false
						});
					},
					success: function(result){
							if(result['get_redirect'] == 'no'){
							    swal('saved successfully');
		                        location.reload();
		                    }else{
		                        window.location.href = result['redirect_url'];
		                    }
					},
					error: function(data){
						errorsHtml = '';
						keyval = '';
						$.each(data.responseJSON, function(key, value) {
						    keyval = key;
							if($.isArray(value)){
								errorsHtml += value[0];
							}else{
								errorsHtml += value;
							}
							return false;
			            });
						swal(errorsHtml, '', 'error');
						
						if(keyval == 'login'){
						    window.location.href = "{{url('/login')}}";
						}
					}
				});
			});
		});

		function savereply(object, event){
		    event.preventDefault();
		}
		
		
		function likeconfession(confessionid){
		    $.ajax({
					url: "{{url('/getlike')}}",
					type: 'POST',
					dataType: 'json',
					data: {confessionid:confessionid},
					beforeSend: function(){
						swal({
						  title: 'Processing..',
						  text: 'please do not referesh the page',
						  showCancelButton: false,
						  showConfirmButton: false
						});
					},
					success: function(result){
		                    if(result['get_redirect'] == 'no'){
		                        location.reload();
		                    }else{
		                        window.location.href = result['redirect_url'];
		                    }
							
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
					}
				});
		}
	</script>
@endsection

@section('content')
<a href="javascript:;" class="confession-banner" title="Confess Your Love" data-toggle="modal" data-target="#myModallcb">
    <img src="{{asset('massengers/img/lcb-banner.jpg')}}" style="margin:0 auto;" class="img-responsive">
</a>	
<div class="container-fluid mobpd10 pd-30">
	<div class="container">
		<ol class="breadcrumb ms-breadcrumb">
		<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
			<li class="breadcrumb-item active" >Love Confession Board</li>
		</ol>
	</div>
</div>
<div class="container-fluid pd-20">
	<div class="container lcb-heading">
	    <div class="row-800">
		    <div class="strike"><span><h1>Confession</h1></span></div>
		</div>    
		<!-- Trigger the modal with a button -->
<!-- Modal -->
<div id="myModallcb" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title center c-red">Make Confession</h3>
      </div>
      <div class="modal-body">
        <form id="love_confession_board_form" class="form-horizontal lcb-form">
            <input type="hidden" name="login" value="{{Auth::user()? 'loggedin' : ''}}" />
				<div class="form-group">
					<label class="control-label col-sm-4" for="email">Confessor:</label>
					<div class="col-sm-8">
					<input type="text" name="confessor" class="form-control" id="email">
					</div>
				</div>
				<!--<div class="form-group">
					<label class="control-label col-sm-4" for="email">What's its about:</label>
					<div class="col-sm-8">
					<input type="text" name="what_is_its_about" class="form-control" id="email">
					</div>
				</div>-->
				<div class="form-group">
					<label class="control-label col-sm-4" for="email">Your Message:</label>
					<div class="col-sm-8">
					<textarea class="form-control" name="message" rows="4" style="resize:none;"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4" for="email">Confessing to:</label>
					<div class="col-sm-8">
					<input type="text" name="confessing_to" class="form-control" id="email">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4" for="email">Mobile</label>
					<div class="col-sm-8">
					<input type="number" name="mobile_number" placeholder="Enter mobile number of whom you are going to do confession" class="form-control" id="mobile">
					</div>
				</div>
				<div class="form-group"> 
					<center>
						<div class="checkbox">
							<label><input name="confess_anonymously" type="checkbox"> Confess Anonymously</label>
						</div>
					</center>
				</div>
			  </div>
			  <div class="form-group"> 
				<center>
				  <button type="submit" class="lcb-sumbit">Submit</button>
				</center>
			  </div>
			</form>
			<div class="center mb-15">
			<button data-toggle="collapse" data-target="#lcb-abusive" class="lcb-abusive">Abusive policy</button>
				<div id="lcb-abusive" class="collapse">
					<p class="apd-15">Every massengers.com customer agrees to comply with our all the terms and conditions listed on our terms and conditions homepage. We take the enforcement of all terms and conditions seriously, and we aim to run a clean network which operates on fair principles. We also investigate all reports of abuse. If you encounter something you think might constitute abuse (for example, spam or inappropriate content) which you believe has come from our network or systems, please read through the information on this page carefully. It explains how you can report it.</p>
				</div>
			</div>	
      </div>
    </div>

  </div>
</div>
	</div>
</div>

<div class="infinite-scroll-confession">
@foreach($confessions as $confession)

<?php $key = $confessions->currentPage() -1; ?>
<div class="container-fluid pd-20 @if($key % 2 != 0) bg-black black-cont @endif">
	<div class="container">
		<div class="row row-800 @if($key % 2 != 0) c-white @endif">
			<div class="col-md-3">
				<center>
					<img src="{{$profile_image[$confession->user_id]}}" width="150" height="150" class="img-circle" draggable="false" style="margin-top:20px;"/>
					<!--<i class="fa fa-user" style="font-size:132px;"></i>-->
				</center>
			</div>
			<div class="col-md-9 lcb-content">
				<h1><!--<i class="fa fa-quote-left quote"></i>--><img @if($key % 2 != 0) src="{{asset('massengers/img/comma1white.png')}}" @else src="{{asset('massengers/img/comma1.png')}}" @endif >&nbsp;&nbsp;{{$confession->confessing_to}}</h1>
				<p class="monlight">
				{!! $confession->message !!}&nbsp;&nbsp;<img @if($key % 2 != 0) src="{{asset('massengers/img/comma2white.png')}}" @else src="{{asset('massengers/img/comma2.png')}}" @endif >
				</p>
				<p class="author">by {{$confession->confess_anonymously == 'yes' ? 'Anonymous user' : $confession->confessor}} - {{Carbon\Carbon::parse($confession->created_at)->format('D d-m-Y')}}</p>
				 <ul class="share-icon @if($key % 2 != 0) white-icon @endif">
					<li><a href="javascript:;" onclick="likeconfession({{$confession->id}})" title="Like"><i class="fa fa-thumbs-o-up"></i></a>&nbsp;&nbsp;<span class="@if($key % 2 != 0) c-white @else c-red @endif">{{$count_likes[$confession->id]}}</span></li>
					<li><a href="javascript:;" title="Reply" id="confess-reply"><i class="fa fa-reply"></i></a>&nbsp;&nbsp;<span class=" @if($key % 2 != 0) c-white @else c-red @endif">{{$count_reply[$confession->id]}}</span></li>
					{!! Share::currentPage()->facebook() !!}
				</ul> 
			</div>
			<div class="row confess-reply-form col-md-12">
			    <div class="col-md-offset-3 col-md-9">
			        @if(Auth::user())
    			    <form action="{{url('/replyconfession')}}" method="post" class="confession-reply-form">
    			        {{csrf_field()}}
    			        <input type="hidden" name="login" value="{{Auth::user()? 'loggedin' : ''}}" />
    			        <input name="lc_id" type="hidden" value="{{$confession->id}}" />
                          <div class="form-group">
                            <input type="text" class="form-control" id="confessor-name" name="reply_name" placeholder="Enter Your Name">
                          </div>
                          <div class="form-group">
                            <textarea class="form-control" name="reply_message" rows="3" placeholder="Enter Your Reply"></textarea>
                          </div>
                          <button type="submit" class="btn read-more2" title="Submit">Submit</button>
                    </form>
                    @else
                        <p style="padding-left:15px;">You have to <a title="Login" href="{{url('/login')}}">login</a> first to comment or like</p>    
                    @endif
    		    </div>       
			</div>
			<div class="infinite-scroll-confession-reply">
			@foreach($replies[$confession->id] as $reply)
			<div class="col-md-9 col-md-offset-3">
    		    <div class="col-md-2 pd-0">
					<img src="{{asset('massengers/img/confessor.png')}}" width="70" height="70" class="img-circle"/>
    			</div>
    			<div class="col-md-10 mobpd0 lcb-content lcb-reply">
    				<h4>{!! $reply->name !!}</h4>
    				<p class="monlight">
    				{!! $reply->reply !!}
    				</p>
    			</div>
			</div>
			@endforeach
		    
			<?php $nextpage = $replies[$confession->id]->currentPage() +1; ?>
			    <div class="row">
			        <!--<a href="{{url('/fetchconfessionreply/'.$confession->id.'?page='.$nextpage)}}" class="view-more-confession">View More Comments</a>-->
			        @if(count($replies[$confession->id]))
			            {!! $replies[$confession->id]->render() !!}
			        @endif
			    </div>
			</div>
		</div>
	</div>
</div>

@endforeach
    
    {!! $confessions->render()  !!}
    <?php $nextpage = $confessions->currentPage() +1; ?>
    <!--<div class="container">
        <a href="{{url('/fetchconfessionjscroll?page=').$nextpage}}" class="view-more-confession">View More Confessions</a>
    </div>-->
</div>
@endsection