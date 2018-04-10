@extends('layouts.app')
 
@section('content')

    <div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">Tambah Sublokasi</div>
        <div class="panel-body">






		
    <form class="form-horizontal" role="form" method="POST" action="{{url('/sublokasi/create')}}/{{$id_area}}" enctype="multipart/form-data">
				{{ csrf_field() }}
			<div class="form-group{{ $errors->has('nama_sub') ? ' has-error' : '' }}">
                            <label for="nama_sub" class="col-md-4 control-label">Nama Sub</label>

                            <div class="col-md-6">
                                <input id="nama_sub" type="text" class="form-control" name="nama_sub" value="">

                                @if ($errors->has('nama_sub'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_sub') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br/><br/> <br/>


				 
                <div class="form-group">
			
         <label for="rayon" class="col-md-4 control-label">Rayon</label>
				
			
				
				<div class="col-md-6">	
					<select name="id_area" class="form-control">
					<option value="{{$area->id_area}}">
						{{$area->nama_area}}
					</option>
					
				</div>

				</div><br/><br/> <br/> 

				<div class="form-group">		
				
				<div class="col-md-6">	
					<select name="korban" class="form-control">
					<option value="">
					</option>
		
				</div>

				</div><br/><br/> <br/> 

				
     		   <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="file" class="form-control" name="gambar" value="">

                                @if ($errors->has('gambar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gambar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


     		    <div class="form-group"><br/> <br/>
				<div class="col-md-6 col-md-offset-4"><br/> <br/>
    			<button type="submit" class="btn btn-primary">
                                    Tambahkan
                                </button>
				</div>
    			</form>
    			</div>
      </div>
    </div>
  </div>
</div>
@endsection