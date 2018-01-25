@extends('massengers/layout/layout')

@section('css')

<style>
    .bg-black {
    background-color: #000;
    	height: 50px !important;
    }
    .categorylist .back-color{
        background-color: #D80003 !important;
        opacity: 0;
        
    }
    
    .categorylist .lastone{
        height:0px;
    }
    .categorylist .lastone:hover .back-color{
        opacity: 1;
        transition: all .5s;
    }
    .categorylist .back-color-ul{
        position: relative;
        top:23px;
        left: -60px;
        z-index: 1;
    }
    .categorylist .radio label {
	    min-height: 20px;
	    padding-left: 20px;
	    margin-bottom: 0;
	    font-weight: 700;
	    font-variant: small-caps;
	    cursor: pointer;
	    color: #f5f5f5;
	}
    .categorylist li a {
	    text-align: center;
	    padding-bottom: 30px;
	    padding-left: 30px;
	    padding-right: 30px;
	    text-decoration: none;
    }
    
    .categorylist .back-color-ul input[type='radio']:after {
        width: 17px;
        height: 17px;
        border-radius: 0px;
        top: -4px;
        left: -1px;
        position: relative;
        background-color: #fff;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 1px solid #333;
        cursor: pointer;
    }

    .categorylist .back-color-ul input[type='radio']:checked:after {
        width: 17px;
        height: 17px;
        border-radius: 0px;
        top: -4px;
        left: -1px;
        position: relative;
        background-color: #fff;
        content: '\f00c';
        font-family: FontAwesome;
        cursor: pointer;
        bottom: -6px;
        color: #000;
        display: inline-block;
        visibility: visible;
        border: 1px solid #000;
        padding-top: -3px;
    }
    .gift-type {
    display: none;
    position: absolute;
    background-color: #d80003;
    margin-top: 5px;
    z-index: 1;
    height: 200px;
    width: 200px;
    border-bottom-right-radius: 5px;
    border-bottom-left-radius: 5px;
    max-height: 200px;
    overflow-y: auto;
    top: 550px;
    }
    
</style>

@endsection

@section('js')
	<script>
		$(document).ready(function(){
			$('#subcategoryselect').on('change', function(event){
				var location = "{{url('/category/')}}"+ '/' + $(this).val();
				window.location.href = location;
			});

			$('#productsortby').on('change', function(event){
				var full_location = "{{URL::current()}}";
				var queryVar = full_location.includes('?') ? '&' : '?';
				var location = full_location+queryVar+'sort_by=' + $(this).val();
				window.location.href = location;
			});

			$('#priceselect').on('change', function(event){
				var full_location = "{{URL::current()}}";
				var queryVar = full_location.includes('?') ? '&' : '?';
				var location = full_location+queryVar+'price=' + $(this).val();
				window.location.href = location;
			});

		});
	</script>

	<script>
		
		$(document).ready(function(){
			$("input[name=pricefilter]").on('change', function(){
				$('#pricefilterform').submit();
			});
		})

	</script>
@endsection

@section('content')
<!--<div class="container-fluid nt-header1">
</div>-->
<img src="{{$banner}}" style="width:100%;" class="img-responsive"> 
<div class="container-fluid">
	<div class="container">
	    <div class="breadcrumbers">
		<ol class="breadcrumb ms-breadcrumb">
			<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
			@foreach($breadCrumbCategories as $breadCrumbCategory)
			  <li class="breadcrumb-item"><a href="{{url('/category/'.$breadCrumbCategory['alias'])}}">{{$breadCrumbCategory['category_name']}}</a></li>
			@endforeach
		</ol>
		</div>
		<ul class="sort-list">
			<li>Sort by :</li>
			<select id="productsortby" class="pd-5">
				<option value="">Select</option>
				<option value="price_asc">Low Price First</option>
				<option value="price_desc">High Price First</option>
				<option value="product_desc">Latest Product First</option>
			</select>
		</ul>
	</div>
</div>
<!--<div class="container-fluid bg-black">
	<div class="container">
		<div class="row">
			<ul class="need-today-list">
				<li><label for="subcategoryselect">{{$category_name}}</label>
					@if(count($categories))
					<select id="subcategoryselect" class="nt-select">
						<option value="">Select</option>
						@foreach($categories as $childcategory)
							<option value="{{$childcategory['alias']}}">{{$childcategory['category']}}</option>
						@endforeach
					</select>
					@endif
				</li>
			</ul>
			<ul class="price-list">
				<select id="priceselect" class="nt-select">
					<option>Price</option>
					<option value="100">100</option>
					<option value="200">200</option>
					<option value="500">500</option>
					<option value="1000">1000</option>
					<option value="2000">2000</option>
				</select>
			</ul>
		</div>		
	</div>
</div>-->

<div class="container-fluid bg-black hidden-xs">
	<div class="container roboto-light">
		<customnav>
			<ul class="categorylist">
			    @if(count($categories))
				<li class="gift-main">
					<a href="javascript:;">Subcategories <i class="fa fa-angle-down"></i><br/><span>{{$category_name}}</span></a> 
					<div class="gift-type">
						<ul class="seclevel">
						    @foreach($categories as $category)
							<li>
								<a href="{{url('/category/'.$category['alias'])}}">{{$category['category']}}</a>
							</li>
							@endforeach
						</ul>
					</div>
				</li>
				@endif
				<li class="gift-main">
					<a href="#">Occasion <i class="fa fa-angle-down"></i><br/><span>&nbsp; &nbsp;</span></a> 
					<div class="gift-type">
						<ul class="seclevel">
							<li>
								<a href="{{url('/category/birthday')}}">Birthday</a>
							</li>
							<li>
							    <a href="{{url('/category/anniversary')}}">Anniversary</a>
							</li>
							<li>
							    <a href="{{url('/category/wedding')}}">Wedding</a>
							</li>
							<li>
							    <a href="{{url('/category/get-well-soon')}}">Get Well Soon</a>
							</li>
						</ul>
					</div>
				</li>
				<li class="gift-main">
					<a href="#">Available Delivery <i class="fa fa-angle-down"></i><br/><span>Cities</span></a> 
					<div class="gift-type">
						<ul class="seclevel">
							<li>
								<a href="javascript:;">Delhi</a>
							</li>
							<li>
								<a href="javascript:;">Ghaziabaad</a>
							</li>
							<li>
								<a href="javascript:;">Noida</a>
							</li>
							<li>
								<a href="javascript:;">Faridabad</a>
							</li>
							<li>
								<a href="javascript:;">Gurgaon</a>
								
							</li>
						</ul>
					</div>
				</li>
				<li class="lastone pull-right" style="margin-right:-140px"><a href="" style="color:#fff">Price &nbsp;&nbsp;<span class="glyphicon glyphicon-menu-down"></span></a>
				
				<ul class="back-color-ul">
				    <li class="back-color">
				        <form action="{{URL::current()}}" id="pricefilterform" method="GET">
				            <div class="radio">
                              <label>
                                <input type="radio" name="pricefilter" id="optionsRadios1" value="0_1000">&nbsp;
                                Below <span></span> 1000 (57)
                              </label>
                            </div>
                            
                            <div class="radio">
                              <label>
                                <input type="radio" name="pricefilter" id="optionsRadios2" value="1000_0">&nbsp;
                                <span></span> 1000 + (124)
                              </label>
                            </div>
                            
                            <div class="radio">
                              <label>
                                <input type="radio" name="pricefilter" id="optionsRadios2" value="1500_0">&nbsp;
                                <span></span> 1500 + (77)
                              </label>
                            </div>
                            
                            <div class="radio">
                              <label>
                                <input type="radio" name="pricefilter" id="optionsRadios2" value="2000_0">&nbsp;
                                <span></span> 2000 + (7)
                              </label>
                            </div>
                            
                            <div class="radio">
                              <label>
                                <input type="radio" name="pricefilter" id="optionsRadios2" value="2500_0">&nbsp;
                                <span></span> 2500 And Above (175)
                              </label>
                            </div>
                            
				        </form>
				    </li>
				</ul>
				
				</li>
			</ul>
		</customnav>
		<!--<div class="price-selection">
			<a href="#">Price <i class="fa fa-chevron-down"></i><br/><span>Delhi</span></a>
			<div class="price-type">
				<div class="newscroll">
					<ul>
						<li><a href="#">Flowers</a></li>
						<li><a href="#">Flowers</a></li>
						<li><a href="#">Flowers</a></li>
						<li><a href="#">Flowers</a></li>
						<li><a href="#">Flowers</a></li>
						<li><a href="#">Flowers</a></li>
						<li><a href="#">Flowers</a></li>
						<li><a href="#">Flowers</a></li>
					</ul>
				</div>
			</div> 
		</div>-->
	</div>
</div>
<div class="container-fluid">
	<div class="container">
		<div class="row nt-row">
		    <div class="infinite-scroll" style="">
		@foreach($products as $key => $product)
			@if($product_center == 'no') 
			<div class="col-md-3 col-sm-4 col-xs-6 nt-pro-box">
			    <div class="newnt">
    				<a href="{{url('category/'.$cat_alias.'/product/'.$product->id)}}">
    					<img width="200" src="{{$productImage[$product->id]}}"/>
    				</a>	
					<h5>{{substr($product->product_name,0,23)}}</h5>
					<h4 class="c-red"><i class="fa fa-inr"></i> {{$product->product_selling_price}}</h4>
					<p class="delivery-available">Delivery Available: <span style="color:#d80003">Today</span></p>
    			</div>	
			</div>
			
			@else
			    <center>
			    <div class="col-md-3 col-sm-4 @if($key==0) ml-30 @endif col-xs-6 nt-pro-box">
    			    <div class="newnt">
        				<a href="{{url('category/'.$cat_alias.'/product/'.$product->id)}}">
        					<img width="200" src="{{$productImage[$product->id]}}"/>
        				</a>	
    					<h5>{{substr($product->product_name,0,23)}}</h5>
    					<h4 class="c-red"><i class="fa fa-inr"></i> {{$product->product_selling_price}}</h4>
    					<p class="delivery-available">Delivery Available: <span style="color:#d80003">Today</span></p>
        			</div>	
    			</div>
			</center>
			@endif
		@endforeach
		@if(count($products))
        	<center>{!! $products->render() !!}</center>
        @endif
		   </div>
		</div>
	</div>
</div>	


@endsection