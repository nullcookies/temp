
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/tether/js/tether.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap4/js/bootstrap.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/detectmobilebrowser/detectmobilebrowser.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/jscrollpane/jquery.mousewheel.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/jscrollpane/mwheelIntent.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/jscrollpane/jquery.jscrollpane.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/jquery-fullscreen-plugin/jquery.fullscreen-min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/waves/waves.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/switchery/dist/switchery.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/flot/jquery.flot.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/flot/jquery.flot.resize.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/flot.tooltip/js/jquery.flot.tooltip.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/CurvedLines/curvedLines.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/TinyColor/tinycolor.js')); ?>"></script>
<!-- <script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/sparkline/jquery.sparkline.min.js')); ?>"></script> -->
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/raphael/raphael.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/morris/morris.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/jvectormap/jquery-jvectormap-2.0.3.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/jvectormap/jquery-jvectormap-world-mill.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/peity/jquery.peity.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/font-awesome/js/font-awesome.min.js')); ?>" ></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/easy-pie/jquery.easypiechart.min.js')); ?>"></script>

	<script>
		$('#chart-easy').easyPieChart({
			animate: 2000,
			size: 40,
			lineWidth: 3,
			barColor: '#f44236',
			trackColor: '#ddd',
			scaleColor: false,
		});
		</script>
		
		
		<script type="text/javascript">
			$(document).ready(function(){
				var notifObj = $('#notificationNav');

				$('body').click(function(evt){    
					if(!$(evt.target).is('#notificationNav')) {
					     if(notifObj.hasClass('open')){
					     	notifObj.find('.nav-link').find('.tag').css('display','');
					     }
					}
				});

				notifObj.on('click', function(event){
					if(!notifObj.hasClass('open')){
						notifObj.find('.nav-link').find('.tag').css('display','none');
					}else{
						notifObj.find('.nav-link').find('.tag').css('display','');
					}
				});
			});
		</script>