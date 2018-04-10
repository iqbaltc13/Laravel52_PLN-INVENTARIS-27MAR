@extends('layouts.app')
 
@section('content')

    <div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">Tambah Ruangan</div>
        <div class="panel-body">






		
        <form class="form-horizontal" role="form" method="POST" action="" enctype="multipart/form-data">
			
				<div class="form-group{{ $errors->has('nama_ruang') ? ' has-error' : '' }}">
                            <label for="nama_ruang" class="col-md-4 control-label">Nama Ruangan</label>

                            <div class="col-md-6">
                                <input id="nama_ruang" type="text" class="form-control" name="nama_ruang" value="{{ old('nama_ruang') }}">

                                @if ($errors->has('nama_ruang'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_ruang') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/><br/> <br/>

				
				<div class="form-group{{ $errors->has('kode_ruang') ? ' has-error' : '' }}">
                            <label for="kode_ruang" class="col-md-4 control-label">Kode Ruangan(ex: Ruang Manajer: MGR)</label>

                            <div class="col-md-6">
                                <input id="kode_ruang" type="text" class="form-control" name="kode_ruang" value="{{ old('kode_ruang') }}">

                                @if ($errors->has('kode_ruang'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kode_ruang') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/><br/> <br/>
				 
                <div class="form-group">
				
				<label for="rayon_area" class="col-md-4 control-label">'Rayon/Area'</label>
				
			
				
				<div class="col-md-6">	
					<select name="fid_area" class="form-control">
					<option value="{{$area->id_area}}">
						{{$area->nama_area}}
					</option>

				</div>

				</div><br/><br/> <br/> 

				<div class="form-group">		
				
				<div class="col-md-6">	
					<select name="korban" class="form-control">
					<option value="">
					</option>
		
				</div>

				</div><br/><br/> <br/> 

				
     		   <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="gambar" class="col-md-4 control-label">Foto</label>

                            <div class="col-md-6">
                                <input id="gambar" type="file" class="form-control" name="gambar" value="">

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
    			</form>
    			</div>
      </div>
    </div>
  </div>
</div>
@endsection