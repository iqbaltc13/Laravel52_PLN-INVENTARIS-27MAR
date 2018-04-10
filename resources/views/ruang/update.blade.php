@extends('layouts.app')
 
@section('content')

    <div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">Edit Ruangan</div>
        <div class="panel-body">






	
		<form class="form-horizontal" role="form" method="POST" action="{{url('/area/update')}}/{{$id_ruang}}" enctype="multipart/form-data">
			
				{{ csrf_field() }}
				<div class="form-group{{ $errors->has('nama_ruang') ? ' has-error' : '' }}">
                            <label for="nama_ruang" class="col-md-4 control-label">Nama Ruangan</label>

                            <div class="col-md-6">
                                <input id="nama_ruang" type="text" class="form-control" name="nama_ruang" value="{{ $ruang->nama_ruang }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/><br/> <br/>

				
				<div class="form-group{{ $errors->has('kode_ruang') ? ' has-error' : '' }}">
                            <label for="kode_ruang" class="col-md-4 control-label">Kode Ruangan</label>

                            <div class="col-md-6">
                                <input id="kode_ruang" type="text" class="form-control" name="kode_ruang" value="{{ $ruang->kode_ruang }}">

                                @if ($errors->has('kode_ruang'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kode_ruang') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/><br/> <br/>
				 
                <div class="form-group">
				
				 <label for="rayon_area" class="col-md-4 control-label">Rayon/Area</label>
				
				<div class="col-md-6">	
					<select name="fid_area" class="form-control">
					<option value="{{$ruang->fid_area}}" selected>
						{{$ruang->area->nama_area}}
					</option>

					@foreach($area as $item)
					<?php
					if($ruang->fid_area!=$item->id_area){
					?>
					<option value="{{$item->id_area}}">
						{{$item->nama_area}}
					</option>
					<?php
					}
					?>
					@endforeach
				</div>
				</div><br/><br/> <br/> 
				
			
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

				<div class="form-group" align="center">
          			<div class="col-md-10" align="center">
            			
            		 <?php
                  if(empty($ruang->foto))
                  {
                   ?>
                  <img src="../../imgbarang/default.jpg" width="auto" height="auto">
                    
                    <?php
                  }
                    ?>
                    <?php
                    if(!empty($ruang->foto))
                    {
                    ?>
                    <img src="{{URL::to(substr($ruang->foto,0))}}" width="auto" height="auto">
                    <?php
                  }
                    ?>
            		</div>
      			</div>
				


     		    <div class="form-group"><br/> <br/>
				<div class="col-md-6 col-md-offset-4"><br/> <br/>
    			
    			<button type="submit" class="btn btn-primary">
                                    Ubah
                                </button>
				</div>
    			</form>
    			</div>
      </div>
    </div>
  </div>
</div>
@endsection