        
 @extends('layouts.app')
 
@section('content')

   <div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Report Barang</div>
        <div class="panel-body">

    

/{{$pilih[0]->id_area}}


   {!! Form::open(array('action' => 'BarangController@search')) !!}
<div class="form-group">
        {!! Form::label('nama_barang', 'Nama Barang', array('class' => 'col-md-4 control-label'))  !!}
        <div class="col-md-6">
        {!! Form::text('nama_barang',$seb['nama_barang'],array('class' => 'form-control')) !!}</div>
        </div><br/><br><br>
        
        <div class="form-group">
        {!! Form::label('merek', 'Merek', array('class' => 'col-md-4 control-label')) !!}
        <div class="col-md-6">{!! Form::text('merek',$seb['merek'], array('class' => 'form-control')) !!}  </div>
        </div><br/><br><br>
           
        <div class="form-group">
  <label class="col-md-4 control-label" >Rayon</label>
  <div class="col-md-6">  
        <select name='area'  class="form-control">
<!--  -->
   
          
        <?php
          if(empty($seb['area']))
          {
        ?>
          <option value="">

           </option>
          <?php
          }
          ?>
        @foreach($area as $zzz)
          @foreach($zzz as $barang2)
          <?php
          if($seb['area']==$barang2->id_area)
          { 
          ?>
          <option value="{{$barang2->id_area}}" selected>
            {{$barang2->nama_area}}
          </option>
          <?php
          }else{
          ?>

          <option value="{{$barang2->id_area}}">
            {{$barang2->nama_area}}
          </option>
          <?php
          }
          ?>

          @endforeach
          @endforeach
          
          <option value="">
           </option>
          
        </div>
</div> <br/> <br/>

<div class="form-group" hidden>
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
            <?php
          if(empty($seb['ruang']))
          {
        ?>
          <option value="">

           </option>
          <?php
          }
          ?>
        @foreach($ruang as $barang3)
          @foreach($barang3 as $barang4)
          <?php
          if($seb['ruang']==$barang4->id_ruang)
          { 
          ?>
          <option value="{{$barang4->id_ruang}}" selected>
           {{$barang4->area->nama_area}} <?php echo "-" ?> {{$barang4->nama_ruang}}
          </option>
          <?php
          }else{
          ?>

          <option value="{{$barang4->id_ruang}}">
            {{$barang4->area->nama_area}} <?php echo "-" ?> {{$barang4->nama_ruang}}
          </option>
          <?php
          }
          ?>

          @endforeach
          @endforeach
          
           <option value="">
           </option>
        </div>
</div> <br/> <br/><br><br>

<div class="form-group" hidden>
  <label class="col-md-4 control-label" ></label>
  <div class="col-md-6">
  <select class="form-control" >
    <option></option>
    <option></option>
  </select></div>
</div> <br/>



<div class="form-group">
  <label class="col-md-4 control-label" >Sub lokasi</label>
  <div class="col-md-6">  

          <select name='sublokasi'  class="form-control">
            <?php
          if(empty($seb['sublokasi']))
          {
        ?>
          <option value="">

           </option>
          <?php
          }
          ?>
           <option value="-1">
            -
           </option>
        @foreach($sublokasi as $barang5)
          @foreach($barang5 as $barang6)
          <?php
          if($seb['sublokasi']==$barang6->id_sub)
          { 
          ?>
          <option value="{{$barang6->id_sub}}" selected>
           {{$barang6->area->nama_area}} <?php echo "-" ?> {{$barang6->nama_sub}}
          </option>
          <?php
          }else{
          ?>

          <option value="{{$barang6->id_sub}}">
            {{$barang6->area->nama_area}} <?php echo "-" ?> {{$barang6->nama_sub}}
          </option>
          <?php
          }
          ?>

          @endforeach
          @endforeach
                    <option value="">

           </option>

          
          
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
          {!! Form::submit('Cari ', ['class'=>'btn primary']) !!}
        </div>
          {!! Form::close() !!}
          </div>
      </div>
    </div>
</div>




<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 col-md-offset-0">
      <div class="panel panel-default">
        <div class="panel-heading">Hasil Pencarian Barang &nbsp&nbsp&nbsp<a class="btn btn-danger" onClick="myFunction3(1)" \>Cetak ke PDF</a> &nbsp&nbsp&nbsp  <a class="btn btn-success" onClick="myFunction3(2)" \>Cetak ke Excel</a> &nbsp&nbsp&nbsp  <a class="btn btn-info" onClick="myFunction3(3)" \>Cetak Report Barcode</a> </div>
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
    <th>Sub<br>Lokasi</th>
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
    @foreach ($barang as $wawa)
    @foreach ( $wawa as $benda )


    <td>
              {{ $benda->nomor_inventaris }}
                </td>
                 
                 <td>
                    {{ $benda->nama_barang }}
      
                <td>
                    {{ $benda->merek }}
                </td>
                  <td>
                    {{ $benda->tahun }}
                </td>
                
                <td>
                    {{ $benda->jumlah }}
                </td>
                  <td>
                    {{ $benda->satuan }}
                </td>
                 <td>
                    {{ $benda->ruang->area->nama_area }}
                </td>
                <td>
                    {{ $benda->ruang->nama_ruang }}
                </td>
                <td>
                  {{$benda->sublokasi->nama_sub}}
                </td>
                <td>
                   {{ $benda->fisik }}
                </td>
                <td>
                    {{ $benda->keterangan }}
                </td>
   @if(Auth::user()->role == 1 && Auth::user()->status_reg == 1)
    <td><a class="btn btn-success" href="update/{{ $benda->id_barang }}">Update</a></td>
    <td><a class="btn btn-primary" href="detail/{{ $benda->id_barang }}">Detail</a></td>
    <td><a class="btn btn-info" href="barcode/{{ $benda->id_barang }}">Barcode</a></td>
      <td> 
<?php
echo Form::checkbox('checked[]', $benda->id_barang);
 
?>
    </td>
     @elseif(Auth::user()->role == 2 && Auth::user()->status_reg == 1)
       <td><a class="btn btn-primary" href="detail/{{ $benda->id_barang }}">Detail</a></td>
      @else()
<script> window.location = "{{ url('/auth/logout') }}"; </script>

@endif

</tr>
    @endforeach
    @endforeach
  <!-- untuk checkbox -->
   <button id='hap' type="submit" hidden>Submit!</button>
</form>
<!-- untuk checkbox -->
 
</table>
{!! Form::open(array('action' => 'BarangController@forprint')) !!}
<div class="form-group" hidden>
        {!! Form::label('nama_barang', 'Nama Barang', array('class' => 'col-md-4 control-label'))  !!}
        <div class="col-md-6">
        {!! Form::text('nama_barang',$seb['nama_barang'],array('class' => 'form-control')) !!}</div>
        </div>
        
        <div class="form-group" hidden>
        {!! Form::label('merek', 'Merek', array('class' => 'col-md-4 control-label')) !!}
        <div class="col-md-6">{!! Form::text('merek',$seb['merek'], array('class' => 'form-control')) !!}  </div>
        </div>
           
        <div class="form-group" hidden>
  <label class="col-md-4 control-label" >Rayon/Area</label>
  <div class="col-md-6" hidden>  
        <select name='area'  class="form-control">
<!--  -->
   
          
        <?php
          if(empty($seb['area']))
          {
        ?>
          <option value="">

           </option>
          <?php
          }
          ?>
        @foreach($area as $zzz)
          @foreach($zzz as $barang2)
          <?php
          if($seb['area']==$barang2->id_area)
          { 
          ?>
          <option value="{{$barang2->id_area}}" selected>
            {{$barang2->nama_area}}
          </option>
          <?php
          }else{
          ?>

          <option value="{{$barang2->id_area}}">
            {{$barang2->nama_area}}
          </option>
          <?php
          }
          ?>

          @endforeach
          @endforeach
          
        
          
        </div>
</div> 

<div class="form-group" hidden>
  <label class="col-md-4 control-label" ></label>
  <div class="col-md-6" hidden>
  <select class="form-control" >
    <option></option>
    <option></option>
  </select></div>
</div> 

        <div class="form-group" hidden>
  <label class="col-md-4 control-label" >Ruangan</label>
  <div class="col-md-6" hidden>  

          <select name='ruang'  class="form-control">
             <?php
          if(empty($seb['ruang']))
          {
        ?>
          <option value="">

           </option>
          <?php
          }
          ?>
        @foreach($ruang as $barang3)
          @foreach($barang3 as $barang4)
          <?php
          if($seb['ruang']==$barang4->id_ruang)
          { 
          ?>
          <option value="{{$barang4->id_ruang}}" selected>
            {{$barang4->nama_ruang}}
          </option>
          <?php
          }else{
          ?>

          <option value="{{$barang4->id_ruang}}">
            {{$barang4->nama_ruang}}
          </option>
          <?php
          }
          ?>

          @endforeach
          @endforeach
          
          
        </div>
</div> 

<div class="form-group" hidden>
  <label class="col-md-4 control-label" ></label>
  <div class="col-md-6" hidden>
  <select class="form-control" >
    <option></option>
    <option></option>
  </select></div>
</div>

<div class="form-group" hidden>
  <label class="col-md-4 control-label" >Sub lokasi</label>
  <div class="col-md-6">  

          <select name='sublokasi'  class="form-control">
            <?php
          if(empty($seb['sublokasi']))
          {
        ?>
          <option value="">

           </option>
          <?php
          }
          ?>
        @foreach($sublokasi as $barang5)
          @foreach($barang5 as $barang6)
          <?php
          if($seb['sublokasi']==$barang6->id_sub)
          { 
          ?>
          <option value="{{$barang6->id_sub}}" selected>
           {{$barang6->area->nama_area}} <?php echo "-" ?> {{$barang6->nama_sub}}
          </option>
          <?php
          }else{
          ?>

          <option value="{{$barang6->id_sub}}">
            {{$barang6->area->nama_area}} <?php echo "-" ?> {{$barang6->nama_sub}}
          </option>
          <?php
          }
          ?>

          @endforeach
          @endforeach
          
           <option value="">
           </option>
          
          
        </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" ></label>
  <div class="col-md-6">
  <select class="form-control" >
    <option></option>
    <option></option>
  </select></div>
</div> 

      <div class="form-group" >
        <div>
           <button id='1' type="submit" hidden>Submit!</button>
        </div>
          {!! Form::close() !!}

          </div>
          {!! Form::open(array('action' => 'BarangController@forexcel')) !!}
<div class="form-group" hidden>
        {!! Form::label('nama_barang', 'Nama Barang', array('class' => 'col-md-4 control-label'))  !!}
        <div class="col-md-6">
        {!! Form::text('nama_barang',$seb['nama_barang'],array('class' => 'form-control')) !!}</div>
        </div>
        
        <div class="form-group" hidden>
        {!! Form::label('merek', 'Merek', array('class' => 'col-md-4 control-label')) !!}
        <div class="col-md-6">{!! Form::text('merek',$seb['merek'], array('class' => 'form-control')) !!}  </div>
        </div>
           
        <div class="form-group" hidden>
  <label class="col-md-4 control-label" >Rayon</label>
  <div class="col-md-6" hidden>  
        <select name='area'  class="form-control">
<!--  -->
   
          
        <?php
          if(empty($seb['area']))
          {
        ?>
          <option value="">

           </option>
          <?php
          }
          ?>
        @foreach($area as $zzz)
          @foreach($zzz as $barang2)
          <?php
          if($seb['area']==$barang2->id_area)
          { 
          ?>
          <option value="{{$barang2->id_area}}" selected>
            {{$barang2->nama_area}}
          </option>
          <?php
          }else{
          ?>

          <option value="{{$barang2->id_area}}">
            {{$barang2->nama_area}}
          </option>
          <?php
          }
          ?>

          @endforeach
          @endforeach
          
        
          
        </div>
</div> 

<div class="form-group" hidden>
  <label class="col-md-4 control-label" ></label>
  <div class="col-md-6" hidden>
  <select class="form-control" >
    <option></option>
    <option></option>
  </select></div>
</div> 

        <div class="form-group" hidden>
  <label class="col-md-4 control-label" >Ruangan</label>
  <div class="col-md-6" hidden>  

          <select name='ruang'  class="form-control">
             <?php
          if(empty($seb['ruang']))
          {
        ?>
          <option value="">

           </option>
          <?php
          }
          ?>
        @foreach($ruang as $barang3)
          @foreach($barang3 as $barang4)
          <?php
          if($seb['ruang']==$barang4->id_ruang)
          { 
          ?>
          <option value="{{$barang4->id_ruang}}" selected>
            {{$barang4->nama_ruang}}
          </option>
          <?php
          }else{
          ?>

          <option value="{{$barang4->id_ruang}}">
            {{$barang4->nama_ruang}}
          </option>
          <?php
          }
          ?>

          @endforeach
          @endforeach
          
          
        </div>
</div> 

<div class="form-group" hidden>
  <label class="col-md-4 control-label" ></label>
  <div class="col-md-6" hidden>
  <select class="form-control" >
    <option></option>
    <option></option>
  </select></div>
</div>

<div class="form-group" hidden>
  <label class="col-md-4 control-label" >Sub lokasi</label>
  <div class="col-md-6">  

          <select name='sublokasi'  class="form-control">
            <?php
          if(empty($seb['sublokasi']))
          {
        ?>
          <option value="">

           </option>
          <?php
          }
          ?>
        @foreach($sublokasi as $barang5)
          @foreach($barang5 as $barang6)
          <?php
          if($seb['sublokasi']==$barang6->id_sub)
          { 
          ?>
          <option value="{{$barang6->id_sub}}" selected>
           {{$barang6->area->nama_area}} <?php echo "-" ?> {{$barang6->nama_sub}}
          </option>
          <?php
          }else{
          ?>

          <option value="{{$barang6->id_sub}}">
            {{$barang6->area->nama_area}} <?php echo "-" ?> {{$barang6->nama_sub}}
          </option>
          <?php
          }
          ?>

          @endforeach
          @endforeach
          
           <option value="">
           </option>
          
          
        </div>
</div> 

<div class="form-group">
  <label class="col-md-4 control-label" ></label>
  <div class="col-md-6">
  <select class="form-control" >
    <option></option>
    <option></option>
  </select></div>
</div> 

            <div class="form-group" >
        <div>
           <button id='2' type="submit" hidden>Submit!</button>
        </div>
          {!! Form::close() !!}
          </div>
         {!! Form::open(array('action' => 'BarangController@forbarcode')) !!}
<div class="form-group" hidden>
        {!! Form::label('nama_barang', 'Nama Barang', array('class' => 'col-md-4 control-label'))  !!}
        <div class="col-md-6">
        {!! Form::text('nama_barang',$seb['nama_barang'],array('class' => 'form-control')) !!}</div>
        </div>
        
        <div class="form-group" hidden>
        {!! Form::label('merek', 'Merek', array('class' => 'col-md-4 control-label')) !!}
        <div class="col-md-6">{!! Form::text('merek',$seb['merek'], array('class' => 'form-control')) !!}  </div>
        </div>
           
        <div class="form-group" hidden>
  <label class="col-md-4 control-label" >Rayon/Area</label>
  <div class="col-md-6" hidden>  
        <select name='area'  class="form-control">
<!--  -->
   
          
        <?php
          if(empty($seb['area']))
          {
        ?>
          <option value="">

           </option>
          <?php
          }
          ?>
        @foreach($area as $zzz)
          @foreach($zzz as $barang2)
          <?php
          if($seb['area']==$barang2->id_area)
          { 
          ?>
          <option value="{{$barang2->id_area}}" selected>
            {{$barang2->nama_area}}
          </option>
          <?php
          }else{
          ?>

          <option value="{{$barang2->id_area}}">
            {{$barang2->nama_area}}
          </option>
          <?php
          }
          ?>

          @endforeach
          @endforeach
          
        
          
        </div>
</div> 

<div class="form-group" hidden>
  <label class="col-md-4 control-label" ></label>
  <div class="col-md-6" hidden>
  <select class="form-control" >
    <option></option>
    <option></option>
  </select></div>
</div> 

        <div class="form-group" hidden>
  <label class="col-md-4 control-label" >Ruangan</label>
  <div class="col-md-6" hidden>  

          <select name='ruang'  class="form-control">
             <?php
          if(empty($seb['ruang']))
          {
        ?>
          <option value="">

           </option>
          <?php
          }
          ?>
        @foreach($ruang as $barang3)
          @foreach($barang3 as $barang4)
          <?php
          if($seb['ruang']==$barang4->id_ruang)
          { 
          ?>
          <option value="{{$barang4->id_ruang}}" selected>
            {{$barang4->nama_ruang}}
          </option>
          <?php
          }else{
          ?>

          <option value="{{$barang4->id_ruang}}">
            {{$barang4->nama_ruang}}
          </option>
          <?php
          }
          ?>

          @endforeach
          @endforeach
          
          
        </div>
</div> 

<div class="form-group" hidden>
  <label class="col-md-4 control-label" ></label>
  <div class="col-md-6" hidden>
  <select class="form-control" >
    <option></option>
    <option></option>
  </select></div>
</div>

<div class="form-group" hidden>
  <label class="col-md-4 control-label" >Sub lokasi</label>
  <div class="col-md-6">  

          <select name='sublokasi'  class="form-control">
            <?php
          if(empty($seb['sublokasi']))
          {
        ?>
          <option value="">

           </option>
          <?php
          }
          ?>
        @foreach($sublokasi as $barang5)
          @foreach($barang5 as $barang6)
          <?php
          if($seb['sublokasi']==$barang6->id_sub)
          { 
          ?>
          <option value="{{$barang6->id_sub}}" selected>
           {{$barang6->area->nama_area}} <?php echo "-" ?> {{$barang6->nama_sub}}
          </option>
          <?php
          }else{
          ?>

          <option value="{{$barang6->id_sub}}">
            {{$barang6->area->nama_area}} <?php echo "-" ?> {{$barang6->nama_sub}}
          </option>
          <?php
          }
          ?>

          @endforeach
          @endforeach
          
           <option value="">
           </option>
          
          
        </div>
</div> 

<div class="form-group" hidden>
  <label class="col-md-4 control-label" ></label>
  <div class="col-md-6">
  <select class="form-control" >
    <option></option>
    <option></option>
  </select></div>
</div> 

      <div class="form-group" >
        <div>
  <button id='3' type="submit" hidden>Submit!</button>
        </div>
          {!! Form::close() !!}

          </div> 
      </div>

    

    </div>
</div>
      </div>

    </div>
</div>






</div>
      </div>

    </div>
  </div>
</div>



@endsection

    
