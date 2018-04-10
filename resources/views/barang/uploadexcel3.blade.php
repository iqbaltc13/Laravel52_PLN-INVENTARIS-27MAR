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
     		   
            <label for="gambar" class="col-md-4 control-label">Format Upload(dengan Nomor Inventaris)</label>
          			<div class="col-md-8" align=>
          				<a class="btn btn-success" href="{{ asset('public/contoh dengan nomor inventaris.xls') }}">Lihat Format</a>
            		</div>
      			</div>
            <br><br><br><br>
            <div class="form-group">
          {!! Form::open( ['action' => 'BarangController@uploadexcel','files'=>true]) !!}
        {!! Form::label('import_file', 'Upload File Excel(Dengan nomor inventaris)', array('class' => 'col-md-4 control-label'))  !!}
        <div class="col-md-6">
             {!! Form::file('import_file',['class' => 'form-control']) !!}

          
        
        </div>
           </div>

            <div class="form-group"><br/> 
        <div class="col-md-6 col-md-offset-4">
          {!! Form::submit('Upload File', ['class'=>'btn primary']) !!}
        </div>
          </form>
          </div>

           <br><br><br><br><br><br>
            <div class="form-group">
           
             <label for="gambar" class="col-md-4 control-label">Format Upload tanpa Nomor Inventaris</label>
                <div class="col-md-8" align=>
                  <a class="btn btn-success" href="{{ asset('public/contoh tanpa nomor inventaris.xls') }}">Lihat Format</a>
                </div>
            </div>
      			<br><br><br>
				




        
              <form class="form-horizontal" role="form" method="POST" action="{{ url('/barang/uploadexcel2') }}" enctype="multipart/form-data">
           <div class="form-group">
        
        {!! Form::label('import_file', 'Upload File Excel(tanpa Nomor Inventaris)', array('class' => 'col-md-4 control-label'))  !!}
        <div class="col-md-6">
             {!! Form::file('import_file',['class' => 'form-control']) !!}

          
        
        </div>
           </div>
 




     		    <div class="form-group">
				<div class="col-md-6 col-md-offset-4">
    			{!! Form::submit('Upload File', ['class'=>'btn primary']) !!}
				</div>
    	</form>
    			</div>
      </div>
    </div>
  </div>
</div>
@endsection