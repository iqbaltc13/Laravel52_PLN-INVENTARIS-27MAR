@extends('layouts.app')
 
@section('content')

    <div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">Edit Rayon</div>
        <div class="panel-body">





            <?php $link= url('/area/update')."/".$id; ?>
		
        <form class="form-horizontal" method="POST" action="{{$link}}" enctype="multipart/form-data">
			{{ csrf_field() }}
        <div class="form-group{{ $errors->has('nama_area') ? ' has-error' : '' }}">
                            <label for="nama_area" class="col-md-4 control-label">Nama Area/Rayon</label>

                            <div class="col-md-6">
                                <input id="nama_area" type="text" class="form-control" name="nama_area" value="{{ $area->nama_area }}">

                                @if ($errors->has('nama_area'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_area') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/><br/> <br/>
			
        <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                            <label for="alamat" class="col-md-4 control-label">Alamat</label>

                            <div class="col-md-6">
                                <input id="alamat" type="text" class="form-control" name="alamat" value="{{ $area->alamat }}">

                                @if ($errors->has('alamat'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('alamat') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/><br/> 

				
        <div class="form-group{{ $errors->has('kode_area') ? ' has-error' : '' }}">
                            <label for="kode_area" class="col-md-4 control-label">Kode Area</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="kode_area" value="{{ $area->kode_area }}">

                                @if ($errors->has('kode_area'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kode_area') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/><br/> 

				
        <div class="form-group{{ $errors->has('telepon') ? ' has-error' : '' }}">
                            <label for="telepon" class="col-md-4 control-label">Telepon</label>

                            <div class="col-md-6">
                                <input id="telepon" type="text" class="form-control" name="telepon" value="{{ $area->telepon }}">

                                @if ($errors->has('telepon'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telepon') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/><br/>


				
				
				
           <div class="form-group{{ $errors->has('gambar') ? ' has-error' : '' }}">
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

     		   <div class="form group" align="center">
      
                <div class="col-md-10" align="center">
            		 <?php
                  if(empty($area->foto))
                  {
                   ?>
                  <img src="../../imgbarang/default.jpg" width="auto" height="auto">
                    
                    <?php
                  }
                    ?>
                    <?php
                    if(!empty($area->foto))
                    {
                    ?>
                    <img src="{{URL::to(substr($area->foto,0))}}" width="auto" height="auto">
                    <?php
                  }
                    ?>
                    
                </div>
                </div><br/><br/> 


     		    <div class="form-group"><br/> <br/>
				<div class="col-md-6 col-md-offset-4"><br/> <br/>
    			
          <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Ubah
                                </button>
				</div>
    			</form>
    			</div>
      </div>
    </div>
  </div>
</div>
@endsection