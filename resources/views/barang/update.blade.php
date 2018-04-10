@extends('layouts.app')
 
@section('content')

    <div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">Update Aktiva</div>
        <div class="panel-body">






		<form class="form-horizontal" role="form" method="POST" action="" enctype="multipart/form-data">
            {{ csrf_field() }}
			@foreach($lala as $barang)
				
				 <div class="form-group{{ $errors->has('nomor_inventaris') ? ' has-error' : '' }}">
                            <label for="nomor_inventaris" class="col-md-4 control-label">Nomor Inventaris</label>

                            <div class="col-md-6">
                                <input id="nomor_inventaris" type="text" class="form-control" name="nomor_inventaris" value="{{ $barang->nomor_inventaris }}">

                                @if ($errors->has('nomor_inventaris'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nomor_inventaris') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/><br/> <br/>
				
				 <div class="form-group{{ $errors->has('nomor_barang') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Nomor Barang</label>

                            <div class="col-md-6">
                                <input id="nomor_barang" type="text" class="form-control" name="nomor_barang" value="{{  $barang->noperarea }}">

                                @if ($errors->has('nomor_barang'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nomor_barang') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/><br/> <br/>
				
				 <div class="form-group{{ $errors->has('nama_barang') ? ' has-error' : '' }}">
                            <label for="nama_barang" class="col-md-4 control-label">Nama Barang</label>

                            <div class="col-md-6">
                                <input id="nama_barang" type="text" class="form-control" name="nama_barang" value="{{ $barang->nama_barang }}">

                                @if ($errors->has('nama_barang'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_barang') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/><br/> <br/>
				
				 <div class="form-group{{ $errors->has('merek') ? ' has-error' : '' }}">
                            <label for="merek" class="col-md-4 control-label">Merek</label>

                            <div class="col-md-6">
                                <input id="merek" type="text" class="form-control" name="merek" value="{{ $barang->merek }}">

                                @if ($errors->has('merek'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('merek') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/><br/> 
				
				 <div class="form-group{{ $errors->has('tahun') ? ' has-error' : '' }}">
                            <label for="tahun" class="col-md-4 control-label">Tahun</label>

                            <div class="col-md-6">
                                <input id="tahun" type="number" class="form-control" name="tahun" value="{{ $barang->tahun }}">

                                @if ($errors->has('tahun'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tahun') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/><br/> 

				







				<div class="form-group">
				
				 <label for="ruang" class="col-md-4 control-label">Lokasi</label>

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
				
				 <label for="sublokasi" class="col-md-4 control-label">Sublokasi</label>
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

     		  
               <div class="form-group{{ $errors->has('jumlah') ? ' has-error' : '' }}">
                            <label for="jumlah" class="col-md-4 control-label">Jumlah</label>

                            <div class="col-md-6">
                                <input id="jumlah" type="number" class="form-control" name="jumlah" value="{{  $barang->jumlah}}">

                                @if ($errors->has('jumlah'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jumlah') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br><br>

     		                           <div class="form-group{{ $errors->has('satuan') ? ' has-error' : '' }}">
                            <label for="satuan" class="col-md-4 control-label">Satuan</label>

                            <div class="col-md-6">
                                <select name="satuan" form="carform">
                                    <option value="buah">Buah</option>
                                    <option value="set">Set</option>
                                    <option value="unit">Unit</option>

                                    
                                  </select>
                            </div>
                        </div>
<br/><br/> 



             
                <div class="form-group{{ $errors->has('fisik') ? ' has-error' : '' }}">
                            <label for="fisik" class="col-md-4 control-label">Fisik</label>

                            <div class="col-md-6">
                                <select name="fisik" form="carform">
                                    <option value="baik">Baik</option>
                                    <option value="kurang baik">Kurang Baik</option>
                                    <option value="rusak">Rusak</option>
                                    
                                  </select>
                            </div>
                        </div>
<br/><br/> 




				
				 <div class="form-group{{ $errors->has('keterangan') ? ' has-error' : '' }}">
                            <label for="keterangan" class="col-md-4 control-label">Keterangan</label>

                            <div class="col-md-6">
                                <input id="keterangan" type="text" class="form-control" name="keterangan" value="{{ $barang->keterangan }}">

                                @if ($errors->has('keterangan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('keterangan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/><br/><br><br><br><br><br><br><br><br><br><br>

								
     		    <div class="form-group{{ $errors->has('gambar') ? ' has-error' : '' }}">
                            <label for="gambar" class="col-md-4 control-label">Gambar Barang</label>

                            <div class="col-md-6">
                                <input id="gambar" type="file" class="form-control" name="gambar" value="">

                                @if ($errors->has('gambar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gambar') }}</strong>
                                    </span>
                                @endif
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
    		
    			<button type="submit" class="btn btn-primary">
                                     Update Barang
                                </button>
				</div>
    			 </form>
    			</div>
      </div>
    </div>
  </div>
</div>
@endsection