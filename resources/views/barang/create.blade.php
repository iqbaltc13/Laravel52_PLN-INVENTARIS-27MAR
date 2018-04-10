@extends('layouts.app')
 
@section('content')







    <div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">Tambah Aktiva</div>
        <div class="panel-body">

       

		<form class="form-horizontal" role="form" method="POST" action="{{ url('/barang/create') }}/{{$id2}}" enctype="multipart/form-data">
{{ csrf_field() }}s
				              <div class="form-group">
  <label class="col-md-4 control-label" >Rayon</label>
  <div class="col-md-6">	
				<select name='fid_area' onChange="doReload(this.value);" class="form-control">
<!--  -->
					@foreach($pilih as $terpilih)
					<option value="{{$terpilih->id_area}}" selected>
						{{$terpilih->nama_area}}
					</option>
					@endforeach

					@foreach($area as $item)
					@foreach($item as $item2)
					<?php
					if($terpilih->id_area!=$item2->id_area){
					?>
					<option value="{{$item2->id_area}}">
						{{$item2->nama_area}}
					</option>
					<?php
					}	
					?>
					@endforeach
					@endforeach
				</div>
</div> <br/> <br/><br/><br/> 

<div class="form-group">
  <label class="col-md-4 control-label" ></label>
  <div class="col-md-6">
  <select class="form-control" >
    <option></option>
    <option></option>
  </select></div>
</div> <br/> <br/>


				<div class="form-group">
  <label class="col-md-4 control-label" >Ruangan</label>
   <div class="col-md-6">	
					<select name='ruang'  class="form-control">
							@foreach($ruang as $item3)
							@foreach($item3 as $item4)
						<option value="{{$item4->id_ruang}}">
							{{$item4->nama_ruang}}
						</option>
						@endforeach
						@endforeach
					
					
				</div>
</div> <br/> <br/>

<div class="form-group">
  <label class="col-md-4 control-label" >Ruangan</label>
  <div class="col-md-6">
  <select class="form-control" >
    <option></option>
    <option></option>
  </select></div>
</div> <br/> <br/>

			<div class="form-group">
  <label class="col-md-4 control-label" >Sub Lokasi</label>
   <div class="col-md-6">	
					<select name='sublokasi'  class="form-control">
						<option value="-1" selected>

						</option>

							@foreach($sublokasi as $item5)
							@foreach($item5 as $item6)
						<option value="{{$item6->id_sub}}">
							{{$item6->nama_sub}}
						</option>
						@endforeach
						@endforeach
					
					
				</div>
</div> <br/> <br/>

<div class="form-group">
  <label class="col-md-4 control-label" >Sublokasi</label>
  <div class="col-md-6">
  <select class="form-control" >
    <option></option>
    <option></option>
  </select></div>
</div> <br/> <br/>


	

				
				<div class="form-group{{ $errors->has('nama_barang') ? ' has-error' : '' }}">
                            <label for="nama_barang" class="col-md-4 control-label">Nama Barang</label>

                            <div class="col-md-6">
                                <input id="nama_barang" type="text" class="form-control" name="nama_barang" value="{{ old('nama_barang') }}">

                                @if ($errors->has('nama_barang'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_barang') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
<br/><br/> <br/>

				<ul>
					<li style="visibility:hidden">aaa</li>
				</ul>

			
				<div class="form-group{{ $errors->has('merek') ? ' has-error' : '' }}">
                            <label for="merek" class="col-md-4 control-label">Merek</label>

                            <div class="col-md-6">
                                <input id="merek" type="text" class="form-control" name="merek" value="{{ old('email') }}">

                                @if ($errors->has('merek'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('merek') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
<br/><br/> 

				<ul>
					<li style="visibility:hidden">aaa</li>
				</ul>

				
				<div class="form-group{{ $errors->has('tahun') ? ' has-error' : '' }}">
                            <label for="tahun" class="col-md-4 control-label">Tahun</label>

                            <div class="col-md-6">
                                <input id="tahun" type="text" class="form-control" name="tahun" value="{{ old('tahun') }}">

                                @if ($errors->has('tahun'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tahun') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
<br/><br/> 

				<ul>
					<li style="visibility:hidden">aaa</li>
				</ul>

			
     		   <div class="form-group{{ $errors->has('gambar') ? ' has-error' : '' }}">
                            <label for="gambar" class="col-md-4 control-label">Gambar Barang</label>

                            <div class="col-md-6">
                                <input id="gambar" type="file" class="form-control" name="gambar" value="{{ old('gambar') }}">

                                @if ($errors->has('gambar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gambar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


 
     		   <ul>
					<li style="visibility:hidden">aaa</li>
				</ul>
<ul>
					<li style="visibility:hidden">aaa</li>
				</ul>

     		 
     		   <div class="form-group{{ $errors->has('jumlah') ? ' has-error' : '' }}">
                            <label for="jumlah" class="col-md-4 control-label">Jumlah</label>

                            <div class="col-md-6">
                                <input id="jumlah" type="text" class="form-control" name="jumlah" value="{{ old('jumlah') }}">

                                @if ($errors->has('jumlah'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jumlah') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
<br/><br/> <br/>



                        <div class="form-group{{ $errors->has('satuan') ? ' has-error' : '' }}">
                            <label for="satuan" class="col-md-4 control-label">Satuan</label>

                            <div class="col-md-6">
                                <select name="satuan" form="carform" id="satuan"
class="form-control" >
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
                                <select name="fisik" form="carform" id="fisik"
class="form-control" >
                                    <option value="baik">Baik</option>
                                    <option value="kurang baik">Kurang Baik</option>
                                    <option value="rusak">Rusak</option>
                                    
                                  </select>
                            </div>
                        </div>
<br/>


			
				<div class="form-group{{ $errors->has('keterangan') ? ' has-error' : '' }}">
                            <label for="keterangan" class="col-md-4 control-label">Keterangan</label>

                            <div class="col-md-6">
                                <input id="keterangan" type="text" class="form-control" name="keterangan" value="{{ old('keterangan') }}">

                                @if ($errors->has('keterangan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('keterangan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
<br/><br/> <br/> <br/><br/> <br/>


     		    <div class="form-group"><br/> <br/>
				<div class="col-md-6 col-md-offset-4"><br/> <br/>
    			
          <button type="submit" class="btn btn-primary">
                                     Tambah Barang
                                </button>
				</div>
    			</form>
    			</div>
    		
      </div>
    </div>
  </div>
</div>
@endsection