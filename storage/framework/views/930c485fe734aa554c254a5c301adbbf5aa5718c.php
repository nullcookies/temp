
<?php function printCategory($categories){ ?>         	
	<?php $viewType= isset($_GET['viewType']) ? $_GET['viewType'] : ''; ?>       
<ul> 
  <?php foreach ($categories as $category) { ?>
  <li> <a href="<?php echo e(url('/products?catid='.$category['id'].'&category_name='.urlencode($category['category']).'&viewType='.$viewType )); ?>"><?= $category['category'] ?></a> <span class="subDropdown plus"></span>
    <?php printCategory($category['child']) ?> 
  </li>
  <?php } ?>
</ul>
<?php } printCategory($categories); ?>
