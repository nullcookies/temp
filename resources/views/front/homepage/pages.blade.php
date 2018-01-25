@extends('front.layouts.front_master')

@section('title')
| Ecommerce website Pages
@endsection




@section('content')
<div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <ul>
            <li class="home"> <a title="Go to Home Page" href="index.html">Home</a> <span>/</span> </li>
            <li class="category1601"> <strong>{!! $pages->name !!}</strong> </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
   <!-- main-container -->
  <div class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
        <section class="col-sm-9 wow bounceInUp animated">
        <div class="col-main">
          <div class="page-title">
            <h2>{!! $pages->name !!}</h2>
          </div>
          <div class="static-contain">
            {!! $pages->content !!}
          </div>

          </div>
        </section>
        <aside class="col-right sidebar col-sm-3 wow bounceInUp animated">
          <div class="block block-company">
            <div class="block-title">Quick Link </div>
            <div class="block-content">
              <ol id="recently-viewed-items">
              @foreach($pagesTT as $value)
              @if($pages->alias == $value->alias)
                <li class="item odd"><strong>{{ $value->name }}</strong></li>
              @else
                <li class="item even"><a href="{{ url('pages/'.$value->alias) }}">{{ $value->name }}</a></li>
              @endif
              @endforeach               
                
              </ol>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>
  <!--End main-container --> 

@endsection