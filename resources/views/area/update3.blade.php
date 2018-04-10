@extends('layouts.app')
 
@section('content')

    <div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Edit Rayon</div>
        <div class="panel-body">






		{!! Form::open( ['class' => 'area','files'=>true]) !!}
				<div class="form-group">
 				{!! Form::label('nama_area', 'Nama Area/Rayon', array('class' => 'col-md-4 control-label'))  !!}
				<div class="col-md-6">
				{!! Form::text('nama_area', $area->nama_area,array('class' => 'form-control')) !!}</div>
				</div><br/><br/> <br/>
				<div class="form-group">
				{!! Form::label('alamat', 'Alamat', array('class' => 'col-md-4 control-label')) !!}
				<div class="col-md-6">{!! Form::text('alamat',$area->alamat, array('class' => 'form-control')) !!}	</div>
				</div><br/><br/> 

				<div class="form-group">
				{!! Form::label('kode_area', 'Kode Area', array('class' => 'col-md-4 control-label')) !!}
				<div class="col-md-6">{!! Form::text('kode_area',$area->kode_area, array('class' => 'form-control')) !!}	</div>
				</div><br/><br/> 

				<div class="form-group">
				{!! Form::label('telepon', 'Telepon', array('class' => 'col-md-4 control-label')) !!}
				<div class="col-md-6">{!! Form::text('telepon',$area->telepon, array('class' => 'form-control')) !!}	</div>
				</div><br/><br/>


				
				
				<div class="form-group">
 				{!! Form::label('gambar', 'Foto', array('class' => 'col-md-4 control-label'))  !!}
				<div class="col-md-6">
         		 {!! Form::file('gambar',['class' => 'btn']) !!}
	  			<p class="errors">{!!$errors->first('image')!!}</p>
				
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
    			{!! Form::submit('Ubah', ['class'=>'btn primary']) !!}
				</div>
    			{!! Form::close() !!}
    			</div>
      </div>
    </div>
  </div>
</div>
@endsection