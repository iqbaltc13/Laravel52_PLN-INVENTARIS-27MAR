@extends('layouts.app')
 
@section('content')

    <div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">Detail Aktiva</div>
        <div class="panel-body">






		
		
				<div class="form-group{{ $errors->has('id_barang') ? ' has-error' : '' }}">
                            <label for="id_barang" class="col-md-4 control-label">Nomor Inventaris</label>

                            <div class="col-md-6">
                                <input id="id_barang" type="text" class="form-control" name="id_barang" value="{{$barang->nomor_inventaris }}" readonly= "true">

                                @if ($errors->has('id_barang'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_barang') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/><br/> <br/>
			
				<div class="form-group{{ $errors->has('nama_barang') ? ' has-error' : '' }}">
                            <label for="nama_barang" class="col-md-4 control-label">Nama Barang</label>

                            <div class="col-md-6">
                                <input id="nama_barang" type="text" class="form-control" name="nama_barang" value="{{ $barang->nama_barang}}" readonly= "true">

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
                                <input id="merek" type="text" class="form-control" name="merek" value="{{ $barang->merek }}" readonly= "true">

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
                                <input id="tahun" type="text" class="form-control" name="tahun" value="{{ $barang->tahun }}" readonly= "true">

                                @if ($errors->has('tahun'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tahun') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/><br/> 

                
				
				

              
				<div class="form-group{{ $errors->has('rayon_area') ? ' has-error' : '' }}">
                            <label for="rayon_area" class="col-md-4 control-label">Rayon/Area</label>

                            <div class="col-md-6">
                                <input id="rayon_area" type="text" class="form-control" name="rayon_area" value="{{ $barang->ruang->area->nama_area }}" readonly= "true">

                                @if ($errors->has('rayon_area'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rayon_area') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/>

				
				<div class="form-group{{ $errors->has('ruang') ? ' has-error' : '' }}">
                            <label for="ruang" class="col-md-4 control-label">Ruangan</label>

                            <div class="col-md-6">
                                <input id="ruang" type="text" class="form-control" name="ruang" value="{{ $barang->ruang->nama_ruang }}" readonly= "true">

                                @if ($errors->has('ruang'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ruang') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/>

     		   
     		   <div class="form-group{{ $errors->has('jumlah') ? ' has-error' : '' }}">
                            <label for="jumlah" class="col-md-4 control-label">Jumlah</label>

                            <div class="col-md-6">
                                <input id="jumlah" type="text" class="form-control" name="jumlah" value="{{ old('email') }}" readonly= "true">

                                @if ($errors->has('jumlah'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jumlah') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/><br/> <br/>

     		 
				<div class="form-group{{ $errors->has('satuan') ? ' has-error' : '' }}">
                            <label for="satuan" class="col-md-4 control-label">Satuan</label>

                            <div class="col-md-6">
                                <input id="satuan" type="text" class="form-control" name="satuan" value="{{ $barang->satuan }}" readonly= "true">

                                @if ($errors->has('satuan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('satuan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/>

				<div class="form-group{{ $errors->has('fisik') ? ' has-error' : '' }}">
                            <label for="fisik" class="col-md-4 control-label">Fisik</label>

                            <div class="col-md-6">
                                <input id="fisik" type="text" class="form-control" name="fisik" value="{{ $barang->fisik }}" readonly= "true">

                                @if ($errors->has('fisik'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fisik') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/>

				
				<div class="form-group{{ $errors->has('keterangan') ? ' has-error' : '' }}">
                            <label for="keterangan" class="col-md-4 control-label">Keterangan</label>

                            <div class="col-md-6">
                                <input id="keterangan" type="email" class="form-control" name="keterangan" value="{{  $barang->keterangan }}" readonly= "true">

                                @if ($errors->has('keterangan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('keterangan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/><br/> <br/> <br/><br/> <br/><br/><br/> 
                
                <div class="form group">
              
                <label for="gambar" class="col-md-4 control-label">Gambar</label>
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
            </div>
           <br/><br/> 

           
    			
    			

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