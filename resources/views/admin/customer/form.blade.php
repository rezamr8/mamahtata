<div class="form-group {{ $errors->has('nama') ? 'has-error' : ''}}">
    <label for="nama" class="col-md-4 control-label">{{ 'Nama' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="nama" type="text" id="nama" value="{{ $customer->nama or ''}}" >
        {!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('alamat') ? 'has-error' : ''}}">
    <label for="alamat" class="col-md-4 control-label">{{ 'Alamat' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="alamat" type="textarea" id="alamat" >{{ $customer->alamat or ''}}</textarea>
        {!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('no_hp') ? 'has-error' : ''}}">
    <label for="no_hp" class="col-md-4 control-label">{{ 'No Hp' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="no_hp" type="text" id="no_hp" value="{{ $customer->no_hp or ''}}" >
        {!! $errors->first('no_hp', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
