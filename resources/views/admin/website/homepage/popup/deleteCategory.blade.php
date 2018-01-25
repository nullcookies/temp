{!! Form::open(array('method' => 'post', 'id' => 'popupForm','action' => ['Admin\WebsiteSetting\HomepageNavController@deleteCategory'])) !!}
<input type="hidden" name="navid" value="{{$navid}}">
<div class="form-goroup">
	<label>Are you sure to delete <b>{{$catname}}</b> category ?</label>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-secondary" data-dismiss="modal">no</button>
	<button type="submit" class="btn btn-primary btn-popup-submit">yes</button>
</div>
{!! Form::close() !!}