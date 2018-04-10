@extends('layouts.app')
 
@section('content')

    <div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">Detail Rayon</div>
        <div class="panel-body">



  @foreach($area as $lis)   
   <form class="form-horizontal" role="form" method="POST" action="">
      
        <div class="form-group{{ $errors->has('id_rayon') ? ' has-error' : '' }}">
                            <label for="id_rayon" class="col-md-4 control-label">Kode Rayon</label>

                            <div class="col-md-6">
                                <input id="id_rayon" type="text" class="form-control" name="id_rayon" value="{{$lis->id_rayon}}" readonly="true">

                                @if ($errors->has('id_rayon'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_rayon') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

<br/><br/> <br/>
               
        <div class="form-group{{ $errors->has('nama_area') ? ' has-error' : '' }}">
                            <label for="nama_area" class="col-md-4 control-label">Nama Rayon</label>

                            <div class="col-md-6">
                                <input id="nama_area" type="text" class="form-control" name="nama_area" value="{{ $lis->nama_area }}" readonly="true">

                                @if ($errors->has('nama_area'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_area') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

<br/><br/> <br/>
       
        <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                            <label for="alamat" class="col-md-4 control-label">Alamat</label>

                            <div class="col-md-6">
                                <input id="alamat" type="text" class="form-control" name="alamat" value="{{ $lis->alamat }}" readonly="true">

                                @if ($errors->has('alamat'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('alamat') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

<br/><br/> 

    
        <div class="form-group{{ $errors->has('telp') ? ' has-error' : '' }}">
                            <label for="telp" class="col-md-4 control-label">Telepon</label>

                            <div class="col-md-6">
                                <input id="telp" type="email" class="form-control" name="text" value="{{ $lis->telepon }}" readonly="true">

                                @if ($errors->has('telp'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telp') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

<br/><br/>


              <div class="form group" align="center">
      
                <div class="col-md-10" align="center">
                 <?php
                  if(empty($lis->foto))
                  {
                   ?>
                  <img src="../../imgbarang/default.jpg" width="auto" height="auto">
                    
                    <?php
                  }
                    ?>
                    <?php
                    if(!empty($lis->foto))
                    {
                    ?>
                    <img src="{{URL::to(substr($lis->foto,0))}}" width="auto" height="auto">
                    <?php
                  }
                    ?>
                    
                </div>
                </div><br/><br/> 

           
                 
            <div class="form-group"><br/> <br/>
        <div class="col-md-6 col-md-offset-4"><br/> <br/>
          <a class="btn btn-default" href="../../area">Kembali</a>
        </div>
        </form>
      
          </div>
      </div>
    </div>
  </div>
</div>



    <div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">Daftar Ruangan di {{$lis->nama_area}}  &nbsp&nbsp &nbsp     <a class="btn btn-primary" href="../tambahruang/{{$lis->id_area}}">Tambah Ruang</a></div>
        @endforeach
        <div class="panel-body">
 

       <table class="table table-hover table-striped">
  <tr>

    <th>Nama Ruangan</th>
    <th></th>
    <th></th>
    <th></th>
    
        
    
  </tr>
  <tr>
    @foreach ( $ruang as $lala )
    @foreach ( $lala as $item )
    <td><a href="../../ruang/detail/{{$item->id_ruang}}">{{ $item->nama_ruang }}</a></td>
       @if(Auth::user()->role == 1 && Auth::user()->status_reg == 1)
    <td><a class="btn btn-success" href="../../ruang/update/{{ $item->id_ruang }}">Update</a></td>
    <td><a class="btn btn-primary" href="../../ruang/detail/{{ $item->id_ruang }}">Detail</a></td>
    <td><a class="btn btn-danger" href="../../ruang/delete/{{ $item->id_ruang }}">Hapus</a></td>
 
     @elseif(Auth::user()->role == 2 && Auth::user()->status_reg == 1)
       <td><a class="btn btn-primary" href="../../ruang/detail/{{ $item->id_ruang }}">Detail</a></td>
      @else()
<script> window.location = "{{ url('/auth/logout') }}"; </script>

@endif

   


     
   </tr>
   @endforeach
   @endforeach




 
</table>

</div>
      </div>
    </div>
  </div>
</div>


 <div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
          @foreach($area as $lis)   
        <div class="panel-heading">Daftar Sub Lokasi di {{$lis->nama_area}}   &nbsp&nbsp &nbsp     <a class="btn btn-primary" href="../../sublokasi/create/{{$lis->id_area}}">Tambah Sub Lokasi</a></div>
        @endforeach
        <div class="panel-body">
 

       <table class="table table-hover table-striped">
  <tr>
    <th>Nama Sub Lokasi</th>
   <th></th>
   <th></th>
  <th></th>
    
        
    
  </tr>
  <tr>
    @foreach ( $sublokasi as $lele )
    @foreach ( $lele as $item2 )
    <td><a href="../../sublokasi/detail/{{$item2->id_sub}}">{{ $item2->nama_sub }}</a></td>
    @if(Auth::user()->role == 1 && Auth::user()->status_reg == 1)
    <td><a class="btn btn-success" href="../../sublokasi/update/{{ $item2->id_sub }}">Update</a></td>
    <td><a class="btn btn-primary" href="../../sublokasi/detail/{{ $item2->id_sub }}">Detail</a></td>
     <td><a class="btn btn-danger" href="../../sublokasi/delete/{{ $item2->id_sub }}">Hapus</a></td>
    <td> 

    </td>
 
     @elseif(Auth::user()->role == 2 && Auth::user()->status_reg == 1)
       <td><a class="btn btn-primary" href="../../sublokasi/detail/{{ $item2->id_sub }}">Detail</a></td>
      @else()
<script> window.location = "{{ url('/auth/logout') }}"; </script>

@endif


   


     
   </tr>
   @endforeach
   @endforeach




 
</table>

</div>
      </div>
    </div>
  </div>
</div>



  <div class="container-fluid">
  <div class="row">
    <div class="col-md-12 col-md-offset-0">
      <div class="panel panel-primary">
        @foreach($area as $lis)
        <div class="panel-heading">List Barang di {{$lis->nama_area}}  &nbsp
<a class="btn btn-danger" href="../../area/forprint/{{$lis->id_area}}">PDF</a>
&nbsp
<a class="btn btn-success" href="../../area/cetakexcel/{{$lis->id_area}}">Excel</a>
&nbsp
<!-- <a class="btn btn-success" href="../../area/barcode/{{$lis->id_area}}">Barcode ruangan</a> -->
 </div>
        @endforeach
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
    <th>Jumlah</th>
     <th>Satuan</th>
   <th>Ruangan</th>
   <th>Sub Lokasi</th>
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
 @foreach ( $barang as $lolo )
 @foreach ( $lolo as $item2 )
 
  <tr >
    
                <td >
                    {{ $item2->nomor_inventaris }}
                </td>
                 
                 <td>
                    {{ $item2->nama_barang }} </a>
                 </td>

               <!--  <td>
              
                   <img src="{{URL::to(substr($item->gambar,0))}}" style="width:50%">
                </td> -->
                <td>
                 {{ $item2->merek }} 
                </td>
                  <td>
                 {{ $item2->tahun }} 
                </td>
                </td>
                
                <td>
                  {{ $item2->jumlah }}
                </td>
                  <td>
                  {{ $item2->satuan }}
                </td>
                <td>
                  {{ $item2->ruang->nama_ruang }}
                </td>
                 <td>
                  {{$item2->sublokasi->nama_sub}}
                 </td>
                <td>
              {{ $item2->fisik }}
                </td>
                </td>
                <td>
          {{ $item2->keterangan }}
                </td>
                </td>
   @if(Auth::user()->role == 1 && Auth::user()->status_reg == 1)
    <td><a class="btn btn-success" href="../../barang/update/{{ $item2['id_barang'] }}">Update</a></td>
    <td><a class="btn btn-primary" href="../../barang/detail/{{ $item2['id_barang'] }}">Detail</a></td>
    <td><a class="btn btn-info" href="../../barang/barcode/{{ $item2['id_barang'] }}">Barcode</a></td>
  <td> 

    <input type="checkbox" name="checked[]" value="{{$item2->id_barang}}">
<?php
//echo Form::checkbox('checked[]', $item2->id_barang);
 
?>
    </td>
 
     @elseif(Auth::user()->role == 2 && Auth::user()->status_reg == 1)
       <td><a class="btn btn-primary" href="../../barang/detail/{{ $item2['id_barang'] }}">Detail</a></td>
      @else()
<script> window.location = "{{ url('/auth/logout') }}"; </script>

@endif
     
   </tr>
    @endforeach
   @endforeach



  
 
</table>
<!-- untuk checkbox -->
   <button id='hap' type="submit" hidden>Submit!</button>
</form>
<!-- untuk checkbox -->

</div>
      </div>
    </div>
  </div>
</div>
@endsection

