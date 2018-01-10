<div class="form-group {{ $errors->has('nama') ? 'has-error' : ''}}">
    <label for="nama" class="col-md-4 control-label">{{ 'Nama' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="nama" type="text" id="nama" value="{{ $produk->nama or ''}}" >
        {!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('harga') ? 'has-error' : ''}}">
    <label for="harga" class="col-md-4 control-label">{{ 'Harga' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="harga" type="number" id="harga" value="{{ $produk->harga or ''}}" >
        {!! $errors->first('harga', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('stok') ? 'has-error' : ''}}">
    <label for="stok" class="col-md-4 control-label">{{ 'Stok' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="stok" type="number" id="stok" value="{{ $produk->stok or ''}}" >
        {!! $errors->first('stok', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
