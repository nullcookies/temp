<!DOCTYPE html>
<html>
<head>
  <title>Test</title>
  <style type="text/css">
    body{
      margin: 0;
      padding: 0;
    }

    .display-inline{
      display: inline;
    }
  </style>
</head>
<body>

<div>
{!! Form::open(array('method' => 'get', 'action' => ['Test\TestController@getCategory'])) !!}
<input type="input" class="display-inline" name="cid"><input type="submit" class="display-inline" name="submit">
{!! Form::close() !!}
</div>
<br />
<div>
  {!! dd($categories) !!}
</div>
</body>
</html>