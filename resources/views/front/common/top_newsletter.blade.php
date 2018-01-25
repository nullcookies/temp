<?php 
$footerObj = new App\Http\Controllers\Front\Homepage\HomeController;
$result = $footerObj->commonpage();
$ft = $result['homesetting'];
 ?>
<!-- Newsletter and social widget -->
  <div class="subscribe-area hidden-xs">
    <div class="container">
      <div class="subscribe-container">
        <div class="row">
          <div class="col-md-12">
            <div class="subscribe">
              <div class="subscribe-title">              
                <label>Sign Up for Our Newsletter:</label>                
              </div>                            
              {{ Form::open(['method' => 'post', 'id'=> 'subscribe-form', 'action' => ['Front\Search\SearchController@newsletter']]) }}
                <div class="subscribe-content">
                  <input type="text" id="subscribe-input" name="email">                   
                  <button class="button" type="submit"><span>Subscribe</span></button>                  
                </div>
               @if(isset($errors) && $errors->has('email'))<span class="text-danger">{{$errors->first('email')}}</span>@endif
              {{ Form::close()}}
              @if(Session::has('success'))
              <script>             
                alert("{!! Session::get('success') !!}");
              </script>             
              @endif
            </div>
            <div class="subscribe-text-link">
              <div class="subscribe-link">
                <ul class="social-link">
                @if(isset($socialmedia))
                @foreach($socialmedia as $social)
                  <li><a href="{!! $social->link !!}" title="{{ $social->name}} "><i class="fa fa-{{$social->slug}}"></i></a></li>
                @endforeach
                @endif
                  <!-- <li><a href="#"><i class="fa fa-rss"></i></a></li>
                  <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                  <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                  <li><a href="#"><i class="fa fa-google-plus"></i></a></li> -->
                </ul>
                <p class="discount-text">{!! $ft->socialright !!}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Newsletter and social widget end--> 