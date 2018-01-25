<?php $__env->startSection('title'); ?>
	| <?php echo e('Coupons'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>	
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/multi_select/css/multi-select.css')); ?>">	
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/custom.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/clockpicker/dist/bootstrap-clockpicker.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('css/sweetalert.css')); ?>"/>
	<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/select2/dist/css/select2.min.css')); ?>">
	
	<style>
		#suggested_categories li{
			cursor: pointer;
		}
		.p-image{
			position:relative;
			width: 100px;
		}
		
		.p-image img{
			float: left;
			display: inline-block;
		}
		.p-image .progress{
			background-color: #337AB7;
			height:5px;
			margin-top:10px;
			margin-bottom: 10px !important; 
		}

		.output_image{
			opacity: 0.5;
		}

		.hide{
			display: none !important; 
		}
	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>		

<script src="<?php echo e(asset('js/sweetalert.min.js')); ?>"></script>

<?php if(Session::has('saved_successfully')): ?>
    <script>
		  $(document).ready(function(){
		    swal("Product Successfully uploaded!", "", "success");
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
	</script>

	<script>
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

		function submitForm(){
			
		}
	</script>

	<script>
		function removeInput(id){
			$('#selected_catagoey_li_'+id).remove();
		}
	</script>

	<script>
		$(document).ready(function(){
		    
    	       $("select").select2({
          			allowClear: true,
    		    });
		    
			$("#summernote").summernote({
				disableResizeEditor: true,
				minHeight : 200,
			});

			$('#summernote_textarea').attr('name','product_desc');

			$('#save_product_form').submit(function(){
				$('textarea[name="product_desc"]').val($('#summernote_content').html());
			});

			/* Image upload script */
			$('#submit-form-btn').on('click', function(event){
				$('#save_product_form').on('submit', function(event){
					$(this).unbind('submit').submit();
				});

				$('#save_product_form').submit();
			});

			$('#upload_product_images').on('change', function(event){
				$('#output_image').attr('src',URL.createObjectURL(event.target.files[0]));
				$('#save_product_form').on('submit',function(event){
					event.preventDefault();
					var formData = new FormData(this);
					$.ajax({
						url : "<?php echo e(url('admin/product/multiimageUpload')); ?>",
						xhr: function () {
			                $('.progress').removeClass('hide');
			                var xhr = new window.XMLHttpRequest();
			                xhr.upload.addEventListener("progress", function (evt) {
			                    if (evt.lengthComputable) {
			                        var percentComplete = evt.loaded / evt.total;
			                        $('.progress-bar').css({
			                            width: percentComplete * 100 + '%'
			                        });
			                        if (percentComplete === 1) {
			                            //$('.progress').addClass('hide');
			                        }
			                    }
			                }, false);
			                xhr.addEventListener("progress", function (evt) {
			                    if (evt.lengthComputable) {
			                        var percentComplete = evt.loaded / evt.total;
			                        $('.progress').css({
			                            width: percentComplete * 100 + '%'
			                        });
			                    }
			                }, false);
			                return xhr;
			            },
						type: 'POST',
						data: formData,
						dataType: 'json',
						cache : false,
    					processData: false,
    					contentType: false,
						beforeSend : function(){
							$('#upload_product_images').attr('disabled','disabled');
							$('.output_image').attr('width',100);
							$('.output_image').attr('height',100);
						},
						success: function(result){
							$('#upload_product_images').attr('disabled','disabled');
							$('.output_image').css('opacity',1);
							$('#upload_product_images').removeAttr('disabled');
							$('.output_image').removeAttr('src');
							$('.output_image').removeAttr('width');
							$('.output_image').removeAttr('height');
							$('#upload_product_images').val(null).clone(true);;
							if(result['success']){
								$('.p-image').append('<img src="'+result['image_url']+'" width="100" height="100"/>');
							}
						}
					});
				});

				$('#save_product_form').submit();
			});
		});

	</script>

	<?php if($errors->has('product_desc')): ?>
		<script>
			$(document).ready(function(){
				$('#my_summernote_frame').css('border-color','#ea6b6b');
			});
		</script>
	<?php endif; ?>
	
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/app.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/demo.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/multi_select/js/jquery.multi-select.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/moment/moment.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/forms-pickers.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/summernote/summernote.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/vendor/select2/dist/js/select2.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

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
			<h3 class="head-position">Products</h3>
			<ul class="demo-header-actions">
				<li class="demo-tabs"><button type="button" onclick="window.location.href='<?php echo e(url('/admin/product/')); ?>'"  class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light">View Products</button></li>
			</ul>
		</div>
		<div class="row row-tabs">
			<div class="col-md-12 mb-1 mb-md-0">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link  active" data-toggle="tab" href="#standard">Standard</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#advance">Advance</a>
					</li>
				</ul>
			</div>
		</div>
		<?php echo Form::open(array('method' => 'post', 'id' => 'save_product_form', 'files' =>'true', 'action' => ['Admin\Product\ProductController@save'])); ?>

			<input type="hidden" name="product_session_key" value="<?php echo e($product_session_key); ?>">
		<div class="tab-content">
			
			<div id="standard" class="tab-pane fade in active">
				<div class="row row-standard">
					<div class="col-md-12">
						<div class="col-md-8">
								<div class="form-group row">
									<label for="coupon-name" class="col-sm-4 control-label"><span style="color:red">*</span>&nbsp;Product Name:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control <?php if($errors->has('product_name')): ?> danger_class_text <?php endif; ?> " value="<?php echo e(Old('product_name')); ?>" name="product_name" id="coupon-name" placeholder="">
									</div>
								</div>
								<div class="form-group row">
									<label for="coupon-name" class="col-sm-4 control-label"><span style="color:red">*</span>&nbsp;Description:<br/><a href="#" style="font-size:10px">Add Tab</a></label>
									<div class="col-sm-8 summernote-row">
										<div id="summernote" >
											<?php echo Old('product_desc'); ?>

										</div>
									</div>
								</div>
								<div class="form-group row">
									<label for="coupon-name" class="col-sm-4 control-label">Brand:</label>
									<div class="col-sm-8">
										<input type="text" value="<?php echo e(Old('brand')); ?>" class="form-control" name="brand">
									</div>									
								</div>
								<div class="form-group row">
									<label for="coupon-name" class="col-sm-4 control-label">Product Images:</label>
									<div class="col-sm-4">
										<input type="file" name="product_image" id="upload_product_images"/>
										<div class="p-image">
											<img id="output_image" class="output_image">

											<?php foreach($uploadedImages as $uploadedImage): ?>
												<img src="<?php echo e(url('product_images/100x100/'.$uploadedImage->image_url)); ?>">
											<?php endforeach; ?>
										</div>
										<?php if($errors->has('product_image')): ?> <span class="text-danger">Upload an image file</span> <?php endif; ?>
									</div>									
								</div>
						</div>
						<div class="col-md-4 side-form">
								<div class="form-group row">
									<label for="coupon-name" class="col-sm-4 control-label">Subtract Stock:</label>
									<div class="col-sm-8">
										<div class="float-xs-left mr-1"><input type="checkbox" class="js-switch" value="yes" <?php if(Old('substract_stock') == 'yes'): ?> checked <?php endif; ?> name="substract_stock" data-size="small" data-color="#43b968" checked></div>
									</div>
								</div>
								<div class="form-group row">
									<label for="coupon-name" class="col-sm-4 control-label">SKU:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control <?php if($errors->has('product_sku')): ?> danger_class_text <?php endif; ?> " id="coupon-name" name="product_sku" value="<?php echo e(Old('product_sku')); ?>" placeholder="">
									</div>
								</div>
								<div class="form-group row">
									<label for="coupon-name" class="col-sm-4 control-label">Model:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control " id="coupon-name" value="<?php echo e(Old('product_model')); ?>" name="product_model" placeholder="">
									</div>
								</div>
								<div class="form-group row">
									<label for="coupon-name" class="col-sm-4 control-label"><span style="color:red">*</span>MRP Price:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control <?php if($errors->has('mrp')): ?> danger_class_text <?php endif; ?>" id="coupon-name" value="<?php echo e(Old('mrp')); ?>" name="mrp" placeholder="">
									</div>
								</div>
								<div class="form-group row">
									<label for="coupon-name" class="col-sm-4 control-label"><span style="color:red">*</span>Selling Price:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control <?php if($errors->has('selling_price')): ?> danger_class_text <?php endif; ?>" id="coupon-name" name="selling_price" value="<?php echo e(Old('selling_price')); ?>" placeholder="">
									</div>
								</div>
								<div class="form-group row">
									<label for="coupon-name" class="col-sm-4 control-label"><span style="color:red">*</span>Quantity:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control <?php if($errors->has('product_quantity')): ?> danger_class_text <?php endif; ?>" id="coupon-name" value="<?php echo e(Old('product_quantity')); ?>" name="product_quantity" >
									</div>
								</div>
						</div>
					</div>
					<div class="row row-standard">
						<div class="col-md-12">
							<div class="col-md-8 category-selector">
									<div class="form-group" style="padding-bottom:72px">
										<label for="uses-per-customer" class="col-sm-4 control-label"><span style="color:red">*</span>Categories:
										</label>
										
									    <div class="col-sm-8 selector_">
											<div class="row">
												<select name="category[]" class="form-control" multiple>
												    <option>Select Category</option>
													<?php foreach($categories as $category): ?>
														<option value="<?php echo e($category->id); ?>"><?php if(strlen($category->parentTop3)): ?> <?php echo e($category->parentTop3); ?> / <?php endif; ?> <?php if(strlen($category->parentTop2)): ?><?php echo e($category->parentTop2); ?>/ <?php endif; ?>  <?php if(strlen($category->parentTop1)): ?><?php echo e($category->parentTop1); ?>/ <?php endif; ?><?php echo e($category->category); ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>
								
							</div>
							<div class="col-md-4 side-form">
								<div class="form-group" style="margin-bottom: 70px !important">
									<label for="coupon-name" class="col-sm-4 control-label"><span style="color:red; ">*</span>Weight:<br/>(in gms)</label>
									<div class="col-sm-8">
										<select class="form-control" name="weight">
											<option value="">Select Weight</option>
											<option value="1">0-499 Grams</option>
											<option value="501">500-999 Grams</option>
											<option value="1001">1Kg - 2Kg</option>
											<option value="4001">3Kg- 5kg</option>
											<option value="6001">5Kg And Above</option>
										</select>
										<?php if($errors->has('weight')): ?> <span class="text-danger"><?php echo e($errors->first('weight')); ?></span> <?php endif; ?>
									</div>
								</div>
								<div class="form-group" style="padding-bottom:40px">
									<label for="coupon-name" class="col-sm-4 control-label">Dimensions:<br/>(L x B x H) inch</label>
									<div class="col-sm-8">
										<div class="col-sm-4 dimension-box">
										<input type="text" class="form-control" id="coupon-name" name="dimension_lenght" value="<?php echo e(Old('dimension_lenght')); ?>" placeholder="">
										</div>
										<div class="col-sm-4 dimension-box">
										<input type="text" class="form-control" id="coupon-name" name="dimension_width" value="<?php echo e(Old('dimension_width')); ?>" placeholder="">
										</div>
										<div class="col-sm-4 dimension-box">
										<input type="text" class="form-control" id="coupon-name" name="dimension_height" value="<?php echo e(Old('dimension_height')); ?>" placeholder="">
										</div>
									</div>
									<?php if($errors->has('dimension_lenght') || $errors->has('dimension_width') || $errors->has('dimension_height')): ?> <span class="text-danger">Please give correct dimension.</span> <?php endif; ?>
								</div>
								<div class="row save-button4">
								<button type="button" id="submit-form-btn" class="btn btn-success">Save</button>
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
								<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#related-products">Related Products</a></li>
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
										<input class="form-control" type="text" name="meta_title" value="" id="example-text-input">
									</div>
								</div>
								
								<div class="form-group row">
									<label for="example-text-input" class="col-xs-2 col-form-label">Meta Description :</label>
									<div class="col-xs-8">
										<textarea class="form-control" name="meta_decription" id="exampleTextarea" rows="3"></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label for="example-text-input" class="col-xs-2 col-form-label">Meta Keywords :</label>
									<div class="col-xs-8">
										<textarea class="form-control" name="meta_keywords" id="exampleTextarea" rows="3"></textarea>
									</div>
								</div>
								
								<div class="form-group row">
									<label for="example-text-input" class="col-xs-2 col-form-label">Product Tags:<br/><p style="font-size:10px">comma seprated</p></label>
									<div class="col-xs-8">
										<input class="form-control" name="product_tags"  type="text" value="" id="example-text-input">
									</div>
								</div>
							</div>
							
							<div id="standard-fields" class="tab-pane fade">
								<div class="form-group row">
									<label for="example-text-input" class="col-xs-2 col-form-label">UPC :</label>
									<div class="col-xs-4">
										<input class="form-control" type="text" value="" name="product_upc" id="example-text-input">
									</div>
								</div>
								<div class="form-group row">
									<label for="example-text-input" class="col-xs-2 col-form-label">ISBN :</label>
									<div class="col-xs-4">
										<input class="form-control" type="text" value="" name="product_isbn" id="example-text-input">
									</div>
								</div>
								<div class="form-group row">
									<label for="example-text-input" class="col-xs-2 col-form-label">ASIN:</label>
									<div class="col-xs-4">
										<input class="form-control" type="text" value="" name="product_asin" id="example-text-input">
									</div>
								</div>
								<div class="form-group row">
									<label for="example-text-input" class="col-xs-2 col-form-label">EAN:</label>
									<div class="col-xs-4">
										<input class="form-control" type="text" name="product_ean" value="" id="example-text-input">
									</div>
								</div>
							</div>
							<div id="related-products" class="tab-pane fade">
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
							</div>
							<div id="add-settings" class="tab-pane fade">
							   
								<div class="form-group row">
									<label for="example-text-input" class="col-xs-2 col-form-label">Requires Shipping :</label>
									<div class="col-xs-8">
										<div class="float-xs-left mr-1"><input type="checkbox" name="requires_shipping" class="js-switch" data-size="small" data-color="#43b968" checked></div>
									</div>
								</div>
								
								<div class="form-group row">
									<label for="example-text-input" class="col-xs-2 col-form-label">Maximum Quantity :<br/><p style="font-size:10px">Force a maximum ordered amount</p></label>
									<div class="col-xs-4">
										<input class="form-control" type="text" value="" name="maximum_order_quantity" id="example-text-input">
									</div>
								</div>
								<div class="form-group row">
									<label for="example-text-input" class="col-xs-2 col-form-label">Minimum Quantity :<br/><p style="font-size:10px">Force a minimum ordered amount</p></label>
									<div class="col-xs-4">
										<input class="form-control" type="text" name="minimum_order_quantity"  value="" id="example-text-input">
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
						  </div>
						</div>
					</div>
				</div>
			</div>
		  <?php echo Form::close(); ?>

		</div>
	</div>
					
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>