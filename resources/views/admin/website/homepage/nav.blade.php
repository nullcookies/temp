@extends('admin/layouts/layout')

@section('title')
| {{$title}}
@endsection

@section('pageTopScripts')
<!-- Vendor CSS -->

<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/themify-icons/themify-icons.css')}}">
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">-->
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/animate.css/animate.min.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/jscrollpane/jquery.jscrollpane.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/waves/waves.min.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/switchery/dist/switchery.min.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/nestable/nestable.css')}}">

<!-- Neptune CSS -->
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/style46.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset(ADMIN_FILE_PATH.'/css/jquery.mobile-menu.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(ADMIN_FILE_PATH.'/css/simple-line-icons.css')}}" media="all">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/select2/dist/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/sweetalert.css')}}"/>
<style>
	.social-links{
		list-style:none;
	}
	.social-links li{
		display:inline-block;
		padding:5px;;
	}
	.social-links li a{
		font-size:18px;
	}
</style>
<style type="text/css">
	.editdiv-main{
		float: right;
    	margin-top: -37px;
  		margin-right: 5px;
  		position: relative;
  		z-index: 9999;
	}
	.editdiv-main ul{
		list-style:none;
	}
	.editdiv-main ul li{
		display:inline-block;
	}
	.editdiv-main ul li a{
		color:#fff;
	}
	.editdiv-main ul li a .fa-pencil{
		background-color:#ffcf00;
		padding:5px;
	}
	.editdiv-main ul li a .fa-times{
		background-color:#f44236;
		padding:5px;
	}
	#nav > li.mega-menu{
	    width:14%;
	}
	#nav > li > a {
        color: #333;
    }
    #nav > li > a > span{
        white-space: nowrap;
        width: 120px;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    #nav ul.level0 > li > a{
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        padding-right: 40px;
    }
    #nav ul.level1 > li a{
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        
    }
    #nav ul.level1 >.buttonlist li a{
        padding:0;
    }
</style>
@endsection

@section('pageScripts')
<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'></script>
<script>
$("#accountIcon").hover(function () {
    $("#accountPopup").delay(500).show(0);
}, function () {
    $("#accountPopup").delay(1000).hide(0);
});
</script>
<script type="text/javascript">
	function fetchmodal(object){
		var parent = object.getAttribute('data-parent');
		var catParent = object.getAttribute('data-catParent');
		var modalObj = $('#exampleModal');
		$.ajax({
			url : "{{url('admin/homepage/getAddCategoryModelContent')}}",
			type: 'get',
			dataType: 'html',
			data: {parentId : parent, catParent:catParent},
			beforeSend: function(){
			    modalObj.find('#exampleModalLabel').html('Please wait..');
				modalObj.find('.modal-body').html('<center><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i></center>');
			}, 
			success: function(result){
				modalObj.find('#exampleModalLabel').html('Add New Category');
				modalObj.find('.modal-body').html(result);
				$(".select2_select").select2();
			}
		});
	}

	function editCategory(object){
		var navid = object.getAttribute('data-navId');
		var catid = object.getAttribute('data-catId');
		var catName = object.getAttribute('data-cname');
		var modalObj = $('#exampleModal');
		$.ajax({
			url: "{{url('admin/homepage/getEditCategoryModelContent')}}",
			type: 'get',
			dataType : 'html',
			data: {catid: catid, navid:navid, catName:catName},
			beforeSend: function(){
			    modalObj.find('#exampleModalLabel').html('Please wait..');
				modalObj.find('.modal-body').html('<center><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i></center>');
			},
			success: function(result){
				modalObj.find('#exampleModalLabel').html('Edit Category');
				modalObj.find('.modal-body').html(result);
				$(".select2_select").select2();
			}
		});
	}

	function deleteCategory(object){
		var navid = object.getAttribute('data-navId');
		var catName = object.getAttribute('data-cname');
		var modalObj = $('#exampleModal');

		$.ajax({
			url : "{{url('admin/homepage/getDeleteCategoryModelContent')}}",
			type: 'get',
			dataType: 'html',
			data: {navid : navid, catName: catName},
			beforeSend: function(){
			    modalObj.find('#exampleModalLabel').html('Please wait..');
				modalObj.find('.modal-body').html('<center><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i></center>');
			},
			success: function(result){
				modalObj.find('#exampleModalLabel').html('Confirm to delete Category');
				modalObj.find('.modal-body').html(result);
				$(".select2_select").select2();
			}
		});
		console.log(catName);
	}
</script>

@if(Session::has('save_success'))
	<script>
	  $(document).ready(function(){
	    swal("{{Session::get('save_success')}}", "", "success");
	  });
	</script>
@endif
<script src="{{asset('js/sweetalert.min.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/select2/dist/js/select2.min.js')}}"></script>	
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>	
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/common.js')}}"></script> 

<!-- Vendor JS -->
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/tether/js/tether.min.js')}}"></script>

<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/detectmobilebrowser/detectmobilebrowser.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/jscrollpane/jquery.mousewheel.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/jscrollpane/mwheelIntent.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/jscrollpane/jquery.jscrollpane.min.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/jquery-fullscreen-plugin/jquery.fullscreen-min.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/waves/waves.min.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/switchery/dist/switchery.min.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/nestable/jquery.nestable.js')}}"></script>


@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
<div class="container-fluid">
						<body class="cms-index-index cms-home-page">
						<h3>Note*</h3>
						<p>Step 1 : Click on the Category Name And Enter the Desired Name And the Desired category to be redirected</p>
						<p>Step 2 : Enter The Category Name</p>
						<p>Step 3 : Enter The Name of Category You want to Redirect to.</p>	
<div id="page"> 
  <!-- Header -->
  <header>
    <div class="header-container">
    <nav class="nav2">
      <div class="container">
        <div class="mm-toggle-wrap">
          <div class="mm-toggle"><i class="fa fa-bars"></i><span class="mm-label">Menu</span> </div>
        </div>
        <div class="nav-inner"> 
          <!-- BEGIN NAV -->
          <ul id="nav" class="hidden-xs">
          @foreach($categories as $categoryLevel1)
            <li class="mega-menu"> 
        	<a class="level-top" id="accountIcon" data-navId="{{$categoryLevel1['id']}}" href="javascript:;">
        	<span>{{$categoryLevel1['name']}}</span>
        	<div class="editdiv-main">
				<ul>
				<li><a href="javascript:;" title="Edit" onclick="editCategory(this)" data-cname="{{$categoryLevel1['name']}}" data-catId="{{$categoryLevel1['category_id']}}" data-navId="{{$categoryLevel1['id']}}" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-pencil"></i></a></li>
				<li><a href="javascript:;" title="Delete" onclick="deleteCategory(this)" data-cname="{{$categoryLevel1['name']}}" data-navId="{{$categoryLevel1['id']}}" data-catId="{{$categoryLevel1['category_id']}}" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-times"></i></a></li>
				</ul>
			</div>
        	</a>
              <div class="level0-wrapper dropdown-6col" id="accountPopup">
                <div class="container">
                  <div class="level0-wrapper2">
                    <div class="nav-block nav-block-center"> 
                      <ul class="level0">
                      @foreach($categoryLevel1['childs'] as $categoryLevel2)
                        <li class="level3 nav-6-1 parent item"> <a href="javascript:;" data-navId="{{$categoryLevel2['id']}}"><span>{{$categoryLevel2['name']}}</span></a> 
						<div class="editdiv">
							<ul>
							<li><a href="javascript:;" title="Edit" onclick="editCategory(this)" data-cname="{{$categoryLevel2['name']}}" data-catId="{{$categoryLevel2['category_id']}}" data-navId="{{$categoryLevel2['id']}}" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-pencil"></i></a></li>
							<li><a href="javascript:;" title="Delete" onclick="deleteCategory(this)" data-cname="{{$categoryLevel2['name']}}" data-navId="{{$categoryLevel2['id']}}" data-catId="{{$categoryLevel2['category_id']}}" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-times"></i></a></li>
							</ul>
						</div>
                          <ul class="level1">
                          	@foreach($categoryLevel2['childs'] as $categoryLevel3)
                            <li class="level2 nav-6-1-1"> 
								<div class="editdiv2">
									<ul class="buttonlist">
									<li><a href="javascript:;" title="Edit" onclick="editCategory(this)" data-cname="{{$categoryLevel3['name']}}" data-catId="{{$categoryLevel3['category_id']}}" data-navId="{{$categoryLevel3['id']}}" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-pencil"></i></a></li>
									<li><a href="javascript:;" title="Delete" onclick="deleteCategory(this)" data-cname="{{$categoryLevel3['name']}}" data-catId="{{$categoryLevel3['category_id']}}" data-navId="{{$categoryLevel3['id']}}" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-times"></i></a></li>
									</ul>
								</div>
							<a href="javascript:;" data-navId="{{$categoryLevel3['id']}}"><span>{{$categoryLevel3['name']}}</span></a>
							</li>
							@endforeach
							<li class="level2 nav-6-1-1"> 
								<a data-parent="{{$categoryLevel2['id']}}" data-catParent="{{$categoryLevel2['category_id']}}" onclick="fetchmodal(this)" href="javascript:;" class="c-blue" data-toggle="modal" data-target="#exampleModal"><span><i class="fa fa-plus-square-o"></i> Add Sub Category</span></a>
							</li>
                          </ul>
                        </li>
                       @endforeach
						
						<li class="level3 nav-6-1 parent item pd-20">
							<center>
								<a onclick="fetchmodal(this)" data-parent="{{$categoryLevel1['id']}}" data-catParent="{{$categoryLevel1['category_id']}}" href="javascript:;" data-toggle="modal" data-target="#exampleModal">
									<h1><i class="fa fa-plus-square-o"></i>
									<br/>ADD CATEGORY</h1>
								</a>
							</center>
                        </li>
                      </ul>
                      <!--level0--> 
                    </div>
                    <!--nav-block nav-block-center--> 
                  </div>
                  <!--level0-wrapper2--> 
                </div>
                <!--container--> 
              </div>
              <!--level0-wrapper dropdown-6col--> 
              <!--mega menu--> 
            </li>
            @endforeach
			<li class="mega-menu"> <a class="level-top btn-category" id="tarun" href="javascript:;" onclick="fetchmodal(this)" data-parent="0" data-catParent="0" data-toggle="modal" data-target="#exampleModal"><span><i class="fa fa-plus"></i> Category</span></a> </li>
			<!-- <li class="mega-menu"> <a class="level-top btn-category btn-categorydel" data-parent="0" href="javascript:;"><span><i class="fa fa-minus"></i> Delete Category</span></a> </li> -->
          </ul>
          <!--nav--> 
        </div>
      </div>
    </nav>
    
    
    <!-- end nav --> 
  </header>
 
  
  <div class="content-page">
    <div class="container">
      <div class="row"> 
        <div class="spacer">
		</div>
        
        
      </div>
    </div>
  </div>
  
  
<!-- End Footer --> 
				<!-- Footer -->
				<footer class="footer">
					<div class="container-fluid">
						<div class="row text-xs-center">
							<div class="col-sm-4 text-sm-left mb-0-5 mb-sm-0">
								2016 © Neptune
							</div>
							<div class="col-sm-8 text-sm-right">
								<ul class="nav nav-inline l-h-2">
									<li class="nav-item"><a class="nav-link text-black" href="#">Privacy</a></li>
									<li class="nav-item"><a class="nav-link text-black" href="#">Terms</a></li>
									<li class="nav-item"><a class="nav-link text-black" href="#">Help</a></li>
								</ul>
							</div>
						</div>
					</div>
				</footer>
			</div>
		</div>
		<!-- popup start -->
		<div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="exampleModalLabel">Save Category</h4>
					</div>
					<div class="modal-body">
					</div>
				</div>
			</div>
		</div>
    <!-- popup ends  -->
@endsection
