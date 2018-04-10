@extends('layouts.app')
 
@section('content')

    <div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Tambah Ruangan</div>
        <div class="panel-body">






		{!! Form::open( ['class' => 'barang','files'=>true]) !!}
				<div class="form-group">
 				{!! Form::label('nama_ruang', 'Nama Ruangan', array('class' => 'col-md-4 control-label'))  !!}
				<div class="col-md-6">
				{!! Form::text('nama_ruang', null,array('class' => 'form-control')) !!}</div>
				</div><br/><br/> <br/>

				<div class="form-group">
 				{!! Form::label('kode_ruang', 'Kode Ruangan(ex: Ruang Manajer: MGR)', array('class' => 'col-md-4 control-label'))  !!}
				<div class="col-md-6">
				{!! Form::text('kode_ruang', null,array('class' => 'form-control')) !!}</div>
				</div><br/><br/> <br/>
				 
                <div class="form-group">
				{!! Form::label('rayon_area', 'Rayon/Area', array('class' => 'col-md-4 control-label')) !!}
				
			
				
				<div class="col-md-6">	
					<select name="fid_area" class="form-control">
					@foreach($area as $item)
					<option value="{{$item->id_area}}">
						{{$item->nama_area}}
					</option>
					@endforeach
				</div>

				</div><br/><br/> <br/> 

				<div class="form-group">		
				
				<div class="col-md-6">	
					<select name="korban" class="form-control">
					<option value="">
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