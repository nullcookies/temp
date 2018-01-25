@extends('admin/layouts/layout')
@section('pageTopScripts')
<link rel="stylesheet" href="{{asset(ADMIN_FILE_PATH.'/css/core.css')}}"> 

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.rawgit.com/fengyuanchen/tooltip/v0.0.2/dist/tooltip.min.css">

<link rel="stylesheet" href="{{url('cropper/docs/css/cropper.css')}}">
<link rel="stylesheet" href="{{url('cropper/docs/css/main.css')}}">
<style type="text/css">
  .navbar-right{float: none !important;}
</style>
@endsection

@section('pageScripts')
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/app.js')}}"></script>
<script type="text/javascript" src="{{asset(ADMIN_FILE_PATH.'/js/demo.js')}}"></script> 
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://cdn.rawgit.com/fengyuanchen/tooltip/v0.0.2/dist/tooltip.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
<script src="https://fengyuanchen.github.io/js/common.js"></script>
<script src="{{url('cropper/docs/js/cropper.min.js')}}"></script>
<script>  
  $(function () {

    'use strict';

    var console = window.console || { log: function () {} };
    var $body = $('body');


      // Tooltip
      $('[data-toggle="tooltip"]').tooltip();
      $.fn.tooltip.noConflict();
      $body.tooltip();


      // Demo
      // ---------------------------------------------------------------------------

      (function () {
        var $image = $('.img-container > img');
        var $actions = $('.docs-actions');
        var $download = $('#download');
        var $dataX = $('#dataX');
        var $dataY = $('#dataY');
        var $dataHeight = $('#dataHeight');
        var $dataWidth = $('#dataWidth');
        var $dataRotate = $('#dataRotate');
        var $dataScaleX = $('#dataScaleX');
        var $dataScaleY = $('#dataScaleY');
        var options = {
          aspectRatio: {{ $width }} / {{ $height }},
          preview: '.img-preview',
          strict:false,
          crop: function (e) {
            $dataX.val(Math.round(e.x));
            $dataY.val(Math.round(e.y));
            $dataHeight.val(Math.round(e.height));
            $dataWidth.val(Math.round(e.width));
            $dataRotate.val(e.rotate);
            $dataScaleX.val(e.scaleX);
            $dataScaleY.val(e.scaleY);
          }
        };

        $image.on({
          'build.cropper': function (e) {
            console.log(e.type);
          },
          'built.cropper': function (e) {
            console.log(e.type);
          },
          'cropstart.cropper': function (e) {
            console.log(e.type, e.action);
          },
          'cropmove.cropper': function (e) {
            console.log(e.type, e.action);
          },
          'cropend.cropper': function (e) {
            console.log(e.type, e.action);
          },
          'crop.cropper': function (e) {
            console.log(e.type, e.x, e.y, e.width, e.height, e.rotate, e.scaleX, e.scaleY);
          },
          'zoom.cropper': function (e) {
            console.log(e.type, e.ratio);
          }
        }).cropper(options);


        // Buttons
        if (!$.isFunction(document.createElement('canvas').getContext)) {
          $('button[data-method="getCroppedCanvas"]').prop('disabled', true);
        }

        if (typeof document.createElement('cropper').style.transition === 'undefined') {
          $('button[data-method="rotate"]').prop('disabled', true);
          $('button[data-method="scale"]').prop('disabled', true);
        }


        // Download
        if (typeof $download[0].download === 'undefined') {
          $download.addClass('disabled');
        }


        // Options
        $actions.on('change', ':checkbox', function () {
          var $this = $(this);
          var cropBoxData;
          var canvasData;

          if (!$image.data('cropper')) {
            return;
          }

          options[$this.val()] = $this.prop('checked');

          cropBoxData = $image.cropper('getCropBoxData');
          canvasData = $image.cropper('getCanvasData');
          options.built = function () {
            $image.cropper('setCropBoxData', cropBoxData);
            $image.cropper('setCanvasData', canvasData);
          };

          $image.cropper('destroy').cropper(options);
        });


        // Methods
        $actions.on('click', '[data-method]', function () {
          var $this = $(this);
          var data = $this.data();
          var $target;
          var result;

          if ($this.prop('disabled') || $this.hasClass('disabled')) {
            return;
          }

          if ($image.data('cropper') && data.method) {
            data = $.extend({}, data); // Clone a new one

            if (typeof data.target !== 'undefined') {
              $target = $(data.target);

              if (typeof data.option === 'undefined') {
                try {
                  data.option = JSON.parse($target.val());
                } catch (e) {
                  console.log(e.message);
                }
              }
            }

            result = $image.cropper(data.method, data.option, data.secondOption);

            if (data.flip === 'horizontal') {
              $(this).data('option', -data.option);
            }

            if (data.flip === 'vertical') {
              $(this).data('secondOption', -data.secondOption);
            }

            if (data.method === 'getCroppedCanvas' && result) {
              $('#getCroppedCanvasModal').modal().find('.modal-body').html(result);

              if (!$download.hasClass('disabled')) { 
                $download.attr('imageData',result.toDataURL());
                //$download.attr('href', result.toDataURL());
              }
            }

            if ($.isPlainObject(result) && $target) {
              try {
                $target.val(JSON.stringify(result));
              } catch (e) {
                console.log(e.message);
              }
            }

          }
        });


        // Keyboard
        $body.on('keydown', function (e) {

          if (!$image.data('cropper') || this.scrollTop > 300) {
            return;
          }

          switch (e.which) {
            case 37:
            e.preventDefault();
            $image.cropper('move', -1, 0);
            break;

            case 38:
            e.preventDefault();
            $image.cropper('move', 0, -1);
            break;

            case 39:
            e.preventDefault();
            $image.cropper('move', 1, 0);
            break;

            case 40:
            e.preventDefault();
            $image.cropper('move', 0, 1);
            break;
          }

        });


        // Import image
        var $inputImage = $('#inputImage');
        var URL = window.URL || window.webkitURL;
        var blobURL;

        if (URL) {
          $inputImage.change(function () {
            var files = this.files;
            var file;

            if (!$image.data('cropper')) {
              return;
            }

            if (files && files.length) {
              file = files[0];

              if (/^image\/\w+$/.test(file.type)) {
                blobURL = URL.createObjectURL(file);
                $image.one('built.cropper', function () {
                  URL.revokeObjectURL(blobURL); // Revoke when load complete
                }).cropper('reset').cropper('replace', blobURL);
                $inputImage.val('');
              } else {
                $body.tooltip('Please choose an image file.', 'warning');
              }
            }
          });
        } else {
          $inputImage.prop('disabled', true).parent().addClass('disabled');
        }

      }());

});

</script>

<script>
  function saveCropImage(object){       

    var imageBase64 = object.getAttribute('imageData');        
    var path 		= "product_images";       
    var imagename 	= "{{ @$img }}";
    var id 			= "{{ @$id }}";   
    var redir       = "{{ $redir }}";
    var upc         = "{{$upc}}";
    $.ajax({
      url : "{{url('/admin/product/imagescrop')}}",
      type: 'POST',
      data: {imgdata:imageBase64,imagename:imagename,path:path,id:id, redir: redir, upc:upc},
      dataType: 'json',
      beforeSend: function (){
        $('.modal-body').html("<img src='{{url('images/loader/loading.gif')}}' />");
        $('#download').removeAttr("href").css("cursor","pointer");
      },
      success: function(result){       
        window.location.href=result['link'];
      }
    });

  }
</script>
@endsection

@section('bodyclass')
@endsection


@section('content')

<div class="container-fluid">
  <ol class="breadcrumb no-bg mb-1">
    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
    <li class="breadcrumb-item active">Laravel and Jcrop</li>
  </ol>
  <div class="row">
    <div class="col-md-9">
      <!-- <h3>Demo:</h3> -->
      <div class="img-container">
        <img src="{!! url($imgpath. '/',[$img]) !!}" alt="Picture">
      </div>
    </div>
    <div class="col-md-3">
      <h5 class="image-full">Final Image View</h5>
      <div class="docs-preview clearfix">
        <div class="img-preview preview-lg"></div>
          <!--<div class="img-preview preview-md"></div>
          <div class="img-preview preview-sm"></div>
          <div class="img-preview preview-xs"></div>-->
        </div>
        <div class="row docs-actions mar-0">
          <div class="docs-buttons">
            <div class="docs-data">
              <ul class="cropbtnlist">
                <li>
                  <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="move" title="Move">
                      <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setDragMode&quot;, &quot;move&quot;)">
                        <span class="fa fa-arrows"></span>
                      </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="crop" title="Crop">
                      <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setDragMode&quot;, &quot;crop&quot;)">
                        <span class="fa fa-crop"></span>
                      </span>
                    </button>
                  </div>
                </li>
                <li>  
                  <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
                      <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, 0.1)">
                        <span class="fa fa-search-plus"></span>
                      </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out">
                      <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, -0.1)">
                        <span class="fa fa-search-minus"></span>
                      </span>
                    </button>
                  </div>
                </li>
                <li>  
                  <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="move" data-option="-10" data-second-option="0" title="Move Left">
                      <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;move&quot;, -10, 0)">
                        <span class="fa fa-arrow-left"></span>
                      </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="move" data-option="10" data-second-option="0" title="Move Right">
                      <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;move&quot;, 10, 0)">
                        <span class="fa fa-arrow-right"></span>
                      </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="-10" title="Move Up">
                      <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;move&quot;, 0, -10)">
                        <span class="fa fa-arrow-up"></span>
                      </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="10" title="Move Down">
                      <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;move&quot;, 0, 10)">
                        <span class="fa fa-arrow-down"></span>
                      </span>
                    </button>
                  </div>
                </li>
                <li>
                  <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45" title="Rotate Left">
                      <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;rotate&quot;, -45)">
                        <span class="fa fa-rotate-left"></span>
                      </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="rotate" data-option="45" title="Rotate Right">
                      <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;rotate&quot;, 45)">
                        <span class="fa fa-rotate-right"></span>
                      </span>
                    </button>
                  </div>
                </li>
                <li>
                  <button type="button" class="btn btn-success" data-method="getCroppedCanvas">
                    <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCroppedCanvas&quot;)">
                      Save Image
                    </span>
                  </button>
                </li>
              </ul>
            </div>
          </div>
        </div>  
        
      </div>
    </div>
    

    <!--Show the cropped image in modal-->
    <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="getCroppedCanvasTitle">Cropped</h4>
          </div>
          <div class="modal-body">

          </div>
          <div class="modal-footer">
            {!! Form::open(array('method' => 'get', 'action' => ['Admin\Product\ProductController@saveimagescrop'])) !!}
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <a class="btn btn-primary" id="download" onclick="saveCropImage(this)" imageData="" href="javascript:void(0);">Save</a>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div><!-- /.modal -->

  </div><!-- /.docs-buttons -->


</div>
@endsection
