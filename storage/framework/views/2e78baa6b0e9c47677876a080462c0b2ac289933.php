<script type="text/javascript">
  $(document).ready(function(){
    $('#product_detail_form').on('submit', function(event){
      event.preventDefault();
      $.ajax({
        url: "<?php echo e(url('/order/preparebuynow')); ?>",
        type: 'post',
        dataType: 'json',
        data: $('#product_detail_form').serialize(),
        beforeSend: function(){
          $('#myModal').modal({
              backdrop: 'static',
              keyboard: false,  
              timeout : 3000,
          });
          $("#myModal").modal('show');
        },
        success: function(result){
          $('#alert_message')
          .removeClass('hidden')
          .removeClass('alert-danger')
          .removeClass('alert-success')
          .addClass('alert-'+result['class'])
          .html(result['message']);
          
          $("#myModal").modal('hide');
          
          if(result['success']){
            var url = "<?php echo e(url('/order/checkout')); ?>"+"?buynow="+result['buynowid'];    
            $(location).attr('href',url);
          }
        },
        error: function(jqXHR, textStatus){
          $('#alert_message')
          .removeClass('hidden')
          .removeClass('alert-success')
          .addClass('alert-danger')
          .html(jqXHR['status']+':'+jqXHR['statusText']);
          $("#myModal").modal('hide');
        },
      });
    });
  });
</script>
 