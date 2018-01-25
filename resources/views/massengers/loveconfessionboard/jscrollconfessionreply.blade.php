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


@foreach($replies as $reply)
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

<?php $nextpage = $replies->currentPage() +1; ?>
<a href="{{url('/fetchconfessionreply/'.$confessionid.'?page='.$nextpage)}}">next page</a>