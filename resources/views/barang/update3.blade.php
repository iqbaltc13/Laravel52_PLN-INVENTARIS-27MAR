@extends('layouts.app')
 
@section('content')

    <div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Update Aktiva</div>
        <div class="panel-body">






		{!! Form::open( ['class' => 'barang','files'=>true]) !!}
			@foreach($lala as $barang)
				<div class="form-group">
 				{!! Form::label('nomor_inventaris', 'Nomor Inventaris', array('class' => 'col-md-4 control-label'))  !!}
				<div class="col-md-6">
				{!! Form::text('nomor_inventaris', $barang->nomor_inventaris,array('class' => 'form-control','readonly' => true)) !!}</div>
				</div><br/><br/> <br/>
				<div class="form-group">
 				{!! Form::label('nomor_barang', 'Nomor Barang', array('class' => 'col-md-4 control-label'))  !!}
				<div class="col-md-6">
				{!! Form::text('nomor_barang', $barang->noperarea,array('class' => 'form-control')) !!}</div>
				</div><br/><br/> <br/>
				<div class="form-group">
 				{!! Form::label('nama_barang', 'Nama Barang', array('class' => 'col-md-4 control-label'))  !!}
				<div class="col-md-6">
				{!! Form::text('nama_barang', $barang->nama_barang,array('class' => 'form-control')) !!}</div>
				</div><br/><br/> <br/>
				<div class="form-group">
				{!! Form::label('merek', 'Merek', array('class' => 'col-md-4 control-label')) !!}
				<div class="col-md-6">{!! Form::text('merek',$barang->merek, array('class' => 'form-control')) !!}	</div>
				</div><br/><br/> 
				<div class="form-group">
				{!! Form::label('tahun', 'Tahun', array('class' => 'col-md-4 control-label')) !!}
				<div class="col-md-6">{!! Form::input('number','tahun',$barang->tahun, array('class' => 'form-control')) !!}	</div>
				</div><br/><br/> 

				






<!--                 <div class="form-group">
				{!! Form::label('rayon_area', 'Rayon/Area', array('class' => 'col-md-4 control-label')) !!}
				
				<div class="col-md-6">{!! Form::select('rayon_area',['a'=>'a'], array('class' => 'form-control')) !!}	</div>
				</div><br/><br/> <br/>  -->

				<div class="form-group">
				{!! Form::label('ruang', 'Lokasi', array('class' => 'col-md-4 control-label')) !!}
				<div class="col-md-6">	
					<select name="fid_ruang" class="form-control">
						<option value="{{$barang->fid_ruang}}">
							{{$barang->ruang->area->nama_area}}<?php
							echo " - "
							?>
							{{$barang->ruang->nama_ruang}}
						</option>


					@foreach($yeye as $ruang)
					@foreach($ruang as $item)
					<?php
					if($barang->fid_ruang!=$item->id_ruang){
					?>
					<option value="{{$item->id_ruang}}">
						{{$item->area->nama_area}}<?php
						echo " - "
						?>
						{{$item->nama_ruang}}
					</option>
					<?php
					}
					?>
					

				</div>
				@endforeach
				@endforeach
				<div class="form-group">
				<div class="col-md-6">	
					<select name="aaaa" class="form-control">
				</div></div><br><br>




				<div class="form-group">
				{!! Form::label('sublokasi', 'Sublokasi', array('class' => 'col-md-4 control-label')) !!}
				<div class="col-md-6">	
					<select name="fid_sub" class="form-control">
						<?php
						if($barang->fid_sub!=-1)
						{
						?>
						<option value="{{$barang->fid_sub}}">
							{{$barang->ruang->area->nama_area}}<?php
							echo " - "
							?>
							{{$barang->sublokasi->nama_sub}}
						</option>
						<?php
						}
						?>
						<option value="-1">
							<?php
							echo " - "
							?>
						</option>


					@foreach($sublokasi as $wawa)
					@foreach($wawa as $item2)
					<?php
					if($barang->fid_sub!=$item2->id_sub){
					?>
					<option value="{{$item2->id_sub}}">
						{{$item2->area->nama_area}}<?php
						echo " - "
						?>
						{{$item2->nama_sub}}
					</option>
					<?php
					}
					?>
					

				</div>
				@endforeach
				@endforeach
				<div class="form-group">
				<div class="col-md-6">	
					<select name="aaaa" class="form-control">
				</div></div><br><br>

     		   <div class="form-group">
 				{!! Form::label('jumlah', 'Jumlah', array('class' => 'col-md-4 control-label'))  !!}
				<div class="col-md-6">
				{!!Form::input('number', 'jumlah',  $barang->jumlah, array('class' => 'form-control')) !!}
				</div>
     		   </div><br><br>

     		   <div class="form-group">
     		   	<?php
					 $opsisatuan = [
       					 'buah' => 'Buah',
       					 'set' => 'Set',
        				'unit' => 'Unit',
   						 ];
					?>
				{!! Form::label('satuan', 'Satuan', array('class' => 'col-md-4 control-label')) !!}
				<div class="col-md-6">{!! Form::select('satuan',$opsisatuan,$barang->satuan, array('class' => 'form-control')) !!}	</div>
				</div><br/><br/>

     		   <div class="form-group">
				{!! Form::label('fisik', 'Fisik', array('class' => 'col-md-4 control-label')) !!}

				<div class="col-md-6">
					<?php
					 $opsikon = [
       					 'baik' => 'Baik',
       					 'kurang baik' => 'Kurang Baik',
        				'rusak' => 'Rusak',
   						 ];
					?>
					{!! Form::select('fisik',$opsikon,$barang->fisik, array('class' => 'form-control')) !!}	</div>
				</div><br/><br/>

				<div class="form-group">
 				{!! Form::label('keterangan', 'Keterangan', array('class' => 'col-md-4 control-label'))  !!}
				<div class="col-md-6">
				{!! Form::textarea('keterangan', $barang->keterangan,array('class' => 'form-control'),'') !!}</div>
				</div><br/><br/><br><br><br><br><br><br><br><br><br><br>

								<div class="form-group">
 				{!! Form::label('gambar', 'Gambar Barang', array('class' => 'col-md-4 control-label'))  !!}
				<div class="col-md-6">
         		 {!! Form::file('gambar',['class' => 'btn']) !!}
	  			<p class="errors">{!!$errors->first('image')!!}</p>
				
				</div>
     		   </div>
     		   

     		   <div class="form-group" align='center'>
          			<div class="col-md-12" align=>
            		
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
      			</div>
      			@endforeach

    
     		    <div class="form-group"><br/> <br/>
				<div class="col-md-6 col-md-offset-4"><br/> <br/>
    			{!! Form::submit('Update Barang', ['class'=>'btn primary']) !!}
				</div>
    			 </form>
    			</div>
      </div>
    </div>
  </div>
</div>
@endsection