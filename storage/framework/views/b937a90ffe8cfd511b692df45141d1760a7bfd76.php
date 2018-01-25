<?php $__env->startSection('js'); ?>
	<script type="text/javascript">
		
		$(document).ready(function(){
			$('#love_confession_board_form').on('submit', function(event){
				event.preventDefault();
				var formData = $(this).serialize();
				$.ajax({
					url: "<?php echo e(url('/saveloveconfession')); ?>",
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
							swal('saved successfully');
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
					}
				});
			});
		});
	</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row-mine">
</div>	
<div class="container-fluid pd-20">
	<div class="container lcb-heading">
		<h1>Confession</h1>
		<h4 class="center">
			Have a Confession ? &nbsp;&nbsp;<a href="#" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModallcb">Make Confession</a>
		</h4>
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
				<div class="form-group">
					<label class="control-label col-sm-4" for="email">Confessor:</label>
					<div class="col-sm-8">
					<input type="text" name="confessor" class="form-control" id="email">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4" for="email">What's its about:</label>
					<div class="col-sm-8">
					<input type="text" name="what_is_its_about" class="form-control" id="email">
					</div>
				</div>
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
			<button data-toggle="collapse" data-target="#demo" class="lcb-abusive">Abusive policy</button>
				<div id="demo" class="collapse">
					<p class="apd-15">Every massengers.com customer agrees to comply with our all the terms and conditions listed on our terms and conditions homepage. We take the enforcement of all terms and conditions seriously, and we aim to run a clean network which operates on fair principles. We also investigate all reports of abuse. If you encounter something you think might constitute abuse (for example, spam or inappropriate content) which you believe has come from our network or systems, please read through the information on this page carefully. It explains how you can report it.</p>
				</div>
			</div>	
      </div>
    </div>

  </div>
</div>
	</div>
</div>

<?php foreach($confessions as $confession): ?>
<div class="container-fluid pd-40 bg-red">
	<div class="container">
		<div class="row row-800">
			<div class="col-md-3">
				<center>
					<img src="<?php echo e(asset('massengers/img/team1.jpg')); ?>" width="150" height="150" class="img-circle"/>
				</center>
			</div>
			<div class="col-md-9 lcb-content">
				<h1><i class="fa fa-quote-left quote"></i>&nbsp;&nbsp;<?php echo e($confession->confessing_to); ?></h1>
				<p>
				<?php echo $confession->message; ?>

				</p>
				<p class="author">by <?php echo e($confession->confess_anonymously == 'yes' ? 'Anonymous user' : $confession->confessor); ?> - <?php echo e(Carbon\Carbon::parse($confession->created_at)->format('D d-m-Y')); ?></p>
				<!-- <ul class="share-icon">
					<li><a href="#" title="Like"><i class="fa fa-thumbs-o-up"></i></a></li>
					<li><a href="#" title="Reply"><i class="fa fa-reply"></i></a></li>
					<li><a href="#" title="Share"><i class="fa fa-share-alt"></i></a></li>
				</ul> -->
			</div>
			<!-- <div class="col-md-3">
				<center>
					<img src="<?php echo e(asset('massengers/img/team1.jpg')); ?>" width="100" height="100" class="img-circle"/>
				</center>
			</div>
			<div class="col-md-9 lcb-content">
				<h3>Samantha</h3>
				<p>
				Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
				</p>
			</div> -->
		</div>
	</div>
</div>
<?php endforeach; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('massengers/layout/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>