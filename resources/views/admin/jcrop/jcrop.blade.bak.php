@extends('admin/layouts/layout')

@section('title')
| Laravel and Jcrop
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
<link rel="stylesheet" href="{{asset('jcrop/css/jquery.Jcrop.min.css')}}" />
@endsection

@section('pageScripts')

<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script> 
<script src="{{asset('jcrop/js/jquery.Jcrop.min.js')}}"></script>
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
    $(function() {
        $('#cropimage').Jcrop({
            onSelect: updateCoords
        });

    });
    function updateCoords(c) {
        $('#x').val(c.x);
        $('#y').val(c.y);
        $('#w').val(c.w);
        $('#h').val(c.h);
    };
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
        <img src="<?php echo $image ?>" id="cropimage">

        <?= Form::open() ?>
        <?= Form::hidden('image', $image) ?>
        <?= Form::hidden('x', '', array('id' => 'x')) ?>
        <?= Form::hidden('y', '', array('id' => 'y')) ?>
        <?= Form::hidden('w', '', array('id' => 'w')) ?>
        <?= Form::hidden('h', '', array('id' => 'h')) ?>
        <?= Form::submit('Crop it!') ?>
        <?= Form::close() ?>
    </div>
</div>
@endsection