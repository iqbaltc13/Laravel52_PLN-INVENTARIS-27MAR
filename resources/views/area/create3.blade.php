@extends('layouts.app')
 
@section('content')

    <div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Tambah Area/Rayon</div>
        <div class="panel-body">






		{!! Form::open( ) !!}
				<div class="form-group">
 				{!! Form::label('nama_area', 'Nama Area/Rayon', array('class' => 'col-md-4 control-label'))  !!}
				<div class="col-md-6">
				{!! Form::text('nama_area', null,array('class' => 'form-control')) !!}</div>
				</div><br/><br/> <br/>
				<div class="form-group">
				{!! Form::label('alamat', 'Alamat', array('class' => 'col-md-4 control-label')) !!}
				<div class="col-md-6">{!! Form::text('alamat',null, array('class' => 'form-control')) !!}	</div>
				</div><br/><br/> 
				{!! Form::label('kode_area', 'Kode Area (3 karakter, ex: Caruban: CRB)', array('class' => 'col-md-4 control-label')) !!}
				<div class="col-md-6">{!! Form::text('kode_area',null, array('class' => 'form-control')) !!}	</div>
				</div><br/><br/> 

				<div class="form-group">
				{!! Form::label('telp', 'Telepon', array('class' => 'col-md-4 control-label')) !!}
				<div class="col-md-6">{!! Form::text('telepon',null, array('class' => 'form-control')) !!}	</div>
				</div><br/><br/>
				
				<div class="form-group">
 				{!! Form::label('gambar', 'Foto', array('class' => 'col-md-4 control-label'))  !!}
				<div class="col-md-6">
         		 {!! Form::file('gambar',['class' => 'btn']) !!}
	  			<p class="errors">{!!$errors->first('image')!!}</p>
				
				</div>
     		   </div>


     		    <div class="form-group"><br/> <br/>
				<div class="col-md-6 col-md-offset-4"><br/> <br/>
    			{!! Form::submit('Tambahkan', ['class'=>'btn primary']) !!}
				</div>
    			{!! Form::close() !!}
    			</div>
      </div>
    </div>
  </div>
</div>
@endsection