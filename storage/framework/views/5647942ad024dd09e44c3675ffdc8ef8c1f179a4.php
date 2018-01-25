<?php $__env->startSection('title'); ?>
| <?php echo e('Coupons'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>
<!-- Cropper -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.rawgit.com/fengyuanchen/tooltip/v0.0.2/dist/tooltip.min.css">

<link rel="stylesheet" href="<?php echo e(url('cropper/docs/css/cropper.css')); ?>">
<link rel="stylesheet" href="<?php echo e(url('cropper/docs/css/main.css')); ?>">

<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/custom.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/sweetalert.css')); ?>"/>
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/select2/dist/css/select2.min.css')); ?>">


<style>
	#suggested_categories li{
		cursor: pointer;
	}

	.auto_scroll_div_class{
		max-height: 200px;
		overflow-y: auto;
	}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>

<!-- new script -->

<script>

	$(document).ready(function(){
		$('.agdteuhdbs').submit(function(event){
			event.preventDefault();
		});
	});

	function saveVarientValue(varientTypeId, productid){

		console.log($('#form_'+varientTypeId).serialize());
		var formVal 		=  $('#form_'+varientTypeId).serialize();
		$.ajax({
			url: "<?php echo e(url('admin/assign_varients/insertValueToVarient')); ?>",
			type: 'post',
			data: formVal,
			dataType: 'json',
			beforeSend: function(){
			},
			success: function(result){
				console.log(result);
				if(result['success']){
					$('#allVarientesSizes_'+varientTypeId).append('<tr class="table-row-design"><td class="width-30"></td><td class="width-190">'+result['data']['value']+'</td><td class="width-25"><a href="javascript:;" onclick=selectTheVarientValue('+varientTypeId+','+result['data']['id']+','+productid+')>+</a></td></tr>');
				}

				$('#textBox_'+varientTypeId).val('');
				$('#textBox_'+varientTypeId).focus();
			}
		});
	}

	function selectTheVarientValue(varientId, varientValueId, product_id){
		console.log(varientId, varientValueId, product_id);

		$.ajax({
			url: "<?php echo e(url('admin/assign_varients/selectProductVarientValue')); ?>",
			type: 'POST',
			data: {varientId: varientId, varientValueId: varientValueId, product_id:product_id},
			dataType: 'html',
			beforeSend: function(){},
			success: function(result){
				console.log(result);
				$('#selected_varient_values_'+varientId).html(result);					
				getAllAvailableVarientValues(product_id, varientId);
				getProductVarient(product_id, varientId);
				swal("Varient Successfully Selected!", "", "success");
			},
		});
	}

	function getAllAvailableVarientValues(productid, varientTypeId){

		$.ajax({
			url: "<?php echo e(url('admin/assign_varients/getAllAvailableVarientValue')); ?>",
			type: 'POST',
			dataType: 'html',
			data: {varientTypeId:varientTypeId, productid: productid},
			beforeSend: function(){},
			success: function(result){
				console.log(result);
				$('#allVarientesSizes_'+varientTypeId).html(result);
				getProductVarient(productid, varientTypeId);
			}
		});
	}

	function getAllSelectedVarientValues(productid, varientTypeId){
		$.ajax({
			url: "<?php echo e(url('admin/assign_varients/getAllSelectedVarients')); ?>",
			type: 'POST',
			dataType: 'html',
			data: {productid:productid, varientTypeId:varientTypeId},
			beforeSend: function(){},
			success: function(result){
				$('#selected_varient_values_'+varientTypeId).html(result);
			},
		});
	}

	function removeSelectedVarientValue(selectedVarientId, productid, varientTypeId){

		$.ajax({
			url: "<?php echo e(url('admin/assign_varients/removeSelectedVarientValue')); ?>",
			type: 'POST',
			dataType: 'json',
			data: {selectedVarientId:selectedVarientId},
			beforeSend: function(){},
			success: function(result){
				if(result['success']){
					getAllAvailableVarientValues(productid, varientTypeId);
					getAllSelectedVarientValues(productid, varientTypeId);	
					swal("Varient Successfully Unselected!", "", "success");
				}
			},
		});
	}
	function getProductVarient(productid, varientTypeId){
		$.ajax({
			url: "<?php echo e(url('admin/assign_varients/getProductVarient')); ?>",
			type: 'POST',
			dataType: 'html',
			data: {varientTypeId:varientTypeId, productid: productid},
			beforeSend: function(){},
			success: function(result){
				console.log(result);
				$('#resultProductVarient').html(result);
			}
		});
	}
	$("#selectall").change(function () {
		$("input:checkbox").prop('checked', $(this).prop("checked"));
		$("input:checkbox").prop('checked', $(this).prop("checked"));
	});



	function saveMyVarPrice(form){
		alert($("#myNewForm").serialize());
	}

</script>

<!-- new script -->


<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/app.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/demo.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.min.js')); ?>"></script>

<script src="<?php echo e(asset('js/sweetalert.min.js')); ?>"></script>		
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/select2/dist/js/select2.min.js')); ?>"></script>

<?php if(Session::has('saved_successfully')): ?>
<script>
	$(document).ready(function(){
		swal("Product Successfully uploaded!", "", "success");
	});
</script>
<?php endif; ?>


<?php if(Session::has('success_varient')): ?>
<script>
	$(document).ready(function(){
		$('#standard').removeClass('active in');
		$('#standard').attr('aria-expanded',false);

		$('#advance').removeClass('active in');
		$('#advance').attr('aria-expanded',false);

		$('#varients').addClass('active in');
		$('#varients').attr('aria-expanded',true);

		$('#standard_tab').removeClass('active');
		$('#advanced_tab').removeClass('active');
		$('#varient_tab').addClass('active');
	});
</script>
<script>
	$(document).ready(function(){
		swal("<?php echo e(Session::get('success_varient')); ?>", "", "success");
	});
</script>
<?php endif; ?>


<?php if($openAttr): ?>
<script>
	$(document).ready(function(){
		$('#standard').removeClass('active in');
		$('#standard').attr('aria-expanded',false);

		$('#advance').removeClass('active in');
		$('#advance').attr('aria-expanded',false);

		$('#varients').addClass('active in');
		$('#varients').attr('aria-expanded',true);
		
		$('#standard_tab').removeClass('active');
		$('#varient_tab').addClass('active');
	});
</script>
<script>
	$(document).ready(function(){
		swal("Saved Successfully!", "", "success");
	});
</script>
<?php endif; ?>

<script>
	function showCategory(cat){
		console.log(cat);
		$.ajax({
			url: "<?php echo e(url(ADMIN_URL_PATH.'/product/fetchCategory')); ?>",
			type: 'POST',
			data: {category:cat},
			dataType: 'html',
			beforeSend: function(){

			},
			success: function(result){
				$('#suggested_categories').html(result);
			}
		});
	}
	
	function addCategoryToProduct(catid){
		$.ajax({
			url: "<?php echo e(url(ADMIN_URL_PATH.'/product/setupCategory')); ?>",
			type: 'POST',
			data: {catid:catid},
			dataType: 'html',
			beforeSend: function(){
			},
			success: function(result){
				$('#suggested_categories').html('');
				$('#searchText').val('');
				$('#final_categories').append(result);
			}
		});
	}
	
	function removeInput(id){
		$('#selected_catagoey_li_'+id).remove();
	}
	
	$(document).ready(function(){
		$("#summernote").summernote({
			disableResizeEditor: true,
			minHeight : 200,
		});

		$('#summernote_textarea').attr('name','product_desc');

		$('#save_product_form').submit(function(){
			$('textarea[name="product_desc"]').val($('#summernote_content').html());
		});

		$("select").select2({
			allowClear: true
		});
	});
</script>
<?php if($errors->has('product_desc')): ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#my_summernote_frame').css('border-color','#ea6b6b');
	});
</script>
<?php endif; ?>	
<script>
	function gotoproductspage() {
		window.location.href="<?php echo e(url('admin/product')); ?>";
	}
</script>
<?php $__env->stopSection(); ?>
  
  <!-- Cropper JS -->
  <script src="https://cdn.rawgit.com/fengyuanchen/tooltip/v0.0.2/dist/tooltip.min.js"></script>
  <script src="https://fengyuanchen.github.io/js/common.js"></script>
  <script src="<?php echo e(url('cropper/docs/js/cropper.min.js')); ?>"></script>

<script>  
    $(function () {

      'use strict';

      var console = window.console || { log: function () {} };
      var $body = $('body');


      // Tooltip
      $('[data-toggle="tooltip"]').tooltip();
      $.fn.tooltip.noConflict();
      $body.tooltip();


      // Demo
      // ---------------------------------------------------------------------------

      (function () {
        var $image = $('.img-container > img');
        var $actions = $('.docs-actions');
        var $download = $('#download');
        var $dataX = $('#dataX');
        var $dataY = $('#dataY');
        var $dataHeight = $('#dataHeight');
        var $dataWidth = $('#dataWidth');
        var $dataRotate = $('#dataRotate');
        var $dataScaleX = $('#dataScaleX');
        var $dataScaleY = $('#dataScaleY');
        var options = {
              aspectRatio: 300/300,
              preview: '.img-preview',
              strict:false,
              crop: function (e) {
                $dataX.val(Math.round(e.x));
                $dataY.val(Math.round(e.y));
                $dataHeight.val(Math.round(e.height));
                $dataWidth.val(Math.round(e.width));
                $dataRotate.val(e.rotate);
                $dataScaleX.val(e.scaleX);
                $dataScaleY.val(e.scaleY);
              }
            };

        $image.on({
          'build.cropper': function (e) {
            console.log(e.type);
          },
          'built.cropper': function (e) {
            console.log(e.type);
          },
          'cropstart.cropper': function (e) {
            console.log(e.type, e.action);
          },
          'cropmove.cropper': function (e) {
            console.log(e.type, e.action);
          },
          'cropend.cropper': function (e) {
            console.log(e.type, e.action);
          },
          'crop.cropper': function (e) {
            console.log(e.type, e.x, e.y, e.width, e.height, e.rotate, e.scaleX, e.scaleY);
          },
          'zoom.cropper': function (e) {
            console.log(e.type, e.ratio);
          }
        }).cropper(options);


        // Buttons
        if (!$.isFunction(document.createElement('canvas').getContext)) {
          $('button[data-method="getCroppedCanvas"]').prop('disabled', true);
        }

        if (typeof document.createElement('cropper').style.transition === 'undefined') {
          $('button[data-method="rotate"]').prop('disabled', true);
          $('button[data-method="scale"]').prop('disabled', true);
        }


        // Download
        if (typeof $download[0].download === 'undefined') {
          $download.addClass('disabled');
        }


        // Options
        $actions.on('change', ':checkbox', function () {
          var $this = $(this);
          var cropBoxData;
          var canvasData;

          if (!$image.data('cropper')) {
            return;
          }

          options[$this.val()] = $this.prop('checked');

          cropBoxData = $image.cropper('getCropBoxData');
          canvasData = $image.cropper('getCanvasData');
          options.built = function () {
            $image.cropper('setCropBoxData', cropBoxData);
            $image.cropper('setCanvasData', canvasData);
          };

          $image.cropper('destroy').cropper(options);
        });


        // Methods
        $actions.on('click', '[data-method]', function () {
          var $this = $(this);
          var data = $this.data();
          var $target;
          var result;

          if ($this.prop('disabled') || $this.hasClass('disabled')) {
            return;
          }

          if ($image.data('cropper') && data.method) {
            data = $.extend({}, data); // Clone a new one

            if (typeof data.target !== 'undefined') {
              $target = $(data.target);

              if (typeof data.option === 'undefined') {
                try {
                  data.option = JSON.parse($target.val());
                } catch (e) {
                  console.log(e.message);
                }
              }
            }

            result = $image.cropper(data.method, data.option, data.secondOption);

            if (data.flip === 'horizontal') {
              $(this).data('option', -data.option);
            }

            if (data.flip === 'vertical') {
              $(this).data('secondOption', -data.secondOption);
            }

            if (data.method === 'getCroppedCanvas' && result) {
              $('#getCroppedCanvasModal').modal().find('.modal-body').html(result);

              if (!$download.hasClass('disabled')) { 
                $download.attr('imageData',result.toDataURL());
                //$download.attr('href', result.toDataURL());
              }
            }

            if ($.isPlainObject(result) && $target) {
              try {
                $target.val(JSON.stringify(result));
              } catch (e) {
                console.log(e.message);
              }
            }

          }
        });


        // Keyboard
        $body.on('keydown', function (e) {

          if (!$image.data('cropper') || this.scrollTop > 300) {
            return;
          }

          switch (e.which) {
            case 37:
              e.preventDefault();
              $image.cropper('move', -1, 0);
              break;

            case 38:
              e.preventDefault();
              $image.cropper('move', 0, -1);
              break;

            case 39:
              e.preventDefault();
              $image.cropper('move', 1, 0);
              break;

            case 40:
              e.preventDefault();
              $image.cropper('move', 0, 1);
              break;
          }

        });


        // Import image
        var $inputImage = $('#inputImage');
        var URL = window.URL || window.webkitURL;
        var blobURL;

        if (URL) {
          $inputImage.change(function () {
            var files = this.files;
            var file;

            if (!$image.data('cropper')) {
              return;
            }

            if (files && files.length) {
              file = files[0];

              if (/^image\/\w+$/.test(file.type)) {
                blobURL = URL.createObjectURL(file);
                $image.one('built.cropper', function () {
                  URL.revokeObjectURL(blobURL); // Revoke when load complete
                }).cropper('reset').cropper('replace', blobURL);
                $inputImage.val('');
              } else {
                $body.tooltip('Please choose an image file.', 'warning');
              }
            }
          });
        } else {
          $inputImage.prop('disabled', true).parent().addClass('disabled');
        }

      }());

    });

  </script>

  <script>
      function saveCropImage(object){       
      
        var imageBase64 = object.getAttribute('imageData');        
        var path = "<?php echo e($folder); ?>";       
        var imagename = "<?php echo e($imagename); ?>";
      
       
         $.ajax({
          url : "<?php echo e(url('/admin/jcrop/save')); ?>",
          type: 'POST',
          data: {imgdata:imageBase64,imagename:imagename,path:path},
          dataType: 'json',
          beforeSend: function (){
            $('.modal-body').html("<img src='<?php echo e(url('images/loader/loading.gif')); ?>' />");
            $('#download').removeAttr("href").css("cursor","pointer");
          },
          success: function(result){
            console.log(result);
          }
        });
      
      }
  </script>
<?php $__env->startSection('bodyclass'); ?>
fixed-sidebar fixed-header skin-default content-appear
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<ol class="breadcrumb no-bg mb-1">
		<li class="breadcrumb-item"><a href="#">Home</a></li>
		<li class="breadcrumb-item active">Products</li>
	</ol>
	<div class="box box-block bg-white">
		<div class="row header-row">
			<h3 style="position:absolute;">Products</h3>
			<ul class="demo-header-actions">
				<!-- <li class="demo-tabs"><button type="button" class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light">Copy Product</button></li>
				<li class="demo-tabs"><button type="button" class="btn btn-danger w-min-sm mb-0-25 waves-effect waves-light">Save Product</button></li> -->
				<li class="demo-tabs demo_tabs"><button type="button" class="btn btn-black w-min-sm mb-0-25 waves-effect waves-light" onclick="gotoproductspage();">Cancel Product</button></li> 
			</ul>
		</div>
		<div class="row row-tabs">
			<div class="col-md-12 mb-1 mb-md-0">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link  active" id="standard_tab" data-toggle="tab" href="#standard">Standard</a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" id="advanced_tab" data-toggle="tab" href="#advance">Advance</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" id="varient_tab" data-toggle="tab" href="#varients">Varients</a>
					</li>
					
				</ul>
			</div>
		</div>
		<?php echo Form::open(array('method' => 'post', 'id' => 'save_product_form', 'files' =>'true', 'action' => ['Admin\Product\ProductController@saveEditProduct'])); ?>

		<div class="tab-content">
			
			<div id="standard" class="tab-pane fade in active">
				<input type="hidden" name="product_id" value="<?php echo e($result->id); ?>">
				<div class="row row-standard">
					<div class="col-md-12">
						<div class="col-md-8">
							<div class="form-group row">
								<label for="coupon-name" class="col-sm-4 control-label"><span style="color:red">*</span>&nbsp;Product Name:</label>
								<div class="col-sm-8">
									<input type="text" class="form-control <?php if($errors->has('product_name')): ?> danger_class_text <?php endif; ?> " value="<?php echo e(Old('product_name') ? Old('product_name') : $result->product_name); ?>" name="product_name" id="coupon-name" placeholder="">
								</div>
							</div>
							<div class="form-group row">
								<label for="coupon-name" class="col-sm-4 control-label"><span style="color:red">*</span>&nbsp;Description:<br/><a href="#" style="font-size:10px">Add Tab</a></label>
								<div class="col-sm-8 summernote-row">
									<div id="summernote" >
										<?php echo Old('product_desc') ? Old('product_desc') : $result->product_description; ?>

									</div>
								</div>
							</div>
							<div class="form-group row">
								<label for="coupon-name" class="col-sm-4 control-label">Brand:</label>
								<div class="col-sm-8">
									<input type="text" value="<?php echo Old('brand') ? Old('brand') : $result->brand; ?>" class="form-control" name="brand">
								</div>

							</div>
							<div class="form-group row">
								<label for="uses-per-customer" class="col-sm-4 control-label"><span style="color:red">*</span>Categories:
								</label>
								<div class="col-sm-8">
									<div class="row">
										<select name="category[]" multiple>
											<?php foreach($categories as $category): ?>
											<option value="<?php echo e($category->id); ?>" <?php if(in_array($category->id, $product_category_ids)): ?> selected <?php endif; ?>><?php echo e($category->category); ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>

							</div>
								<!-- <div class="form-group">
									<label for="coupon-name" class="col-sm-4 control-label">Product Images:</label>
									<div class="col-sm-4">
										<input type="file" name="product_image" id="input-file-now"/>
										<?php if($errors->has('product_image')): ?> <span class="text-danger">Upload an image file</span> <?php endif; ?>
									</div>
									<div class="col-sm-4" style="visibility:hidden">
										<input type="file" id="input-file-now" class="dropify" />
									</div>
								</div> -->
							</div>
							<div class="col-md-4 side-form row">
								<div class="form-group row">
									<label for="coupon-name" class="col-sm-4 control-label">Subtract Stock:</label>
									<div class="col-sm-8">
										<div class="float-xs-left mr-1"><input type="checkbox" class="js-switch" value="yes" <?php if($errors->has('substract_stock') && Old('substract_stock') == 'yes'): ?> checked <?php elseif($result->substract_stock == 'yes'): ?> checked <?php endif; ?> name="substract_stock" data-size="small" data-color="#43b968" ></div>
									</div>
								</div>
								<div class="form-group row">
									<label for="coupon-name" class="col-sm-4 control-label"><span style="color:red">*</span>SKU:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control <?php if($errors->has('product_sku')): ?> danger_class_text <?php endif; ?> " id="coupon-name" name="product_sku" value="<?php echo e(Old('product_sku') ? Old('product_sku') : $result->sku); ?>" placeholder="">
									</div>
								</div>
								<div class="form-group row">
									<label for="coupon-name" class="col-sm-4 control-label">Model:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control " id="coupon-name" value="<?php echo e(Old('product_model') ? Old('product_model') : $result->model); ?>" name="product_model" placeholder="">
									</div>
								</div>
								<div class="form-group row">
									<label for="coupon-name" class="col-sm-4 control-label"><span style="color:red">*</span>Mrp Price:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control <?php if($errors->has('mrp')): ?> danger_class_text <?php endif; ?>" id="coupon-name" value="<?php echo e(Old('mrp') ? Old('mrp') : $result->product_mrp); ?>" name="mrp" placeholder="">
									</div>
								</div>
								<div class="form-group row">
									<label for="coupon-name" class="col-sm-4 control-label"><span style="color:red">*</span>Selling Price:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control <?php if($errors->has('selling_price')): ?> danger_class_text <?php endif; ?>" id="coupon-name" name="selling_price" value="<?php echo e(Old('selling_price') ? Old('selling_price') : $result->product_selling_price); ?>" placeholder="">
									</div>
								</div>
								<div class="form-group row">
									<label for="coupon-name" class="col-sm-4 control-label"><span style="color:red">*</span>Quantity:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control <?php if($errors->has('product_quantity')): ?> danger_class_text <?php endif; ?>" id="coupon-name" value="<?php echo e(Old('product_quantity') ? Old('product_quantity') : $result->quantity); ?>" name="product_quantity" >
									</div>
								</div>
								
								<div class="form-group row">
									<label for="coupon-name" class="col-sm-4 control-label"><span style="color:red; ">*</span>Weight:<br/>(in gms)</label>
									<div class="col-sm-8">
										<input type="text" class="form-control <?php if($errors->has('weight')): ?> danger_class_text <?php endif; ?>" id="coupon-name" value="<?php echo e(Old('weight') ? Old('weight') : $result->weight); ?>" name="weight" placeholder="">
									</div>
								</div>
								<div class="form-group row">
									<label for="coupon-name" class="col-sm-4 control-label"><span style="color:red">*</span>Dimensions:<br/>(L x B x H) inch</label>
									<div class="col-sm-8">
										<div class="col-sm-4 dimension-box">
											<input type="text" class="form-control" id="coupon-name" name="dimension_lenght" value="<?php echo e(Old('dimension_lenght') ? Old('dimension_lenght') : $l); ?>" placeholder="">
										</div>
										<div class="col-sm-4 dimension-box">
											<input type="text" class="form-control" id="coupon-name" name="dimension_width" value="<?php echo e(Old('dimension_width') ? Old('dimension_width') : $b); ?>" placeholder="">
										</div>
										<div class="col-sm-4 dimension-box">
											<input type="text" class="form-control" id="coupon-name" name="dimension_height" value="<?php echo e(Old('dimension_height') ? Old('dimension_height') : $h); ?>" placeholder="">
										</div>
									</div>
									<?php if($errors->has('dimension_lenght') || $errors->has('dimension_width') || $errors->has('dimension_height')): ?> <span class="text-danger">Please give correct dimension.</span> <?php endif; ?>
								</div>
								<div class="form-group row">
									<label class="control-label"></label>
									<div class="col-sm-8">
										<button type="submit" class="btn btn-success">Save</button>
									</div>
								</div>
							</div>
						</div>					
					</div>
				</div>
				<div id="advance" class="tab-pane fade">
					<div class="row advance_row">
						<div class="col-md-2">
							<ul class="nav nav-tabs v-tabs">
								<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#seo">SEO</a></li>
								<!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#custom-fields">Custom Fields</a></li> -->
								<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#standard-fields">Standardized Fields</a></li>
								<!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#related-products">Related Products</a></li> -->
								<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#add-settings">Additional Settings</a></li>
							<!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#reward">Reward</a></li>
							<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#bulk-discounts">Bulk Discounts</a></li>
							<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#special">Special</a></li> -->
						</ul>
					</div>
					<div class="col-md-10">
						<div class="tab-content">
							<div id="seo" class="tab-pane fade in active">
								<div class="form-group row">
									<label for="example-text-input" class="col-xs-2 col-form-label">Meta Title :</label>
									<div class="col-xs-8">
										<input class="form-control" type="text" name="meta_title" value="<?php echo Old('meta_title') ? Old('meta_title') : $result->meta_title; ?>" id="example-text-input">
									</div>
								</div>

								<div class="form-group row">
									<label for="example-text-input" class="col-xs-2 col-form-label">Meta Tag Description :</label>
									<div class="col-xs-8">
										<textarea class="form-control" name="meta_decription" value="<?php echo Old('meta_decription') ? Old('meta_decription') : $result->meta_description; ?>" id="exampleTextarea" rows="3"></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label for="example-text-input" class="col-xs-2 col-form-label">Meta Tag Keywords :</label>
									<div class="col-xs-8">
										<textarea class="form-control" name="meta_keywords" value="<?php echo Old('meta_keywords') ? Old('meta_keywords') : $result->meta_keywords; ?>"  id="exampleTextarea" rows="3"></textarea>
									</div>
								</div>

								<div class="form-group row">
									<label for="example-text-input" class="col-xs-2 col-form-label">Product Tags:<br/><p style="font-size:10px">comma seprated</p></label>
									<div class="col-xs-8">
										<input class="form-control" name="product_tags" value="<?php echo Old('product_tags') ? Old('product_tags') : $result->product_tags; ?>"  type="text" value="" id="example-text-input">
									</div>
								</div>
							</div>

							<div id="standard-fields" class="tab-pane fade">
							<!-- <div class="form-group row">
								<label for="example-text-input" class="col-xs-2 col-form-label">UPC :</label>
								<div class="col-xs-4">
									<input class="form-control" type="text" value="" name="product_upc" id="example-text-input">
								</div>
							</div> -->
							<div class="form-group row">
								<label for="example-text-input" class="col-xs-2 col-form-label">ISBN :</label>
								<div class="col-xs-4">
									<input class="form-control" type="text" value="<?php echo Old('product_isbn') ? Old('product_isbn') : $result->isbn; ?>" name="product_isbn" id="example-text-input">
								</div>
							</div>
							<div class="form-group row">
								<label for="example-text-input" class="col-xs-2 col-form-label">ASIN:</label>
								<div class="col-xs-4">
									<input class="form-control" type="text" value="<?php echo Old('product_asin') ? Old('product_asin') : $result->asin; ?>" name="product_asin" id="example-text-input">
								</div>
							</div>
							<div class="form-group row">
								<label for="example-text-input" class="col-xs-2 col-form-label">EAN:</label>
								<div class="col-xs-4">
									<input class="form-control" type="text" name="product_ean" value="<?php echo Old('product_ean') ? Old('product_ean') : $result->ean; ?>" id="example-text-input">
								</div>
							</div>
						</div>
						<!-- <div id="related-products" class="tab-pane fade">
							<table class="table table-striped mb-0">
							<thead>
								<tr>
									<th>Related Products :<br/><p style="font-size:10px">(Autocomplete)</p></th>
									<th class="col-sm-8"><input class="form-control" type="text" value="" id="example-text-input"></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td></td>
									<td class="col-sm-8"><textarea class="form-control" id="exampleTextarea" rows="3"></textarea></td>
								</tr>
							</tbody>
							</table>
						</div> -->
						<div id="add-settings" class="tab-pane fade">

							<div class="form-group row">
								<label for="example-text-input" class="col-xs-2 col-form-label">Requires Shipping :</label>
								<div class="col-xs-8">
									<div class="float-xs-left mr-1"><input type="checkbox" name="requires_shipping" class="js-switch" data-size="small" data-color="#43b968" <?php if($errors->has('requires_shipping') && Old('requires_shipping') == 'yes'): ?> checked <?php elseif($result->requires_shipping == 'yes'): ?> checked <?php endif; ?>></div>
								</div>
							</div>
							
							<div class="form-group row">
								<label for="example-text-input" class="col-xs-2 col-form-label">Maximum Quantity :<br/><p style="font-size:10px">Force a maximum ordered amount</p></label>
								<div class="col-xs-4">
									<input class="form-control" type="text" value="<?php echo Old('maximum_order_quantity') ? Old('maximum_order_quantity') : $result->maximum_order_quantity; ?>" name="maximum_order_quantity" id="example-text-input">
								</div>
							</div>
							<div class="form-group row">
								<label for="example-text-input" class="col-xs-2 col-form-label">Minimum Quantity :<br/><p style="font-size:10px">Force a minimum ordered amount</p></label>
								<div class="col-xs-4">
									<input class="form-control" type="text" name="minimum_order_quantity"  value="<?php echo Old('minimum_order_quantity') ? Old('minimum_order_quantity') : $result->minimum_order_quantity; ?>" id="example-text-input">
								</div>
							</div>
							<div class="form-group row">
								<label for="example-text-input" class="col-xs-2 col-form-label">Out of stock status:<br/><p style="font-size:10px">Status shown when a product is out of stock</p></label>
								<div class="col-xs-2">
									<select class="form-control" name="out_of_stock_status" id="status">
										<option value="out_of_stock" selected>Out of stock</option>
										<option>In Stock</option>
									</select>
								</div>
							</div>
						</div>
						<button type="submit" class="btn btn-success">Save</button>
					</div>
				</div>
			</div>
		</div>

		<div id="varients" class="tab-pane fade">
			<div class="row advance_row">
				<div class="col-md-12">
					<?php foreach($varients as $varient): ?>
					<div class="container">
						<div class="col-md-3 auto_scroll_div_class">
							<h5 class="all-sizes"><?php echo e($varient->varient_type); ?></h5>
							<table>
								<thead></thead>
								<tbody id="allVarientesSizes_<?php echo e($varient->id); ?>">
									<?php foreach($availableVarients as $varient_value): ?>
									<?php if($varient_value->varient_type_id == $varient->id): ?>
									<tr class="table-row-design">
										<td class="width-30"></td>
										<td class="width-190"><?php echo e($varient_value->value); ?></td>
										<td class="width-25"><a href="javascript:;" onclick="selectTheVarientValue(<?php echo e($varient->id); ?>,<?php echo e($varient_value->id); ?>, <?php echo e($result->id); ?>)">+</a></td>
									</tr>
									<?php endif; ?>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
						<div class="col-md-3">
						</div>
						<div class="col-md-3 auto_scroll_div_class">
							<h5 class="all-sizes">Selected <?php echo e($varient->varient_type); ?></h5>
							<table>
								<thead></thead>
								<tbody id="selected_varient_values_<?php echo e($varient->id); ?>">
									<?php foreach($assignedVarients as $assigned_varient): ?>
									<?php if($assigned_varient->varient_type_id == $varient->id): ?>
									<tr class="table-row-selected">
										<td class="width-30"></td>
										<td class="width-190"><?php echo e($assigned_varient->value); ?></td>
										<td class="width-25"><a href="javascript:;" onclick="removeSelectedVarientValue(<?php echo e($assigned_varient->id); ?>, <?php echo e($result->id); ?>,<?php echo e($varient->id); ?> )">-</a></td>
									</tr>
									<?php endif; ?>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
						<div class="col-md-3">
						</div>
					</div>
					<?php endforeach; ?>
					<?php echo Form::close(); ?>

					<hr/>
					<div class="row box-block">
						<?php echo Form::open(['method'=>'post', 'id' => 'myNewForm', 'action' => ['Admin\Varients\AssignVarientsController@postProductVarient', ]]); ?>

						<table class="table varient-table">
							<thead>
								<tr>
									<th>Set Product according Varients</th>
								</tr>

							</thead>
							<tbody id="resultProductVarient">
								<tr>
									<?php foreach($varients as $varient): ?>
									<td><input type="hidden" name="productid" value="<?php echo e($result->id); ?>">
										<select class="form-control" name="varient_type[]">
											<?php foreach($assignedVarients as $assigned_varient): ?>
											<?php if($assigned_varient->varient_type_id == $varient->id): ?>
											<option value="<?php echo e($assigned_varient->varient_type_value_id); ?>"><?php echo e($assigned_varient->value); ?></option>
											<?php endif; ?>
											<?php endforeach; ?>

										</select>
									</td>
									<td>
										+
									</td>
									<?php endforeach; ?>
									<input type="hidden" name="redirect_product" value="1">
									<td><input type="number" name="productPrice" class="set_price form-control" id="fromInput" placeholder="Set Price"/></td>
									<td><input type="submit" name="btnSave" value="Save" class="btn btn-success save-button24"/></td>
								</tr>

							</tbody>
						</table>
						<?php echo Form::close(); ?>

					</div>


					<!-- price -->
					<div class="box-block">
						<table class="table table-striped varient-table">
							<tbody> 
								<?php foreach($productVarient as $value): ?>
								<tr>
									<td><?php echo e($value['varients']); ?></td>
									<td><span><?php echo e($value['price']); ?></span></td>
									<td>
										<?php echo Form::open(array('method' => 'delete', 'action' => ['Admin\Varients\AssignVarientsController@deleteProductVarient'])); ?>

										<input type="hidden" name="product_varient_id" value="<?php echo e($value['id']); ?>">
										<a href="javascript:;" title="Delete" style="color:#ff0000" data-toggle="modal" data-target="#delete_product_varient_<?php echo e($value['id']); ?>"><i class="fa fa-times"></i></a>
										<div class="modal fade small-modal" id="delete_product_varient_<?php echo e($value['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">×</span>
														</button>
														<h4 class="modal-title" id="mySmallModalLabel">Category Delete Confirmation</h4>
													</div>
													<div class="modal-body">
														Are you sure to delete this record ?
													</div>
													<div class="modal-footer">
														<button type="submit" class="btn btn-primary">yes</button>
														<button type="button" class="btn btn-danger" data-dismiss="modal">no</button>
													</div>
												</div>
											</div>
										</div>
										<?php echo Form::close(); ?>	
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
						<a href="<?php echo e(url('/admin/product')); ?>" class="btn btn-success float-xs-right">Complete Changes</a>
					</div>

					<!-- price -->
				</div>
			</div>
		</div>		
		
	</div>

</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>