<script type="text/javascript">
	var date = new Date();
	date.setDate(date.getDate());
	$('#calendar').datepicker({ 
	    startDate: date
	});
	
	$('#shippingtimeholderinput').attr('name','').val('');
</script>

<div class="app__main">
	<div class="calendar">
		<div id="calendar"></div>
	</div>
</div>