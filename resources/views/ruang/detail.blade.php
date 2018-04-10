@extends('layouts.app')
 
@section('content')



    <div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">Detail Ruangan</div>
        <div class="panel-body">

                


       
				</div>
        <div class="form-group{{ $errors->has('nama_ruang') ? ' has-error' : '' }}">
                            <label for="nama_ruang" class="col-md-4 control-label">Nama Ruangan</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="nama_ruang" value="{{$ruang->nama_ruang}}" readonly="true">

                                @if ($errors->has('nama_ruang'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_ruang') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/> <br/>

        
        <div class="form-group{{ $errors->has('kode_ruang') ? ' has-error' : '' }}">
                            <label for="kode_ruang" class="col-md-4 control-label">Kode Ruangan</label>

                            <div class="col-md-6">
                                <input id="kode_ruang" type="text" class="form-control" name="kode_ruang" value="{{ $ruang->kode_ruang }}" readonly="true">

                                @if ($errors->has('kode_ruang'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kode_ruang') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/><br/>

				
        <div class="form-group{{ $errors->has('area') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">'Rayon/Area'</label>

                            <div class="col-md-6">
                                <input id="area" type="text" class="form-control" name="area" value="{{ $ruang->area->nama_area }}" readonly="true">

                                @if ($errors->has('area'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('area') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/><br/> 

				


              <div class="form group">
                
                 <label for="foto" class="col-md-4 control-label">Gambar</label>
                <div class="col-md-6">
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
            </div><br/><br/> 

           
                 
     		    <div class="form-group">
				<div class="col-md-6 col-md-offset-4"> <br/>
					<a class="btn btn-default" href="../../ruang">Kembali</a>
				</div>
      </div>
    </div>
  </div>
</div>

   <div class="container-fluid">
  <div class="row">
    <div class="col-md-12 col-md-offset-0">
      <div class="panel panel-default">
        <div class="panel-heading">List Barang di Ruang {{$ruang->nama_ruang}}<?php echo " " ?>{{$ruang->area->nama_area}}</div>
        <div class="panel-body">
<!--           untuk checkbox -->
 <form method='POST' action='../../barang/delete2'>
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
<!--   untuk checkbox -->
       <table class="table table-hover table-striped table-bordered">
  <tr>
      <th>Kode Inventaris</th>
    <th>Nama Barang</th>
    <th>Merek</th>
    <th>Tahun</th>
    <th>SubLokasi</th>
    <th>Jumlah</th>
     <th>Satuan</th>
    <th>Fisik</th>
    <th>Keterangan</th>
  @if(Auth::user()->role == 1 && Auth::user()->status_reg == 1)
    <th></th>
    <th></th>
    <th></th>
    <th><a class="btn btn-danger" onClick="myFunction2()" \>Hapus</a></th>

@elseif(Auth::user()->role == 2 && Auth::user()->status_reg == 1)
    <th></th>
 @else()
echo "akun anda belum dikonfirmasi";

@endif
  </tr>

 @foreach ( $barang as $item )
  <tr >
    
                <td >
                    {{ $item->nomor_inventaris }}
                </td>
                 
                 <td>
                    <a href="../../barang/detail/{{$item->id_barang}}">{{ $item->nama_barang }} </a>
                 </td>

               <!--  <td>
              
                   <img src="{{URL::to(substr($item->gambar,0))}}" style="width:50%">
                </td> -->
                <td>
                 {{ $item->merek }} 
                </td>
                  <td>
                 {{ $item->tahun }} 
                </td>
                <td>
                  {{$item->sublokasi->nama_sub}}
                </td>
                
                <td>
                  {{ $item->jumlah }}
                </td>
                  <td>
                  {{ $item->satuan }}
                </td>
                </td>
                 
                <td>
              {{ $item->fisik }}
                </td>
                </td>
                <td>
          {{ $item->keterangan }}
                </td>
                </td>
  
     @if(Auth::user()->role == 1 && Auth::user()->status_reg == 1)
    <td><a class="btn btn-success" href="../../barang/update/{{ $item['id_barang'] }}">Update</a></td>
    <td><a class="btn btn-primary" href="../../barang/detail/{{ $item['id_barang'] }}">Detail</a></td>
    <td><a class="btn btn-info" href="../../barang/barcode/{{ $item['id_barang'] }}">Barcode</a></td>
<!--     <td><a class="btn btn-danger" onClick="myFunction({{$item['id_barang']}})" ></a></td> -->
 <td> 
   <input type="checkbox" name="checked[]" value="{{$item->id_barang}}">
<?php
//echo Form::checkbox('checked[]', $item->id_barang);
 
?>
    </td>

   



 
     @elseif(Auth::user()->role == 2 && Auth::user()->status_reg == 1)
       <td><a class="btn btn-primary" href="../../barang/detail/{{ $item['id_barang'] }}">Detail</a></td>
      @else()
<script> window.location = "{{ url('/auth/logout') }}"; </script>

@endif
   </tr>
    @endforeach
   
  
  


  
 
</table>
   <button id='hap' type="submit" hidden>Submit!</button>
</form>
<p><a class="btn btn-danger" href="../../ruang/forprint/{{$ruang->id_ruang}}">PDF</a></p>
<p><a class="btn btn-success" href="../../ruang/cetakexcel/{{$ruang->id_ruang}}">Excel</a></p>
</div>
      </div>
    </div>
  </div>
</div>

@endsection