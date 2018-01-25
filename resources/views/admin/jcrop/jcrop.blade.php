@extends('admin/layouts/layout')

@section('title')
| Laravel and Jcrop
@endsection

@section('pageTopScripts')
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}"> 
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/custom.css')}}">
<!-- <link rel="stylesheet" href="{{asset('jcrop/demos/demo_files/main.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('jcrop/demos/demo_files/demos.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('jcrop/css/jquery.Jcrop.css')}}" type="text/css" /> -->
<style type="text/css">

.jcrop-holder #preview-pane {
  display: block;
  position: absolute;
  z-index: 2000;
  top: 10px;
  right: -280px;
  padding: 6px;
  border: 1px rgba(0,0,0,.4) solid;
  background-color: white;

  -webkit-border-radius: 6px;
  -moz-border-radius: 6px;
  border-radius: 6px;

  -webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
  box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
}

/* The Javascript code will set the aspect ratio of the crop
   area based on the size of the thumbnail preview,
   specified here */
#preview-pane .preview-container {
  width: 250px;
  height: 170px;
  overflow: hidden;
}

</style>
@endsection

@section('pageScripts')

<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script> 
<!-- <script rel="stylesheet" src="{{asset(ADMIN_FILE_PATH.'js/jquery.min.js')}}"></script>
<script rel="stylesheet" src="{{asset('jcrop/js/jquery.Jcrop.js')}}"></script> -->
<script type="text/javascript">
  jQuery(function($){

    // Create variables (in this scope) to hold the API and image size
    var jcrop_api,
        boundx,
        boundy,

        // Grab some information about the preview pane
        $preview = $('#preview-pane'),
        $pcnt = $('#preview-pane .preview-container'),
        $pimg = $('#preview-pane .preview-container img'),

        xsize = $pcnt.width(),
        ysize = $pcnt.height();
    
    console.log('init',[xsize,ysize]);
    $('#target').Jcrop({
      onChange: updatePreview,
      onSelect: updatePreview,
      aspectRatio: xsize / ysize
    },function(){
      // Use the API to get the real image size
      var bounds = this.getBounds();
      boundx = bounds[0];
      boundy = bounds[1];
      // Store the API in the jcrop_api variable
      jcrop_api = this;

      // Move the preview into the jcrop container for css positioning
      $preview.appendTo(jcrop_api.ui.holder);
    });

    function updatePreview(c)
    {
      if (parseInt(c.w) > 0)
      {
        var rx = xsize / c.w;
        var ry = ysize / c.h;

        $pimg.css({
          width: Math.round(rx * boundx) + 'px',
          height: Math.round(ry * boundy) + 'px',
          marginLeft: '-' + Math.round(rx * c.x) + 'px',
          marginTop: '-' + Math.round(ry * c.y) + 'px'
        });
      }
    };

  });


</script>
@endsection

@section('bodyclass')
fixed-sidebar fixed-header skin-default content-appear
@endsection

@section('content')
<div class="container-fluid">
<ol class="breadcrumb no-bg mb-1">
    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
    <li class="breadcrumb-item active">Laravel and Jcrop</li>
  </ol>
<div class="box box-block bg-white">
<div class="span12">
<div class="row header-row">
<h3>Aspect Ratio with Preview Pane</h3>
  <img src="{{ $image }}" id="target" alt="[Jcrop Example]" />

  <div id="preview-pane">
    <div class="preview-container">
      <img src="{{ $image }}" class="jcrop-preview" alt="Preview" />
    </div>

  </div>
 <div class="bt">
     <?= Form::open() ?>
        <?= Form::hidden('image', $image) ?>
        <?= Form::hidden('x', '', array('id' => 'x')) ?>
        <?= Form::hidden('y', '', array('id' => 'y')) ?>
        <?= Form::hidden('w', '', array('id' => 'w')) ?>
        <?= Form::hidden('h', '', array('id' => 'h')) ?>
        <?= Form::submit('Crop it!', ['class'=>"btn btn-primary"]) ?>
        <?= Form::close() ?>
    </div>
  <!-- <div class="description">
  <p>
    <b>An example implementing a preview pane.</b>
      Obviously the most visual demo, the preview pane is accomplished
      entirely outside of Jcrop with a simple jQuery-flavored callback.
      This type of interface could be useful for creating a thumbnail
      or avatar. The onChange event handler is used to update the
      view in the preview pane.
  </p>
  </div> -->

<!-- <div class="tapmodo-footer">
  <a href="http://tapmodo.com" class="tapmodo-logo segment">tapmodo.com</a>
  <div class="segment"><b>&copy; 2008-2013 Tapmodo Interactive LLC</b><br />
    Jcrop is free software released under <a href="../MIT-LICENSE.txt">MIT License</a>
  </div>
</div> -->

<div class="clearfix"></div>

</div>
</div>
</div>
</div>
@endsection

