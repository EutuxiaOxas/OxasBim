<div class="row">
	<div class="col-12 form-group">
		<h5>Imagen</h5>
		<label class="label_img" for="imagen">Seleccionar Imagen para publicidad</label>
		<input hidden type="file" name="image" {{isset($publicidad) ? '' : 'required'}} id="imagen">
	</div>
	<div class="col-12 form-group mt-4">
		<h5>Enlace</h5>
		<input class="form-control" type="text" maxlength="191" name="link" value="{{$publicidad->link ?? old('link')}}" required>
	</div>
	<div class="col-12">
		<input type="submit" class="btn btn-primary" value="{{$form_name}}">
	</div>
</div>