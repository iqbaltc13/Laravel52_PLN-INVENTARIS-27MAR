    
 @extends('layouts.app')
 
@section('content')

 
    <div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Daftar Ruangan</div>
        <div class="panel-body">
 
       <table class="table table-hover table-striped table-bordered">
  <tr>
      <th>Kode Ruangan</th>
    <th>Nama Ruangan</th>
    
    <th>Rayon</th>
     @if(Auth::user()->role == 1 && Auth::user()->status_reg == 1)
    <th></th>
    <th></th>  
    <th></th>
   @elseif(Auth::user()->role == 2 && Auth::user()->status_reg == 1)
    <th></th>
  @else()
   echo "akun anda belum dikonfirmasi";

    @endif
    
        
    
  </tr>
 
  <tr>
    @foreach ( $ruang as $item )
    <td>{{ $item->kode_ruang }}</td>
    <td>{{ $item->nama_ruang }}</td>
  
    <td>{{ $item->area->nama_area }}</td>
    

 @if(Auth::user()->role == 1 && Auth::user()->status_reg == 1)
    <td><a class="btn btn-success" href="ruang/update/{{ $item['id_ruang'] }}">Update</a></td>
    <td><a class="btn btn-primary" href="ruang/detail/{{ $item['id_ruang'] }}">Detail</a></td>
    <td><a class="btn btn-danger" onClick="myFunction({{$item['id_ruang']}})" >Hapus</a></td>
    <td hidden><a class="btn btn-danger" id="{{ $item['id_ruang'] }}" href="ruang/delete/{{ $item['id_ruang'] }}">Hapus</a></td>
   @elseif(Auth::user()->role == 2 && Auth::user()->status_reg == 1)
   <td><a class="btn btn-primary" href="ruang/detail/{{ $item['id_ruang'] }}">Detail</a></td>

   @else()
   <script> window.location = "{{ url('/auth/logout') }}"; </script>

    @endif
   </tr>
    @endforeach



  
 
</table>
 <?php echo $ruang->render(); ?>

<p><a class="btn btn-default" href="ruang/create">Tambah Ruangan</a></p>
</div>
      </div>
    </div>
  </div>
</div>
@endsection