
<div class="dd" id="nestable">

<?php //pr($categories, "MM"); ?>
<?php function printCategory($categories){ ?>
    <ol class="dd-list">
    @foreach($categories as $category)
        <li class="dd-item" data-id="{{$category['id']}}">
            <input type="checkbox" class="input-box run-toast" data-type="success" id="categ_{{$category['id']}}" @if(isset($category['flag']) && $category['flag']=='yes') checked="checked" @endif onchange="changeFlag({{$category['id']}});"><div class="dd-handle" for="categ_{{$category['id']}}">{{$category['category']}}</div>
			<?php printCategory($category['child']); ?>
        </li>
    @endforeach    
    </ol>
<?php } printCategory($categories);  ?>
</div>

<script type="text/javascript">

function changeFlag(categoryid){
	var flag 	=	'no';
	if($('#categ_'+categoryid).is(':checked')){
		flag    =	'yes';
	}
	$.ajax({
		url: "{{url(ADMIN_URL_PATH.'/category/ajax/ajaxflag')}}",
        type: "POST",
        data: {id: categoryid,flag:flag,flagupdate:1},
        dataType: 'json',
        success: function(json){
        	console.log(json);
            if(json['success']){
                toastr.success(json['msg']);
            }
        }
	});

	
}

</script>