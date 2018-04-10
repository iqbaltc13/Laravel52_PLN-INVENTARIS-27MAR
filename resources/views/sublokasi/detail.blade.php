@extends('layouts.app')
 
@section('content')



    <div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">Detail Sub Lokasi</div>
        <div class="panel-body">

                


      
        <div class="form-group{{ $errors->has('nama_sub') ? ' has-error' : '' }}">
                            <label for="nama_sub" class="col-md-4 control-label">Nama Sub Lokasi</label>

                            <div class="col-md-6">
                                <input id="nama_sub" type="text" class="form-control" name="nama_sub" value="{{$sublokasi->nama_sub}}" readonly="true">

                                @if ($errors->has('nama_sub'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_sub') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/><br/> <br/>


        
        <div class="form-group{{ $errors->has('area') ? ' has-error' : '' }}">
                            <label for="area" class="col-md-4 control-label">Rayon</label>

                            <div class="col-md-6">
                                <input id="area" type="text" class="form-control" name="area" value="{{ $sublokasi->area->nama_area }}" readonly="true">

                                @if ($errors->has('area'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('area') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/><br/> 

        


              <div class="form group">
                {!! Form::label('foto', 'Gambar', array('class' => 'col-md-4 control-label')) !!}
                 <label for="foto" class="col-md-4 control-label">Gambar</label>
                <div class="col-md-6">
                    <?php
                  if(empty($sublokasi->foto))
                  {
                   ?>
                  <img src="../../imgbarang/default.jpg" width="auto" height="auto">
                    
                    <?php
                  }
                    ?>
                    <?php
                    if(!empty($sublokasi->foto))
                    {
                    ?>
                    <img src="{{URL::to(substr($sublokasi->gambar,0))}}" width="auto" height="auto">
                    <?php
                  }
                    ?>
                    
                </div>
            </div><br/><br/> 

           
                 
            <div class="form-group"><br/> <br/>
        <div class="col-md-6 col-md-offset-4"><br/> <br/>
          <a class="btn btn-default" href="../../area/detail/{{$sublokasi->fid_area}}">Kembali</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 col-md-offset-0">
      <div class="panel panel-default">
        <div class="panel-heading">List Barang di Sub Lokasi {{$sublokasi->nama_sub}}<?php echo " " ?>{{$sublokasi->area->nama_area}}</div>
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

</div>
      </div>
    </div>
  </div>
</div>

@endsection