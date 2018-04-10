        
 @extends('layouts.app')
 
@section('content')

   <div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">Report Barang</div>
        <div class="panel-body">




<form class="form-horizontal" role="form" method="POST" action="{{ url('/barang/search') }}">

        <div class="form-group{{ $errors->has('nama_barang') ? ' has-error' : '' }}">
                            <label for="nama_barang" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="nama_barang" type="text" class="form-control" name="nama_barang" value="{{ old('nama_barang') }}">

                                @if ($errors->has('nama_barang'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_barang') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/><br><br>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <div class="form-group{{ $errors->has('merek') ? ' has-error' : '' }}">
                            <label for="merek" class="col-md-4 control-label">Merek</label>

                            <div class="col-md-6">
                                <input id="merek" type="text" class="form-control" name="merek" value="{{ old('merek') }}">

                                @if ($errors->has('merek'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('merek') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/><br><br>
           
        <div class="form-group">
  <label class="col-md-4 control-label" >Rayon</label>
  <div class="col-md-6">  
        <select name='area'  class="form-control">
<!--  -->
        <option value="" selected>
              
            </option>

          @foreach($area as $item)
          @foreach($item as $item2)
          <option value="{{$item2->id_area}}">
 
            {{$item2->nama_area}}
          </option>
          @endforeach
          @endforeach
        </div>
</div> <br/> <br/>

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
             <option value="" selected>
              
            </option>
              @foreach($ruang as $item3)
              @foreach($item3 as $item4)
            <option value="{{$item4->id_ruang}}">
             {{$item4->area->nama_area}}<?php echo " - " ?> {{$item4->nama_ruang}}
            </option>
            @endforeach
            @endforeach
          
          
        </div>
</div> <br/> <br/>

<div class="form-group">
  <label class="col-md-4 control-label" ></label>
  <div class="col-md-6">
  <select class="form-control" >
    <option></option>
    <option></option>
  </select></div>
</div> <br/> <br/>

<div class="form-group">
  <label class="col-md-4 control-label" >Sub lokasi</label>
  <div class="col-md-6">  

          <select name='sublokasi'  class="form-control">
             <option value="" selected>
            </option>
              @foreach($sublokasi as $item5)
              @foreach($item5 as $item6)
            <option value="{{$item6->id_sub}}">
             {{$item6->area->nama_area}}<?php echo " - " ?> {{$item6->nama_sub}}
            </option>
            @endforeach
            @endforeach
          
          
        </div>
</div> <br/> <br/>

<div class="form-group">
  <label class="col-md-4 control-label" ></label>
  <div class="col-md-6">
  <select class="form-control" >
    <option></option>
    <option></option>
  </select></div>
</div> <br/> <br/>

            <div class="form-group"><br/> <br/>
        <div class="col-md-6 col-md-offset-4">
          
          <button type="submit" class="btn btn-primary">
                                     Cari
                                </button>
        </div>
         
           </form>
          </div>
      </div>
    </div>
</div>




   

  <div class="container-fluid">
  <div class="row">
    <div class="col-md-12 col-md-offset-0">
      <div class="panel panel-primary">
      <div class="panel-heading">Index Barang                <a class="btn btn-primary" href="../barang/create/1">Tambah Barang</a> <a class="btn btn-info" href="../barang/allbarcode">Cetak Semua Barcode</a> <a class="btn btn-success" href="../barang/uploadexcel">Upload Excel ke Database</a> </div>
        <div class="panel-body">
           <!--           untuk checkbox -->
 <form method='POST' action='../barang/delete2'>
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
    <th>Rayon</th>
    <th>Ruangan</th>
    <th>Sub<br>lokasi</th>
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
 
  <tr>

    @foreach ( $barang as $lala )
    @foreach ( $lala as $item )
                <td>
                    {{ $item->nomor_inventaris }}
                </td>
                 
                 <td>
                    {{ $item->nama_barang }}
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
                    {{ $item->jumlah }}
                </td>
                  <td>
                    {{ $item->satuan }}
                </td>
                 <td>
                    {{ $item->ruang->area->nama_area }}
                </td>
                <td>
                    {{ $item->ruang->nama_ruang }}
                </td>
                <td>
                  {{$item->sublokasi->nama_sub}}
                </td>
                <td>
                   {{ $item->fisik }}
                </td>
                <td>
                    {{ $item->keterangan }}
                </td>
    @if(Auth::user()->role == 1 && Auth::user()->status_reg == 1)
    <td><a class="btn btn-success" href="../barang/update/{{ $item['id_barang'] }}">Update</a></td>
    <td><a class="btn btn-primary" href="../barang/detail/{{ $item['id_barang'] }}">Detail</a></td>
    <td><a class="btn btn-info" href="../barang/barcode/{{ $item['id_barang'] }}">Barcode</a></td>
    <td> 
      <input type="checkbox" name="checked[]" value="{{$item->id_barang}}">
<?php

 
?>
    </td>
 
     @elseif(Auth::user()->role == 2 && Auth::user()->status_reg == 1)
       <td><a class="btn btn-primary" href="../barang/detail/{{ $item['id_barang'] }}">Detail</a></td>
      @else()
<script> window.location = "{{ url('/auth/logout') }}"; </script>

@endif

   </tr>

    @endforeach




  
 
</table>

 <?php echo $lala->render(); ?>
    @endforeach
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

<script>
    $(".delete").on("submit", function(){
        return confirm("Do you want to delete this item?");
    });
</script>