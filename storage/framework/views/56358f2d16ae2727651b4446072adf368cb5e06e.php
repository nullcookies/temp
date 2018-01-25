<html>
    
    <head>
        <title>Head</title>
    </head>
    
    <body>
        
        <?php echo Form::open(array('method' => 'post', 'files' => 'true', 'action' => ['Test\TestController@saveVarients'])); ?>

            <input type="file" name="excel" />
            <button type="submit">Upload</button>
        <?php echo Form::close(); ?>

    </body>
</html>