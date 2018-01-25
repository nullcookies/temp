@extends('admin/layouts/layout')

@section('title')
| {{$title}}
@endsection

@section('pageTopScripts')
<style>
</style>

<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">	
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/sweetalert2/sweetalert2.min.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/switchery/dist/switchery.min.css')}}">
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/vendor/nprogress/nprogress.css')}}">
@endsection

@section('pageScripts')

<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>	
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/switchery/dist/switchery.min.js')}}"></script>	
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/sweetalert2/sweetalert2.min.js')}}"></script>	
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/vendor/nprogress/nprogress.js')}}"></script>
<script type="text/javascript">
	$().ready(function(){
		$('input[name="filter"]').change(function() {
			getData(1);
		});
	});
	function getData(page) {
		var filter = $('input[name="filter"]:checked').val();
		var url = '<?php echo url("/admin/orders/return"); ?>';
		var str = '?page='+page+'&s='+filter;
		window.location.href = url+str;		
	}
	function changeStatus (id,status,oid) {
		$.ajax({
			url: "{{url('admin/orders/updateStatus')}}",
			type: 'POST',
			dataType: 'html',
			data: {id: id,status:status,oid:oid},
			beforeSend: function(){
				NProgress.start();
			},
			success: function(result){				
				if (result != '') {
                    $("#action" + id).parents("tr").hide();
                    $("#totalCount").html(parseInt($("#totalCount").html()) - 1);
                    swal("Success !", "Status changed successfully", "success");
                }
                NProgress.done();
			},
		});
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
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active">Orders</li>
		</ol>
		<div class="box box-block bg-white">
			<div class="row">
				<h3>{!! $title !!}</h3>
				<div class="pull-left">
					<span style="margin-right:20px;">Filter :</span>
					<span>
						<input type="radio" @if(isset($_GET['s']) && ($_GET['s'] == 'open')) checked="" @endif onclick="getData(<?php echo isset($_GET['page']) ?$_GET['page']:1 ?> )" name="filter" id="open" value="open"><label for="open">Open Return Request
					</label>
				</span>
				<span>
					<input type="radio" @if(isset($_GET['s']) && ($_GET['s'] == 'approve')) checked="" @endif onclick="getData(<?php echo isset($_GET['page']) ?$_GET['page']:1 ?> )" name="filter" id="approve" value="approve"><label for="approve">Approve Return Request</label>
				</span>
				<span>
					<input type="radio" @if(isset($_GET['s']) && ($_GET['s'] == 'reject')) checked="" @endif onclick="getData(<?php echo isset($_GET['page']) ?$_GET['page']:1 ?> )" name="filter" id="reject" value="reject"><label for="reject">Reject Return Request</label>
				</span>
			</div>

		</div>	
		@if(count($orders) > 0)
		<div class="row shipping-label table-mobile">
			<table class="table table-striped table-center">
				<thead>
					<tr><th>SN</th>
					<th class="br-1">Order Id</th>											
						<th class="br-1">Customer Name</th>
						<th class="br-1">Comment</th>
						<th class="br-1">Date</th>				 
						<th class="br-3">&nbsp; Action</th>
					</tr>
				</thead>
				<tbody id="ressult">			
				<?php $i = $orders->perPage() * ($orders->currentPage()-1); ?>			
					@foreach($orders as $order)
					<tr><td>{{ ++$i }}</td>
					<td>{!! $order->oid !!}</td>												
						<td>{!! $order->customerName !!}</td>
						<td>{!! $order->comment !!}</td>				 
						<td>{!! $order->date !!}</td>
						<td id="action{!! $order->id !!}"> 
						@if(!isset($_GET['s']) || ($_GET['s'] == 'open'))
							<a href="javascript:" onclick="changeStatus({{$order->id}}, 'approve',{{$order->oid}})" class="btn btn-success btn-rounded btn-sm mb-0-25 waves-effect waves-light" title="Approve">Approve</a>
							<a href="javascript:" onclick="changeStatus({{$order->id}}, 'reject',{{$order->oid}})" class="btn btn-danger btn-rounded btn-sm mb-0-25 waves-effect waves-light" title="Reject">Reject</a>
						@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			@if(count($orders) > 0)		 
			<div class="table-footer">
				<div class="col-md-3"><div class="dataTables_info" id="table-3_info" role="status" aria-live="polite">Total {{$orders->total()}} records</div></div>
				<div class="col-md-9">
				@include('admin.pagination.limit_links', ['paginator' => $orders])
				</div>
			</div>
			@endif			
		</div>	

		@else
		<div class="row shipping-label table-mobile">
			<div class="panel panel-default">
				<div class="panel-body">
					<p>No record found</p>
				</div>
			</div>
		</div>
		@endif

	</div>
</div>
</div>

@endsection
