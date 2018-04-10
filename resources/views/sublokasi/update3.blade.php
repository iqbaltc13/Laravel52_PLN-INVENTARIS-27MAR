@extends('layouts.app')
 
@section('content')

    <div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Edit Sublokasi</div>
        <div class="panel-body">






		{!! Form::open( ['class' => 'barang','files'=>true]) !!}
				<div class="form-group">
 				{!! Form::label('nama_sub', 'Nama Sub Lokasi', array('class' => 'col-md-4 control-label'))  !!}
				<div class="col-md-6">
				{!! Form::text('nama_sub', $sublokasi->nama_sub,array('class' => 'form-control')) !!}</div>
				</div><br/><br/> <br/>
				 
                <div class="form-group">
				{!! Form::label('rayon', 'Rayon', array('class' => 'col-md-4 control-label')) !!}
				
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
    			{!! Form::submit('Ubah', ['class'=>'btn primary']) !!}
				</div>
    			{!! Form::close() !!}
    			</div>
      </div>
    </div>
  </div>
</div>
@endsection