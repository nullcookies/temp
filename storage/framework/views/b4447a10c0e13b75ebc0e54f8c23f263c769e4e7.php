<?php $__env->startSection('title'); ?>
| Homepage Tag Products
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTopScripts'); ?>

<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/core.css')); ?>">	
<link rel="stylesheet" href="<?php echo e(asset(ADMIN_FILE_PATH.'/css/custom.css')); ?>">
<style type="text/css">
    .dropify{height: 80px;width: 80px;}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageScripts'); ?>

<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/app.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset(ADMIN_FILE_PATH.'/js/demo.js')); ?>"></script>	

<?php $__env->stopSection(); ?>

<?php $__env->startSection('bodyclass'); ?>
fixed-sidebar fixed-header skin-default content-appear
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="content-area py-1">
    <div class="container-fluid">       
        <ol class="breadcrumb no-bg mb-1">
            <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>">Home</a></li>
            <li class="breadcrumb-item active">Homepage Tag Products</li>
        </ol>
        

        <div class="box box-block bg-white">
            <div class="row header-row">
                <h3 class="head-position"><?php echo e($item->tag); ?></h3>
                <ul class="demo-header-actions">                    
                    <li class="demo-tabs"><a href="<?php echo e(url('admin/product/addTagProducts/'.$item->id)); ?>" class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light">Add New</a></li>
                    
                </ul>
            </div>  
            <?php if($message = Session::get('success')): ?>
            <div class="alert alert-success">
                <p><?php echo e($message); ?></p>
            </div>
            <?php endif; ?>
        <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Old Price</th>
                    <th>New Price</th>
                    <th>Rating</th>
                    <th width="280px">Action</th>
                </tr>
                <?php foreach($products as $key => $product): ?>
                <tr>
                     <td><?php echo e(++$i); ?></td>
                    <td><a href="<?php echo e($product->link); ?>"><?php echo e($product->name); ?></a></td>
                    <td>                                                               
                        <img src="<?php echo e(url('products-images/'.$product->image)); ?>" class="dropify">
                    </td>
                    <td><?php echo e($product->old_price); ?></td>
                    <td><?php echo e($product->new_price); ?></td>
                    <td><?php echo e($product->rating); ?></td>                    

                    <td>                        
                        <a class="btn btn-primary" href="<?php echo e(url('admin/product/editTagProducts/'.$product->id)); ?>">Edit</a>
                        <?php echo Form::open(['method' => 'DELETE','action' => ['Admin\Product\HomepageTagController@deleteTagProducts', $product->id],'style'=>'display:inline']); ?>

                        <?php echo Form::submit('Delete', ['class' => 'btn btn-danger']); ?>

                        <?php echo Form::close(); ?>

                        
                    </td>
                </tr>
                <?php endforeach; ?>
        </table>
            <?php echo $products->render(); ?>

            
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>