@extends('layouts.app')
 
@section('content')








    <div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">Upload Excel</div>
        <div class="panel-body">

       

		

				<ul>
					<li style="visibility:hidden">aaa</li>
				</ul>

     		   <div class="form-group">
     		   
            <label for="upload" class="col-md-4 control-label">Format Upload(dengan Nomor Inventaris)</label>
          			<div class="col-md-8" align=>
          				<a class="btn btn-success" href="{{ asset('public/contoh dengan nomor inventaris.xls') }}">Lihat Format</a>
            		</div>
      			</div>
            <br><br><br><br>
            <div class="form-group">
        
              <form class="form-horizontal" role="form" method="POST" action="{{ url('/barang/uploadexcel') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <label for="import_file" class="col-md-4 control-label">Upload File Excel(dengan Nomor Inventaris)</label>
     
        <div class="col-md-6">
             
               <input id="import_file" type="file" class="form-control" name="import_file" value="{{ old('import_file') }}">

          
        
        </div>
           </div>

            <div class="form-group"><br/> 
        <div class="col-md-6 col-md-offset-4">
               <button type="submit" class="btn btn-primary">
                                     Upload File
                                </button>
        </div>
          </form>
          </div>

           <br><br><br><br><br><br>
            <div class="form-group">
           
             <label for="upload" class="col-md-4 control-label">Format Upload tanpa Nomor Inventaris</label>
                <div class="col-md-8" align=>
                  <a class="btn btn-success" href="{{ asset('public/contoh tanpa nomor inventaris.xls') }}">Lihat Format</a>
                </div>
            </div>
      			<br><br><br>
				




        
              <form class="form-horizontal" role="form" method="POST" action="{{ url('/barang/uploadexcel2') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
           <div class="form-group">
           <label for="import_file" class="col-md-4 control-label">Upload File Excel(tanpa Nomor Inventaris)</label>
     
        
        <div class="col-md-6">
            <input id="import_file" type="file" class="form-control" name="import_file" value="{{ old('import_file') }}">
          
        
        </div>
           </div>
 




     		    <div class="form-group">
				<div class="col-md-6 col-md-offset-4">
    		
          <button type="submit" class="btn btn-primary">
                                     Upload File
                                </button>
				</div>
    	</form>
    			</div>
      </div>
    </div>
  </div>
</div>
@endsection