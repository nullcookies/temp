<script type="text/javascript">
    $(function() {
        $('ul.pagination').hide();
        $('.infinite-scroll-confession-reply').jscroll({
           autoTrigger: true,
            loadingHtml: "<div class='fullwidth text-center'><i class='fa fa-circle-o-notch fa-spin load' style='font-size:30px;color:#D80003;margin-top:15px;'></i> </div>",
            padding: 20,
            debug: true,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.infinite-scroll',
            callback: function() {
                $('ul.pagination').remove();
            }
        });
    });
</script>

@foreach($confessions as $confession)

<?php $key = $confessions->currentPage() -1; ?>
<div class="container-fluid pd-20 @if($key % 2 != 0) bg-black black-cont @endif">
	<div class="container">
		<div class="row row-800 @if($key % 2 != 0) c-white @endif">
			<div class="col-md-3">
				<center>
					<img src="{{asset('massengers/img/confessor.png')}}" width="150" height="150" class="img-circle" draggable="false" style="margin-top:20px;"/>
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
                        <span>You have to login first to comment or like</span>    
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

<?php $nextpage = $confessions->currentPage() +1; ?>

@if(count($confessions))
    <!--<a href="{{url('/fetchconfessionjscroll?page=').$nextpage}}">View More Confessions</a>-->
    <div class="container">
        <a href="{{url('/fetchconfessionjscroll?page=').$nextpage}}" class="view-more-confession">View More Confessions</a>
    </div>
@endif