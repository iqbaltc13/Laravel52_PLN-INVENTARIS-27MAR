@extends('layouts.app')
 
@section('content')

    <div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Edit Ruangan</div>
        <div class="panel-body">






		{!! Form::open( ['class' => 'barang','files'=>true]) !!}
				<div class="form-group">
 				{!! Form::label('nama_ruang', 'Nama Ruangan', array('class' => 'col-md-4 control-label'))  !!}
				<div class="col-md-6">
				{!! Form::text('nama_ruang', $ruang->nama_ruang,array('class' => 'form-control')) !!}</div>
				</div><br/><br/> <br/>

				<div class="form-group">
 				{!! Form::label('kode_ruang', 'Kode Ruangan', array('class' => 'col-md-4 control-label'))  !!}
				<div class="col-md-6">
				{!! Form::text('kode_ruang', $ruang->kode_ruang,array('class' => 'form-control')) !!}</div>
				</div><br/><br/> <br/>
				 
                <div class="form-group">
				{!! Form::label('rayon_area', 'Rayon/Area', array('class' => 'col-md-4 control-label')) !!}
				
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
				
				<div class="form-group">
 				{!! Form::label('gambar', 'Foto', array('class' => 'col-md-4 control-label'))  !!}
				<div class="col-md-6">
         		 {!! Form::file('gambar',['class' => 'btn']) !!}
	  			<p class="errors">{!!$errors->first('image')!!}</p>
				
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
    			{!! Form::submit('Ubah', ['class'=>'btn primary']) !!}
				</div>
    			{!! Form::close() !!}
    			</div>
      </div>
    </div>
  </div>
</div>
@endsection