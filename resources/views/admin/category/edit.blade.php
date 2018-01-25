@extends('admin/layouts/layout')

@section('title')
	| {{$title}}
@endsection

@section('pageTopScripts')
	<style>
		.hide{display:none;}
		.subcategory{margin:0 0 10px 0;}
		.padding-bottom30{padding-bottom: 30px;}
		select,input{margin-bottom:10px;}
	</style>
	
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">	
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
	
@endsection

@section('pageScripts')

	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>	
	
<script type="text/javascript">
	$(document).ready(function(){
	$('#updateCategoryModel').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var recipient = button.data('whatever');
		var modal = $(this);
		modal.find('.modal-title').text('New message to ' + recipient);
		modal.find('.modal-body input').val(recipient);
	})

});
</script>
<script>
$("document").ready(function() {
        getSubCategory("subCategory1", "subCategory1");
        $("#subCategory1").change(function() {
            $("#category").val($("#subCategory1").val());
            getSubCategory("subCategory1", "subCategory2");
            $('#subCategory2').find('option').remove();
            $('#subCategory3').find('option').remove();
            $('#subCategory4').find('option').remove();
            $('#subCategory5').find('option').remove();
            $('#subCategory2').hide();
            $('#subCategory3').hide();
            $('#subCategory4').hide();
            $('#subCategory5').hide();            
        });
        $("#subCategory2").change(function() {

            $("#category").val($("#subCategory2").val());
            getSubCategory("subCategory2", "subCategory3");
            $('#subCategory3').find('option').remove();
            $('#subCategory4').find('option').remove();
            $('#subCategory5').find('option').remove();
            $('#subCategory3').hide();
            $('#subCategory4').hide();
            $('#subCategory5').hide();
        });
        $("#subCategory3").change(function() {
            $("#category").val($("#subCategory3").val());
            getSubCategory("subCategory3", "subCategory4");
            $('#subCategory4').find('option').remove();
            $('#subCategory5').find('option').remove();
            $('#subCategory4').hide();
            $('#subCategory5').hide();
        });
        $("#subCategory4").change(function() {
            $("#category").val($("#subCategory4").val());
            getSubCategory("subCategory4", "subCategory5");
            $('#subCategory5').find('option').remove();
            $('#subCategory5').hide();
        });
        $("#subCategory5").change(function() {
            $("#category").val($("#subCategory5").val());
            $("#category").trigger("change");
        });
        
    });
    function getSubCategory(id1, id2) {
        $('#category').trigger("change");
        var categoryId = $("#" + id1).val();
        if (categoryId == 0) {
            return false;
        }
        if (typeof (categoryId) == 'undefined' || categoryId == null) {
            categoryId = 0;
        }
        $.ajax({
            url: "{{url(ADMIN_URL_PATH.'/category/ajax/ajaxflag')}}",
            type: "POST",
            data: {categoryId: categoryId,allcategory:1},
            dataType: 'json',
            success : function(data){
            	console.log(data['data']);
            	result = data['data'];
            if (result != '') {
                $("#" + id2).show();
                var select = '';
                var option = '';
                select = document.getElementById(id2);
                option = document.createElement("option");
                option.text = 'none';
                option.value = 0;
                select.add(option);
                for (var sn = 0; sn < result.length; sn++) {
                    select = document.getElementById(id2);
                    option = document.createElement("option");
                    option.text = result[sn]['category'];
                    option.value = result[sn]['id']
                    select.add(option);
                }

            }
            }
        });/*.done(function(result) {
        	
        });*/
    }
    
</script>
@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')  
<div class="content-area py-1">
	<div class="container-fluid">
		<ol class="breadcrumb no-bg mb-1">
			<li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
			<li class="breadcrumb-item active">{!! $title !!}</li>
		</ol>
		<div class="row">
			<div class="col-md-6 mb-1 mb-md-0">
			@if(Session::has('success'))
				<div class="alert alert-success alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					<strong>{!! Session::get('success') !!}. New ID : {!! Session::get('category_id') !!}</strong>
				</div>				
			@endif

			@if(Session::has('danger'))
				<div class="alert alert-danger alert-dismissible fade in mb-0" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					<strong>{!! Session::get('danger') !!}.</strong>
				</div>
			@endif

			</div>
		</div>
		<div class="box box-block bg-white">
			<div class="row" style="border-bottom:2px solid #000; padding-bottom:10px;">
				<h3>{!! $title !!}</h3>
				<ul class="demo-header-actions" style="float:right;margin: 0;padding: 0;list-style: none; margin-right:10px;">
					<li class="demo-tabs" style="float: left;display: block;position: relative; margin-right:10px"><a href="{{url('/admin/category/categorylist')}}" class="btn btn-black w-min-sm mb-0-25 waves-effect waves-light">Back</a></li>
					
				</ul>
			</div>
		</div>
			<div class="col-md-6">
			@if (count($errors) > 0)
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif

			<div class="error">{{ $errors->first('category') }}</div>

			{!! Form::open(array('method' => 'post', 'id' => 'save_category_frm', 'action' => ['Admin\Category\CategoryController@update',$category->id])) !!}
			<div class="form-group padding-bottom30">
					<label for="type"  class="col-sm-4 form-control-label">Parent Category:</label>
					<div class="col-sm-8">						
						<input name="subCategory" value="{{$category->parentcategory}}" readonly="true" class="form-control">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateCategoryModel" data-whatever="{{$category->category}}">Manage Parent Category @ {{$category->category}}</button>						
					</div>					
				</div>
				<div class="form-group padding-bottom30">
					<label for="coupon-name" class="col-sm-4 form-control-label">Category<span style="color:red">*</span>&nbsp;:</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="category_name" name="category" value="{!! Old('category_name') ? Old('category_name') : $category->category !!}">
					</div>
				</div>
				<!--<div class="form-group" style="display:none;">
					<label for="code" class="col-sm-4 form-control-label"><span style="color:red">*</span>&nbsp;Variants:</label>
					
					<div class="col-sm-8 varient-multi" style="padding-bottom:10px">
						<select multiple class="form-control" id="exampleSelect2" name="variants" style="height:300px">
						<option>Normal</option>
						<option>Small</option>
						<option>Medium</option>
						<option>Large</option>
						<option>XL</option>
						<option>XXL</option>
						<option>XXXL</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
						<option>6</option>
						<option>7</option>
						<option>8</option>
						<option>9</option>
						<option>10</option>
						<option>11</option>
					</select>
					</div>
				</div>-->
						
				
				
				<div class="form-group padding-bottom30">
					<label for="status" class="col-sm-4 form-control-label">Status:</label>
					<div class="col-sm-8">
						<select class="form-control" id="status" name="status" data-plugin="select2">
						<option value="1" @if($category->status == 'enable') selected @endif>Enabled</option>
						<option value="0" @if($category->status == 'disable') selected @endif>Disabled</option>
					</select>
					</div>
				</div>	
				<div class="form-group padding-bottom30">
					<label for="coupon-name" class="col-sm-4 form-control-label">&nbsp;Sort:</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="sort_order" name="sort_order" value="{!! Old('sort_order') ? Old('sort_order') : $category->sort_order !!}" placeholder="">
					</div>
				</div>							
			
			<div class="row" style="margin-top:50px;margin-right:15px;float:right;text-align:center;">
				<button type="submit" name="save" class="btn btn-success">Save</button>
			</div>
			{!! Form::close() !!}
			
			<!-- Form Model -->
			<div class="modal fade" id="updateCategoryModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title" id="exampleModalLabel">Select Category for </h4>
						</div>
						{!! Form::open(array('method' => 'post', 'action' => ['Admin\Category\CategoryController@updateparentcategory',$category->id])) !!}
						<div class="modal-body">							
							<div class="form-group">
								<label for="recipient-name" class="form-control-label">Category:</label>
								<input type="text" class="form-control" id="categ-name" readonly="ture">
							</div>
							<div class="form-group">
								<label for="message-text" class="form-control-label">Parent Category:</label>
								<select name="top1" id="subCategory1" class="form-control hide subcategory"></select>
		                        <select name="top2" id="subCategory2" class="form-control hide subcategory"></select>
		                        <select name="top3" id="subCategory3" class="form-control hide subcategory"></select>
		                        <select name="top4" id="subCategory4" class="form-control hide subcategory"></select>
		                        <select name="top5" id="subCategory5" class="form-control hide subcategory"></select>
							</div>							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" name="updateParentategory" class="btn btn-primary">Update</button>
						</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>

			<!-- Form Model End -->
		</div>
	</div>
</div>

@endsection
