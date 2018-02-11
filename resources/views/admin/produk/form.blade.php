<div class="form-group {{ $errors->has('nama') ? 'has-error' : ''}}">
    <label for="nama" class="col-md-4 control-label">{{ 'Nama' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="nama" type="text" id="nama" value="{{ $produk->nama or ''}}" >
        {!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('harga_beli') ? 'has-error' : ''}}">
    <label for="harga_beli" class="col-md-4 control-label">{{ 'harga_beli' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="harga_beli" type="number" id="harga_beli" value="{{ $produk->harga_beli or ''}}" >
        {!! $errors->first('harga_beli', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('harga_jual') ? 'has-error' : ''}}">
    <label for="harga_jual" class="col-md-4 control-label">{{ 'harga_jual' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="harga_jual" type="number" id="harga_jual" value="{{ $produk->harga_jual or ''}}" >
        {!! $errors->first('harga_jual', '<p class="help-block">:message</p>') !!}
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
