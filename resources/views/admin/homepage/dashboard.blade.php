@extends('admin/layouts/layout')

@section('title')
	| dashboard
@endsection

@section('pageTopScripts')
    <link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/chartist/chartist.min.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
	<link rel="stylesheet" href="{{asset('css/sweetalert.css')}}"/>
	<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/nprogress/nprogress.css')}}">
	<style>
	.pd-3{
		padding:35px 1.25rem;
	}
	.pdb-0{
		padding-bottom:0px;
	}
	.dash-table th{
		vertical-align: middle;
	}
	.newth th{
		border-bottom:0 !important;
	}
	.tdintd{
		padding:0 !important;
		border-top:0 !important; 
	}
    .pdl0{
	    padding-left:0px;
	}
	.pdr0{
	    padding-right:0px;
	}
    .borrg{border: 1px solid rgba(0,0,0,.125);}
    .nav-tabs {
        border:0;
    }
    .nav-tabs .nav-link.active{
        border:0;
    }


</style>

<style>
		.custom-checkbox{
		    position: relative !important;
			display: inline-block !important;
			padding-left: 1.5rem !important;
			cursor: pointer !important;
			margin:0 !important;
		}
		.
		.pd-0{
			padding:0;
		}
		.center{
			text-align:center;
		}
		.wd45{
			width:45px;
		}
		.dropdown-more24 li{
			padding:20px 0;
		}
		</style>
@endsection

@section('pageScripts')
	<script src="{{asset('js/sweetalert.min.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/nprogress/nprogress.js')}}"></script>
	<script>
		
		$(document).ready(function(){
			$('#checklistForm').on('submit', function(event){
				event.preventDefault();
				var formdata = jQuery(this).serialize();
				/*sweet alert*/
				swal({
			        title: "Are you sure?",
			        type: "warning",
			        showCancelButton: true,
			        confirmButtonColor: '#DD6B55',
			        confirmButtonText: 'Yes',
			        cancelButtonText: "No",
			        closeOnConfirm: true,
			        closeOnCancel: false
			    },
			    function(isConfirm) {
			        if (isConfirm) {
			            $.ajax({
			            	url: "{{url('/admin/updateChecklist')}}",
			            	type: 'POST',
			            	data: formdata,
			            	dataType: 'json',
			            	beforeSend: function(){
			            		NProgress.start();
			            	},
			            	success: function(result){
			            		NProgress.done();
			            		if(result['fail']){
			            			swal(result['message'], "", "error");
			            		}
			            		if(result['success']){
			            			$('input[name='+result['attr']+']').attr('disabled','disabled');
			            			$('button[inputName='+result['attr']+']').attr('disabled','disabled');
			            			swal("Successfully Updated", "", "success");
			            		}
			            	}
			            });
			        } else {
			            swal("Cancelled", "", "error");
			        }
			    });
			    /*sweet alert*/
			});
		});
	</script>	

	<script>

	/* Main Chart */
    var data1 = [
    	@foreach($datewiseVisitors as $visitor)
    		[{{$visitor}}],
    	@endforeach
    ];
   
    var labels = ["Visits"];
    var colors = [
        '#20b9ae',
    ];

    $.plot($("#main-chart"), [{
        data : data1,
        label : labels[0],
        color : colors[0]
    }], {
        series : {
            lines : {
                show : true,
                fill : true,
                lineWidth : 3,
                fillColor : {
                    colors : [{
                        opacity : 1
                    }, {
                        opacity : 1
                    }]
                }
            },
            points : {
                show : true,
                radius: 0
            },
            shadowSize : 0,
            curvedLines: {
                apply: true,
                active: true,
                monotonicFit: true
            }
        },
        grid : {
            labelMargin: 10,
            color: "#aaa",
            hoverable : true,
            borderWidth : 0,
            backgroundColor : "#fff",
        },
        legend : {
            position : "ne",
            margin : [0, -40],
            noColumns : 0,
            labelBoxBorderColor : null,
            labelFormatter : function(label, series) {
                // adding space to labes
                return '' + label + '&nbsp;&nbsp;';
            }
        },
        tooltip : true,
        tooltipOpts : {
            content : '%s: %y',
            shifts : {
                x : -60,
                y : 25
            },
            defaultTheme : false
        }
    });
	</script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/chartist/chartist.min.js')}}"></script>
	<script>
/* =================================================================
  Bar Chart
================================================================= */

var data = {
  labels: [{{$graphDates}}],
  series: [
    [{{$normalOrderGraphData}}],
    [{{$apiOrderGraphData}}]
  ]
};

var options = {
  seriesBarDistance: 10
};

var responsiveOptions = [
  ['screen and (max-width: 640px)', {
    seriesBarDistance: 5,
    axisX: {
      labelInterpolationFnc: function (value) {
        return value[0];
      }
    }
  }]
];

new Chartist.Bar('#barCh', data, options, responsiveOptions);
	</script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>
	<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/index.js')}}"></script>
@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')

<div class="container-fluid">
						<div class="row">
							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-32">
								<div class="box-block bg-white tile tile-1 mb-2">
									<div class="t-icon right"><span class="bg-danger"></span><i class="ti-shopping-cart-full"></i></div>
									<div class="t-content">
										<h6 class="text-uppercase mb-1 mb-32">Orders</h6>
										<h1 class="mb-1">{{$total_count}}</h1>
										<span class="text-muted"><span class="orders-number">{{$diffFromTodayAndYesterday}}</span>&nbsp; from previous day</span>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
								<div class="box-block bg-white tile tile-1 mb-2">
									<div class="t-icon right"><span class="bg-success"></span><i class="ti-bar-chart"></i></div>
									<div class="t-content">
										<h6 class="text-uppercase mb-1 mb-30">Delayed Orders</h6>
										<h1 class="mb-1">{{$criticalOrders}}</h1>
										<span class="text-muted"><span class="orders-number"><i class="fa fa-inr"></i>{{$criticalOrdersValue ? $criticalOrdersValue : 0}}</span>&nbsp; Total Value</span>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
								<div class="box-block bg-white tile tile-1 mb-2">
									<div class="t-icon right"><span class="bg-primary"></span><i class="ti-package"></i></div>
									<div class="t-content">
										<h6 class="text-uppercase mb-1">Returns</h6>
										<h1 class="mb-1">{{$return_count}}</h1>
										<span class="text-muted"><span class="returns-number">{{$returnDiff}}</span>&nbsp; From Last Month</span>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-30">
								<div class="box-block bg-white tile tile-1 mb-2">
									<div class="t-icon right"><span class="bg-warning"></span><i class="ti-receipt"></i></div>
									<div class="t-content">
										<h6 class="text-uppercase mb-1 mb-30">Total Revenue</h6>
										<h1 class="mb-1"><i class="fa fa-inr"></i> {{$totalRevenue}}</h1>
										<span class="text-muted"><i class="fa fa-line-chart fa-line-chart-custom"></i>&nbsp; Your total Revenue</span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="container-fluid">
						<div class="col-md-8 pdl0">
							<div class="row row-md">
						</div>
						<ul class="nav nav-tabs" role="tablist" style="background-color:#fff;>
							<li class="nav-item">
								<a class="nav-link active" href="#">Visitors Graph</a>
							</li>
							
						</ul>
						<div class="box-block bg-white b-t-0 mb-2">
							<div class="chart-container demo-chart">
								<div id="main-chart" class="chart-placeholder"></div>
							</div>
						</div>
						</div>
						@if($checklist && $checklist->checked_everything == 'yes')
						<div class="col-md-4">
							<a class="dropdown-more dropdown-more2" href="{{url('admin/notices')}}">
								<strong>View all notifications</strong>
							</a>
						<div class="bg-white dropdown-more23">
							@foreach($notifications as $notification)
								<div class="m-item m-item2">
									<div class="mi-icon bg-info"><i class="ti-comment"></i></div>
									<div class="mi-text">{!! substr($notification->title,0,50) !!}</div>
									<div class="mi-text">{!! substr($notification->content,0,100) !!}</div>
									<div class="mi-time">{!! $notification->created_at !!}</div>
								</div>
							@endforeach
						</div>
						</div>
						@endif

						@if(!$checklist || $checklist->checked_everything == 'no')
						<div class="col-md-4 store-checkup-list" style="padding:0px;">
							<a class="dropdown-more dropdown-more2" href="#">
								<strong>Check List</strong>
							</a>
							{!! Form::open() !!}
								<input type="hidden" id="selected_checkbox_val" name="selected_checkbox_val" value="" >
								<ul class="dropdown-more24">
									<li>
										<div class="col-sm-9 pd-0">
										<label class="custom-control custom-checkbox">
											<input type="checkbox" {{$checklist && $checklist->personal_details_checked == 'yes' ? 'checked ' : ''}} disabled name="personal_details_checked" class="custom-control-input">
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description">Enter Your Personal Details</span>
										</label>
										</div>
										<div class="col-sm-3 center">
											<a type="button" href="{{$checklist && $checklist->personal_details_checked == 'yes' ? 'javascript:;' : url('/admin/setting')}}" class="btn btn-{{$checklist && $checklist->personal_details_checked == 'yes' ? 'success' : 'danger'}} btn-sm mb-0-25 wd45 waves-effect waves-light">{{$checklist && $checklist->personal_details_checked == 'yes' ? 'Done' : 'Edit'}}</a>
										</div>
									</li>
									<li>
										<div class="col-sm-9 pd-0">
										<label class="custom-control custom-checkbox">
											<input type="checkbox"  name="business_details_checked" class="custom-control-input" {{$checklist && $checklist->business_details_checked == 'yes' ? 'checked' : ''}} disabled >
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description">Enter Your Business Details</span>
										</label>
										</div>
										<div class="col-sm-3 center">
											<a type="button" href="{{$checklist && $checklist->business_details_checked == 'yes' ? 'javascript:;' : url('/admin/setting')}}" class="btn btn-{{$checklist && $checklist->business_details_checked == 'yes' ? 'success' : 'danger'}} btn-sm mb-0-25 wd45 waves-effect waves-light">{{$checklist && $checklist->business_details_checked == 'yes' ? 'Done' : 'Edit'}}</a>
										</div>
									</li>
									<li>
										<div class="col-sm-9 pd-0">
										<label class="custom-control custom-checkbox">
											<input type="checkbox" name="bank_details_checked" class="custom-control-input" {{$checklist && $checklist->bank_details_checked == 'yes' ? 'checked' : ''}} disabled >
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description">Enter Your Bank Details</span>
										</label>
										</div>
										<div class="col-sm-3 center">
											<!-- <button type="submit" inputName="bank_details_checked" onclick="$('#selected_checkbox_val').val('bank_details_checked')" class="btn btn-success btn-sm mb-0-25 wd45 waves-effect waves-light" {{$checklist && $checklist->bank_details_checked == 'yes' ? 'disabled' : ''}} >Done</button> -->
											<a type="button" href="{{$checklist && $checklist->bank_details_checked == 'yes' ? 'javascript:;' : url('/admin/setting')}}" class="btn btn-{{$checklist && $checklist->bank_details_checked == 'yes' ? 'success' : 'danger'}} btn-sm mb-0-25 wd45 waves-effect waves-light">{{$checklist && $checklist->bank_details_checked == 'yes' ? 'Done' : 'Edit'}}</a>
										</div>
									</li>
									<li>
										<div class="col-sm-9 pd-0">
										<label class="custom-control custom-checkbox">
											<input type="checkbox" name="upload_logo_checked" class="custom-control-input" {{$checklist && $checklist->upload_logo_checked == 'yes' ? 'checked ' : ''}} disabled>
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description">Upload Logo</span>
										</label>
										</div>
										<div class="col-sm-3 center">
											<!-- <button type="submit" inputName="upload_logo_checked" onclick="$('#selected_checkbox_val').val('upload_logo_checked')" class="btn btn-success btn-sm mb-0-25 wd45 waves-effect waves-light">Done</button> -->
											<a type="button" href="{{$checklist && $checklist->upload_logo_checked == 'yes' ? 'javascript:;' : url('admin/website-setting/add?cid=1')}}" class="btn btn-{{$checklist && $checklist->upload_logo_checked == 'yes' ? 'success' : 'danger'}} btn-sm mb-0-25 wd45 waves-effect waves-light">{{$checklist && $checklist->upload_logo_checked == 'yes' ? 'Done' : 'Edit'}}</a>

										</div>
									</li>
									<li>
										<div class="col-sm-9 pd-0">
										<label class="custom-control custom-checkbox">
											<input type="checkbox" name="upload_product_checked" class="custom-control-input" disabled {{$checklist && $checklist->upload_product_checked == 'yes' ? 'checked' : ''}}>
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description">Upload Products</span>
										</label>
										</div>
										<div class="col-sm-3 center">
											<!-- <button type="submit" inputName="upload_product_checked" onclick="$('#selected_checkbox_val').val('upload_product_checked')" class="btn btn-success btn-sm mb-0-25 wd45 waves-effect waves-light">Done</button> -->
											<a type="button" href="{{$checklist && $checklist->upload_product_checked == 'yes' ? 'javascript:;' : url('/admin/product/upload')}}" class="btn btn-{{$checklist && $checklist->upload_product_checked == 'yes' ? 'success' : 'danger'}} btn-sm mb-0-25 wd45 waves-effect waves-light">{{$checklist && $checklist->upload_product_checked == 'yes' ? 'Done' : 'Edit'}}</a>

										</div>
									</li>
									<li>
										<div class="col-sm-9 pd-0">
										<label class="custom-control custom-checkbox">
											<input type="checkbox" name="setted_marketplace_product" class="custom-control-input" disabled {{$checklist && $checklist->setted_marketplace_product == 'yes' ? 'checked' : ''}}>
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description">Set Marketplace Commissions</span>
										</label>
										</div>
										<div class="col-sm-3 center">
											<!-- <button type="submit" inputName="setted_marketplace_product" onclick="$('#selected_checkbox_val').val('setted_marketplace_product')" class="btn btn-success btn-sm mb-0-25 wd45 waves-effect waves-light">Done</button> -->
											<a type="button" href="{{$checklist && $checklist->setted_marketplace_product == 'yes' ? 'javascript:;' : url('/admin/commission')}}" class="btn btn-{{$checklist && $checklist->setted_marketplace_product == 'yes' ? 'success' : 'danger'}} btn-sm mb-0-25 wd45 waves-effect waves-light">{{$checklist && $checklist->setted_marketplace_product == 'yes' ? 'Done' : 'Edit'}}</a>

										</div>
									</li>
									<li>
										<div class="col-sm-9 pd-0">
										<label class="custom-control custom-checkbox">
											<input type="checkbox" name="manage_homepage_checked" class="custom-control-input" disabled {{$checklist && $checklist->manage_homepage_checked == 'yes' ? 'checked' : ''}}>
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description">Manage Your Homepage</span>
										</label>
										</div>
										<div class="col-sm-3 center">
											<!-- <button type="submit" inputName="manage_homepage_checked" onclick="$('#selected_checkbox_val').val('manage_homepage_checked')" class="btn btn-success btn-sm mb-0-25 wd45 waves-effect waves-light">Done</button> -->
											<a type="button" href="{{$checklist && $checklist->manage_homepage_checked == 'yes' ? 'javascript:;' : url('/admin/homepage')}}" class="btn btn-{{$checklist && $checklist->manage_homepage_checked == 'yes' ? 'success' : 'danger'}} btn-sm mb-0-25 wd45 waves-effect waves-light">{{$checklist && $checklist->manage_homepage_checked == 'yes' ? 'Done' : 'Edit'}}</a>
										</div>
									</li>
									<li>
										<div class="col-sm-9 pd-0">
										<label class="custom-control custom-checkbox">
											<input type="checkbox"  name="manage_navigation_checked" class="custom-control-input" disabled {{$checklist && $checklist->manage_navigation_checked == 'yes' ? 'checked' : ''}}>
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description">Manage Navigation</span>
										</label>
										</div>
										<div class="col-sm-3 center">
											<!-- <button type="submit" inputName="manage_navigation_checked" onclick="$('#selected_checkbox_val').val('manage_navigation_checked')" class="btn btn-success btn-sm mb-0-25 wd45 waves-effect waves-light">Done</button> -->
											<a type="button" href="{{$checklist && $checklist->manage_navigation_checked == 'yes' ? 'javascript:;' : url('admin/homepage/nav')}}" class="btn btn-{{$checklist && $checklist->manage_navigation_checked == 'yes' ? 'success' : 'danger'}} btn-sm mb-0-25 wd45 waves-effect waves-light">{{$checklist && $checklist->manage_navigation_checked == 'yes' ? 'Done' : 'Edit'}}</a>

										</div>
									</li>
								</ul>
							{!! Form::close() !!}
						</div>
						@endif
						<div class="row mb-2 mt-15">
						<div class="col-md-12 table-mobile">
							<table class="table table-grey-head mb-md-0 dash-table">
								<thead>
									<tr>
										<th rowspan="2">#</th>
										<th rowspan="2" width="9%">Order Type</th>
										<th rowspan="2">Price</th>
										<th rowspan="2" width="11.2%">Shipping Charge</th>
										<th rowspan="2" width="9%">Order Status</th>
									</tr>
									<tr class="newth">
										<th>Product UPC</th>
										<th>Product Name</th>
										<th>Qty</th>
										<th>Varients</th>
										<th>Selling Price</th>
										<th>Order Status</th>
									</tr>
								</thead>
								<tbody>
									@foreach($dashboardOrders as $key => $dashboardOrder)
										<tr>
											<th rowspan="{{count($products[$dashboardOrder->id])+1}}" scope="row">{{$key+1}}</th>
											<td rowspan="{{count($products[$dashboardOrder->id])+1}}" ><span style="text-transform: uppercase;">{{strlen($dashboardOrder->paymentType) ? $dashboardOrder->paymentType : 'Online Payment'}}</span></td>
											<td rowspan="{{count($products[$dashboardOrder->id])+1}}"><i class="fa fa-inr"></i> {{$dashboardOrder->orderAmount}}</td>
											<td rowspan="{{count($products[$dashboardOrder->id])+1}}"><i class="fa fa-inr"></i> {{intval($dashboardOrder->shippingCharge)}}</td>
											<td rowspan="{{count($products[$dashboardOrder->id])+1}}"><span style="width:60px; text-align:center" class="tag {{$class[$dashboardOrder->id]}}">{{$dashboardOrder->status}}</span></td>
											<td colspan="5" class="tdintd">
												@foreach($products[$dashboardOrder->id] as $product)
												<tr>
													<td>{{$product->product_id}}</td>
													<td title="{{$product->product_name}}">{{substr($product->product_name,0,35)}}</td>
													<td>{{$product->quantity}}</td>
													<td>{{$product->varients}}</td>
													<td>{{$product->selling_price}}</td>
													<td ><a href="{{url('/admin/orders/trackOrder/'.$dashboardOrder->id)}}" class="btn btn-sm btn-info btn-rounded mb-0 w-min-xs waves-effect waves-light">More info</a></td>
												</tr>
												@endforeach
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
					<div class="box-block pdl0 pdr0">
						<div class="row" style="margin:0; margin-left:-15px;">
						<div class="col-md-6">
							<div class="card">
								<div class="card-block b-b clearfix">
									<h5 style="padding:10px 0;">Inventory</h5>
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<div class="box-block tile tile-2 bg-danger mb-2 pd-3">
												<div class="t-icon right"><i class="ti-shopping-cart-full"></i></div>
												<div class="t-content">
													<h1 class="mb-1">{{$inventory->count}}</h1>
													<h6 class="text-uppercase">Your products</h6>
												</div>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<div class="box-block tile tile-2 bg-primary mb-2 pd-3">
												<div class="t-icon right"><i class="ti-package"></i></div>
												<div class="t-content">
													<h1 class="mb-1">10,000,00+</h1>
													<h6 class="text-uppercase">Marketplace product</h6>
												</div>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<div class="box-block tile tile-2 bg-success mb-2 pd-3">
												<div class="t-icon right"><i class="ti-bar-chart"></i></div>
												<div class="t-content">
													<h1 class="mb-1">{{$inventory->instock}}</h1>
													<h6 class="text-uppercase">Instock</h6>
												</div>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<div class="box-block tile tile-2 bg-warning mb-2 pd-3">
												<div class="t-icon right"><i class="ti-receipt"></i></div>
												<div class="t-content">
													<h1 class="mb-1">{{$inventory->count - $inventory->instock }}</h1>
													<h6 class="text-uppercase">Outstock</h6>
												</div>
											</div>
										</div>
									</div>	
								</div>
							</div>
						</div>
						<div class="col-md-6 bg-white">
								<div class="box-block pdb-0">
									<h5 class="mb-1">Sales Chart</h5>
									<div class="legend">
										<div style="position: absolute; width: 173px; height: 18px; top: 15px; right: 6px; background-color: rgb(255, 255, 255); opacity: 0.85;"> </div>
										<table style="position:absolute;top:15px;right:6px;;font-size:smaller;color:#aaa">
											<tbody>
												<tr>
													<td class="legendColorBox">
														<div style="border:1px solid null;padding:1px">
															<div style="width:4px;height:0;border:5px solid #43b968;overflow:hidden"></div>
														</div>
													</td>
													<td class="legendLabel">Your Products&nbsp;&nbsp;</td>
													<td class="legendColorBox">
														<div style="border:1px solid null;padding:1px">
															<div style="width:4px;height:0;border:5px solid #3e70c9;overflow:hidden"></div>
														</div>
													</td>
													<td class="legendLabel">Marketplace Product&nbsp;&nbsp;</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div id="barCh" class="chart-container"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
@endsection