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

<?php foreach($confessions as $confession): ?>

<?php $key = $confessions->currentPage() -1; ?>
<div class="container-fluid pd-20 <?php if($key % 2 != 0): ?> bg-black black-cont <?php endif; ?>">
	<div class="container">
		<div class="row row-800 <?php if($key % 2 != 0): ?> c-white <?php endif; ?>">
			<div class="col-md-3">
				<center>
					<img src="<?php echo e(asset('massengers/img/confessor.png')); ?>" width="150" height="150" class="img-circle" draggable="false" style="margin-top:20px;"/>
					<!--<i class="fa fa-user" style="font-size:132px;"></i>-->
				</center>
			</div>
			<div class="col-md-9 lcb-content">
				<h1><!--<i class="fa fa-quote-left quote"></i>--><img <?php if($key % 2 != 0): ?> src="<?php echo e(asset('massengers/img/comma1white.png')); ?>" <?php else: ?> src="<?php echo e(asset('massengers/img/comma1.png')); ?>" <?php endif; ?> >&nbsp;&nbsp;<?php echo e($confession->confessing_to); ?></h1>
				<p class="monlight">
				<?php echo $confession->message; ?>&nbsp;&nbsp;<img <?php if($key % 2 != 0): ?> src="<?php echo e(asset('massengers/img/comma2white.png')); ?>" <?php else: ?> src="<?php echo e(asset('massengers/img/comma2.png')); ?>" <?php endif; ?> >
				</p>
				<p class="author">by <?php echo e($confession->confess_anonymously == 'yes' ? 'Anonymous user' : $confession->confessor); ?> - <?php echo e(Carbon\Carbon::parse($confession->created_at)->format('D d-m-Y')); ?></p>
				 <ul class="share-icon <?php if($key % 2 != 0): ?> white-icon <?php endif; ?>">
					<li><a href="javascript:;" onclick="likeconfession(<?php echo e($confession->id); ?>)" title="Like"><i class="fa fa-thumbs-o-up"></i></a>&nbsp;&nbsp;<span class="<?php if($key % 2 != 0): ?> c-white <?php else: ?> c-red <?php endif; ?>"><?php echo e($count_likes[$confession->id]); ?></span></li>
					<li><a href="javascript:;" title="Reply" id="confess-reply"><i class="fa fa-reply"></i></a>&nbsp;&nbsp;<span class=" <?php if($key % 2 != 0): ?> c-white <?php else: ?> c-red <?php endif; ?>"><?php echo e($count_reply[$confession->id]); ?></span></li>
					<?php echo Share::currentPage()->facebook(); ?>

				</ul> 
			</div>
			
			<div class="row confess-reply-form col-md-12">
			    <div class="col-md-offset-3 col-md-9">
			        <?php if(Auth::user()): ?>
    			    <form action="<?php echo e(url('/replyconfession')); ?>" method="post" class="confession-reply-form">
    			        <?php echo e(csrf_field()); ?>

    			        <input type="hidden" name="login" value="<?php echo e(Auth::user()? 'loggedin' : ''); ?>" />
    			        <input name="lc_id" type="hidden" value="<?php echo e($confession->id); ?>" />
                          <div class="form-group">
                            <input type="text" class="form-control" id="confessor-name" name="reply_name" placeholder="Enter Your Name">
                          </div>
                          <div class="form-group">
                            <textarea class="form-control" name="reply_message" rows="3" placeholder="Enter Your Reply"></textarea>
                          </div>
                          <button type="submit" class="btn read-more2" title="Submit">Submit</button>
                    </form>
                    <?php else: ?>
                        <span>You have to login first to comment or like</span>    
                    <?php endif; ?>
    		    </div>       
			</div>
			

			<div class="infinite-scroll-confession-reply">
			<?php foreach($replies[$confession->id] as $reply): ?>
			<div class="col-md-9 col-md-offset-3">
    		    <div class="col-md-2 pd-0">
					<img src="<?php echo e(asset('massengers/img/confessor.png')); ?>" width="70" height="70" class="img-circle"/>
    			</div>
    			<div class="col-md-10 mobpd0 lcb-content lcb-reply">
    				<h4><?php echo $reply->name; ?></h4>
    				<p class="monlight">
    				<?php echo $reply->reply; ?>

    				</p>
    			</div>
			</div>
			<?php endforeach; ?>
			
			<?php $nextpage = $replies[$confession->id]->currentPage() +1; ?>
			    <div class="row">
			        <!--<a href="<?php echo e(url('/fetchconfessionreply/'.$confession->id.'?page='.$nextpage)); ?>" class="view-more-confession">View More Comments</a>-->
			        <?php if(count($replies[$confession->id])): ?>
			            <?php echo $replies[$confession->id]->render(); ?>

			        <?php endif; ?>
			    </div>
			</div>
			
		</div>
	</div>
</div>

<?php endforeach; ?>

<?php $nextpage = $confessions->currentPage() +1; ?>

<?php if(count($confessions)): ?>
    <!--<a href="<?php echo e(url('/fetchconfessionjscroll?page=').$nextpage); ?>">View More Confessions</a>-->
    <div class="container">
        <a href="<?php echo e(url('/fetchconfessionjscroll?page=').$nextpage); ?>" class="view-more-confession">View More Confessions</a>
    </div>
<?php endif; ?>