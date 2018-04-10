@extends('layouts.app')
 
@section('content')

    <div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">Tambah Area/Rayon</div>
        <div class="panel-body">






		<form class="form-horizontal" role="form" method="POST" action="{{ url('/area/create') }}" enctype="multipart/form-data">
			{{ csrf_field() }}
				<div class="form-group">
 				
 				 <label for="nama_area" class="col-md-4 control-label">Nama Area/Rayon</label>
				
				 <div class="col-md-6">
                                <input id="nama_area" type="text" class="form-control" name="nama_area" value="{{ old('nama_area') }}">
                @if ($errors->has('nama_area'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_area') }}</strong>
                                    </span>
                                @endif
                </div>
                        </div>
				<br/><br/> 
				<div class="form-group">
				
				 <label for="alamat" class="col-md-4 control-label">Alamat</label>
				<div class="col-md-6">
				<input id="alamat" type="text" class="form-control" name="alamat" value="{{ old('alamat') }}">

                                @if ($errors->has('alamat'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('alamat') }}</strong>
                                    </span>
                                @endif</div>
				</div><br/><br/> 
				
				<div class="form-group{{ $errors->has('kode_area') ? ' has-error' : '' }}">
                            <label for="kode_area" class="col-md-4 control-label">Kode Area (3 karakter, ex: Caruban: CRB)</label>

                            <div class="col-md-6">
                                <input id="kode_area" type="text" class="form-control" name="kode_area" value="{{ old('kode_area') }}">

                                @if ($errors->has('kode_area'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kode_area') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


				<br/><br/> 

				
				<div class="form-group{{ $errors->has('telp') ? ' has-error' : '' }}">
                            <label for="telp" class="col-md-4 control-label">Telepon</label>

                            <div class="col-md-6">
                                <input id="telp" type="text" class="form-control" name="telp" value="{{ old('telp') }}">

                                @if ($errors->has('telp'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telp') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
				<br/><br/>
				
				
     		   <div class="form-group{{ $errors->has('gambar') ? ' has-error' : '' }}">
                            <label for="gambar" class="col-md-4 control-label">Foto</label>

                            <div class="col-md-6">
                                <input id="gambar" type="file" class="form-control" name="gambar" value="{{ old('gambar') }}">

                                @if ($errors->has('gambar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gambar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


    			
    			<div class="form-group"><br/> <br/>
                            <div class="col-md-6 col-md-offset-4"><br/> <br/>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Tambahkan
                                </button>
 							</div>

                        </div>
                        </form> 
                    </div>
                       

      </div>
    </div>
  </div>
</div>
@endsection