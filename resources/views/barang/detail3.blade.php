@extends('layouts.app')
 
@section('content')

    <div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Detail Aktiva</div>
        <div class="panel-body">






		{!! Form::open( ['class' => 'barang','files'=>true]) !!}
		        <div class="form-group">
 				{!! Form::label('id barang', 'Nomor Inventaris', array('class' => 'col-md-4 control-label'))  !!}
				<div class="col-md-6">
				{!! Form::text('id_barang',  $barang->nomor_inventaris,array('class' => 'form-control','readonly' => true)) !!}</div>
				</div><br/><br/> <br/>
				<div class="form-group">
 				{!! Form::label('nama_barang', 'Nama Barang', array('class' => 'col-md-4 control-label'))  !!}
				<div class="col-md-6">
				{!! Form::text('nama_barang',  $barang->nama_barang,array('class' => 'form-control','readonly' => true)) !!}</div>
				</div><br/><br/> <br/>
				<div class="form-group">
				{!! Form::label('merek', 'Merek', array('class' => 'col-md-4 control-label')) !!}
				<div class="col-md-6">{!! Form::text('merek', $barang->merek, array('class' => 'form-control','readonly' => true)) !!}	</div>
				</div><br/><br/> 
				<div class="form-group">
				{!! Form::label('tahun', 'Tahun', array('class' => 'col-md-4 control-label')) !!}
				<div class="col-md-6">{!! Form::input('number','tahun', $barang->tahun, array('class' => 'form-control','readonly' => true)) !!}	</div>
				</div><br/><br/> 

                
				
				

                <div class="form-group">
				{!! Form::label('rayon_area', 'Rayon/Area', array('class' => 'col-md-4 control-label')) !!}
				
				<div class="col-md-6">{!! Form::text('rayon_area', $barang->ruang->area->nama_area, array('class' => 'form-control','readonly' => true)) !!}	</div>
				</div><br/>

				<div class="form-group">
				{!! Form::label('ruang', 'Ruangan', array('class' => 'col-md-4 control-label')) !!}
				<div class="col-md-6">{!! Form::text('ruang', $barang->ruang->nama_ruang, array('class' => 'form-control','readonly' => true)) !!}	</div>
				</div><br/>

     		   <div class="form-group">
 				{!! Form::label('jumlah', 'Jumlah', array('class' => 'col-md-4 control-label'))  !!}
				<div class="col-md-6">
				{!!Form::input('number', 'jumlah',   $barang->jumlah, array('class' => 'form-control','readonly' => true)) !!}
				</div>
     		   </div><br/><br/> <br/>

     		   <div class="form-group">
				{!! Form::label('satuan', 'Satuan', array('class' => 'col-md-4 control-label')) !!}
				<div class="col-md-6">{!! Form::text('satuan', $barang->satuan, array('class' => 'form-control','readonly' => true)) !!}	</div>
				</div><br/>

     		   <div class="form-group">
				{!! Form::label('fisik', 'Fisik', array('class' => 'col-md-4 control-label')) !!}
				<div class="col-md-6">{!! Form::text('fisik', $barang->fisik, array('class' => 'form-control','readonly' => true)) !!}	</div>
				</div><br/>

				<div class="form-group">
 				{!! Form::label('keterangan', 'Keterangan', array('class' => 'col-md-4 control-label'))  !!}
				<div class="col-md-6">
				{!! Form::textarea('keterangan',  $barang->keterangan,array('class' => 'form-control','readonly' => true),'') !!}</div>
				</div><br/><br/> <br/> <br/><br/> <br/><br/><br/> 
                
                <div class="form group">
                {!! Form::label('gambar', 'Gambar', array('class' => 'col-md-4 control-label')) !!}
                <div class="col-md-6">
                	<?php
                	if(empty($barang->gambar))
                	{
                	 ?>
                	<img src="../../imgbarang/default.jpg" width="auto" height="auto">
                    
                    <?php
                	}
                    ?>
                    <?php
                    if(!empty($barang->gambar))
                    {
                    ?>
                    <img src="{{URL::to(substr($barang->gambar,0))}}" width="auto" height="auto">
                    <?php
                	}
                    ?>

                </div>
            </div><br/><br/> 

           
    			
    			

    			<div class="form-group"><br/> <br/>
				<div class="col-md-6 col-md-offset-4"><br/> <br/>
					<a class="btn btn-default" href="../../barang">Kembali</a>
				</div>
				</form> 
    			</div>
    			
      </div>
    </div>
  </div>
</div>
@endsection