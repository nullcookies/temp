@extends('admin/layouts/layout')

@section('title')
| Homepage Social Media
@endsection

@section('pageTopScripts')

<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}">	
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
<style type="text/css">
    .dropify{height: 80px;width: 80px;}
</style>
@endsection

@section('pageScripts')

<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script>	

@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">       
        <ol class="breadcrumb no-bg mb-1">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
            <li class="breadcrumb-item active">Homepage Tag Products</li>
        </ol>
        

        <div class="box box-block bg-white">
            <div class="row header-row">
                <h3 class="head-position">{{ $item->tag }}</h3>
                <ul class="demo-header-actions">                    
                    <li class="demo-tabs"><a href="{{ url('admin/product/addTagProducts/'.$item->id) }}" class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light">Add New</a></li>
                    
                </ul>
            </div>  
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
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
                @foreach ($products as $key => $product)
                <tr>
                     <td>{{ ++$i }}</td>
                    <td><a href="{{ $product->link }}">{{ $product->name }}</a></td>
                    <td>                                                               
                        <img src="{{url('products-images/'.$product->image)}}" class="dropify">
                    </td>
                    <td>{{ $product->old_price }}</td>
                    <td>{{ $product->new_price }}</td>
                    <td>{{ $product->rating }}</td>                    

                    <td>                        
                        <a class="btn btn-primary" href="{{ url('admin/product/editTagProducts/'.$product->id) }}">Edit</a>
                        {!! Form::open(['method' => 'DELETE','action' => ['Admin\Product\HomepageTagController@deleteTagProducts', $product->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
        </table>
            {!! $products->render() !!}
            
        </div>
    </div>
</div>
@endsection
