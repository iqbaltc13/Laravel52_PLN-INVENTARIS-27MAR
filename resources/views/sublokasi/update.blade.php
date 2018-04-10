@extends('layouts.app')
 
@section('content')

    <div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">Edit Sublokasi</div>
        <div class="panel-body">


     <<?php $redir="/sublokasi/update/" . $id_area; ?>



		
    <form class="form-horizontal" role="form" method="POST" action="{{url($redir)}}" enctype="multipart/form-data">{{ csrf_field() }}
				<div class="form-group">
 		
        <div class="form-group{{ $errors->has('nama_sub') ? ' has-error' : '' }}">
                            <label for="nama_sub" class="col-md-4 control-label">Nama Sublokasi</label>

                            <div class="col-md-6">
                                <input id="nama_sub" type="text" class="form-control" name="nama_sub" value="{{  $sublokasi->nama_sub }}">

                                @if ($errors->has('nama_sub'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_sub') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/><br/> <br/>
				 
                <div class="form-group">
				
         <label for="rayon" class="col-md-4 control-label">Rayon</label>
				
				<div class="col-md-6">	
					<select name="id_area" class="form-control">
					<option value="{{$sublokasi->fid_area}}" selected>
						{{$sublokasi->area->nama_area}}
					</option>
				</div>
				</div><br/><br/> <br/> 

				<div class="col-md-6" hidden>	
					<select class="form-control">
					<option value="" selected>
					
					</option>
				</div>
				</div><br/><br/> <br/> 
				
			
           <div class="form-group{{ $errors->has('gambar') ? ' has-error' : '' }}">
                            <label for="gambar" class="col-md-4 control-label">Foto</label>

                            <div class="col-md-6">
                                <input id="gambar" type="text" class="form-control" name="gambar" value="">

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
                  if(empty($sublokasi->foto))
                  {
                   ?>
                  <img src="../../imgbarang/default.jpg" width="auto" height="auto">
                    
                    <?php
                  }
                    ?>
                    <?php
                    if(!empty($sublokasi->foto))
                    {
                    ?>
                    <img src="{{URL::to(substr($sublokasi->foto,0))}}" width="auto" height="auto">
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