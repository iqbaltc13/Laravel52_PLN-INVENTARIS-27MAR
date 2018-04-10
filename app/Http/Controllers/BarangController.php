<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use App\Models\Barang;
use App\Models\Area;
use App\Models\Ruang;
use App\Models\Sublokasi;
use Input;
use Request;
use DB;
use View;
use PDF;
use html;
use App;
use Excel;
use DNS1D;
use DNS2D;
use Alert;
use Redirect;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $daftar_inventaris['barang'] = Barang::orderBy('fid_area','asc')->orderBy('fid_sub', 'asc')->orderBy('fid_ruang', 'asc')->orderBy('noperarea', 'asc')->paginate(10);
        $daftar_ruang['ruang'] = Ruang::orderBy('fid_area','asc')->get();
        $daftar_area['area'] = Area::all();
$daftar_sublokasi['sublokasi']=Sublokasi::orderBy('fid_area','asc')->where('id_sub','>',0)->get();
        // Alert::message('Welcome back!');

            return view('barang.index',array('ruang' => $daftar_ruang, 'area' => $daftar_area ,'barang' => $daftar_inventaris,'sublokasi' => $daftar_sublokasi));
    }

    public function index2()
    {
        //
         $daftar_inventaris['barang'] = Barang::orderBy('fid_area','asc')->orderBy('fid_sub', 'asc')->orderBy('fid_ruang', 'asc')->orderBy('noperarea', 'asc')->paginate(10);
        $daftar_ruang['ruang'] = Ruang::orderBy('fid_area','asc')->get();
        $daftar_area['area'] = Area::all();
$daftar_sublokasi['sublokasi']=Sublokasi::orderBy('fid_area','asc')->where('id_sub','>',0)->get();
        // Alert::message('Welcome back!');

            return view('barang.index',array('ruang' => $daftar_ruang, 'area' => $daftar_area ,'barang' => $daftar_inventaris,'sublokasi' => $daftar_sublokasi));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create($fid_area)
    {
       
         if (Request::isMethod('get')) {

            
            $daftar_ruang['ruang'] = Ruang::where('fid_area', $fid_area)->get();
            $daftar_sublokasi['sublokasi'] = Sublokasi::where('fid_area', $fid_area)->get();
            $daftar_area['area'] = Area::all();
            $item['pilih'] = Area::find($fid_area);
            // return view('barang.create',$item,$daftar_ruang,$daftar_area);
            //dd($item['pilih']->id_area);

            //    $item[] = Area::find($fid_area);
            return view('barang.create', array('id2'=>$fid_area ,'ruang' => $daftar_ruang, 'area' => $daftar_area ,'pilih' => $item,'sublokasi' => $daftar_sublokasi));
        } elseif (Request::isMethod('post')) {
            $data = Input::all();

            // file start
   

              if (!empty($data['gambar'])) {
                     $destinationPath = 'imgbarang'; // upload path
                    $extension = Input::file('gambar')->getClientOriginalExtension(); // getting image extension
                     $fileName = rand(11111,99999).'.'.$extension; // renaming image
                    Input::file('gambar')->move($destinationPath, $fileName);
                    $gambar=$destinationPath. '/'.$fileName;}
            else{
                 $gambar=NULL;
    }
    

            // // file end

            // print $target_file_final;
            // out();
    $maxi= DB::table('barang')
    ->where('fid_area','=',$data['fid_area'])
    ->max('noperarea');

    $rea= DB::table('area')->select('kode_area')->where('id_area','=',$data['fid_area'])->first();
    $rua= DB::table('ruang')->select('kode_ruang')->where('id_ruang','=',$data['ruang'])->first();
    $sulok= DB::table('sublokasi')->select('nama_sub')->where('id_sub','=',$data['fid_sub'])->first();

    $norea= sprintf('%03d',$maxi+1);

    if(Input::get('tahun')>1999){
        $nohun=Input::get('tahun')%2000;
    }
    else{
        $nohun=Input::get('tahun')%1900;
    }
    $nohun=sprintf('%02d',$nohun);


  
    $noinv= $norea."/".$rua->kode_ruang."/".$rea->kode_area."/".$nohun;
    

   

    

    

            Barang::insertGetId(array(
                    'nama_barang' => $data['nama_barang'], 
                    'merek' => $data['merek'], 
                    'tahun' => $data['tahun'], 
                    'jumlah' => $data['jumlah'], 
                    'satuan' => $data['satuan'], 
                    'fisik' => $data['fisik'], 
                    'keterangan' => $data['keterangan'],
                    'fid_ruang' => $data['ruang'],
                    'gambar' => $gambar,
                    'fid_area' => $data['fid_area'],
                    'fid_sub' => $data['sublokasi'],
                    'noperarea' => $maxi+1,
                    'nama_sub' => $sulok->nama_sub,
                    'nomor_inventaris' => $noinv
             ));


            // $item = array('nama_barang' => Input::get('nama_barang')
            //     , 'merek' => Input::get('merek')
            //      , 'tahun' => Input::get('tahun')
            //       , 'jumlah' => Input::get('jumlah')
            //       , 'satuan' => Input::get('satuan')
            //        , 'fisik' => Input::get('fisik')
            //        , 'keterangan' => Input::get('keterangan')
            // );
             alert()->success('Barang berhasil ditambahkan!');
            return redirect('barang');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function printpdf()
    {

         // $daftar_inventaris['barang'] = Barang::all();

          // $data['barang'] = Barang::get();
        $data = Barang::where('id_barang', '=', 1);
            // return view('barang.forprint',array('barang' => $data));
      //  return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
      //   $excel->sheet('mySheet', function($sheet) use ($data)
      //   {
      //       // $sheet->loadView('barang.forprint', array('barang' => $data));
      //       $sheet->loadView('barang.forprint')
      // ->with('barang', $data);
      //       // $sheet->fromArray($data);
      //   });
      //  })->stream("xls");

        // $view = View::make('barang.forprint',$daftar_inventaris);
        // $contents = (string) $view;
        // $contents = $view->render();

        //  $html = App::make('dompdf.wrapper');
        // $html = $html->loadHtml(view('barang.forprint',$daftar_inventaris)->render());
        // return $html->download('card.pdf');


        // $pdf = PDF::loadView('barang.forprint',$data);
        // return $pdf->download('certificate.pdf');
        // $data=$data->get();

        // semua barang

        $item['barang'] = Barang::all();
        $pdf= PDF::loadView('barang.coco',$item);
         return $pdf->download('certificate.pdf');
         // close semua barang


        // return view('barang.coco',$item);

//          Excel::create('barang', function($excel) use($daftar_inventaris) {
//             $excel->sheet('Sheet 1', function($sheet) use($daftar_inventaris) {
//                  $sheet->fromArray($daftar_inventaris);
//                     });
//             })->export('xls');

//          exit();


//         Excel::create('New file', function($excel)

//                  $excel->sheet('New sheet', function($sheet) {

//         $sheet->loadView('barang.forprint');

//          });

// });
         // return $excel->download('Nsheet.xls');
        // return view('barang.forprint',$daftar_inventaris);
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id_barang)
    {
        //
        if (Request::isMethod("get")) {
            # code...
            $item['barang'] = Barang::find($id_barang);


            return view('barang.detail', $item);
        }
        elseif(Request::isMethod('post')){
        
            $daftar_inventaris['barang'] = Barang::all();

         return view('barang.index',$daftar_inventaris);
        }
           
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function search()
    {
    // Gets the query string from our form submission 
    // $query = Request::input('search');
    // Returns an array of articles that have the query string located somewhere within 
    // our articles titles. Paginates them so we can break up lots of search results.
    // $articles = DB::table('articles')->where('title', 'LIKE', '%' . $query . '%')->paginate(10);
        


// $daftar_barang['barang'] = Barang::all();
$term = Input::all();

// if(!empty($term['nama_barang'])){
//     $query = Request::input('nama_barang');
//     // $daftar_barang['barang'] = Barang::where('nama_barang', $term['nama_barang'])->get();
//      // $daftar_barang['barang']->where('nama_barang','=',$term['nama_barang']);
//      $daftar_barang['barang'] = DB::table('barang')->where('nama_barang', 'LIKE', '%' . $query . '%')->paginate(10);

// }
// if(!empty($term['merek'])){
//     $query = Request::input('merek');
//     // $daftar_barang['barang'] = Barang::where('merek', $term['merek'])->get();
//      $daftar_barang['barang']->where('merek','=',$term['merek']);
// }
// if(!empty($term['ruang'])){
//     // $daftar_barang['barang'] = Barang::where('fid_ruang', $term['ruang'])->get();
//     $daftar_barang['barang']->where('fid_ruang','=',$term['ruang']);
// }










    $users = Barang::orderBy('fid_area','asc')->orderBy('fid_sub', 'asc')->orderBy('fid_ruang', 'asc')->orderBy('noperarea', 'asc')->where('id_barang', '>', 0);






// $users = Barang::all();
// $daftar_barang['barang'] = Barang::all();

    $terima=array();
if (!empty($term['nama_barang'])) {
    // $daftar_barang['barang'] = $daftar_barang['barang']->where('nama_barang', 'LIKE', '%'.$term['nama_barang'].'%');
    $users = $users->where('nama_barang', 'LIKE', '%'.$term['nama_barang'].'%');
    $terima[0]=$term['nama_barang'];
}
$terima[0]="";

if (!empty($term['merek'])) {
    // $users = $users->where('Genre', 'LIKE', '%'.Input::get('genre').'%');
    $users = $users->where('merek', 'LIKE', '%'.$term['merek'].'%');
     $terima[1]=$term['merek'];
}

if (!empty($term['area'])) {

    // $daftar_barang['barang'] = $daftar_barang['barang']->where('nama_barang', 'LIKE', '%'.$term['nama_barang'].'%');
//     $rea = Area::where('id_area', '>', 0);
//     $arekod=array();

//     $rea = $rea->where('id_area', 'LIKE', '%'.$term['area'].'%');
//     // $users = $users->where('nama_barang', 'LIKE', '%'.$term['nama_barang'].'%');
//     $rea= $rea->get();
// foreach($rea as $reb):
//     foreach($reb->ruang as $lala):
//         foreach($lala->barang as $lele):
//             array_push($arekod,$lele->id_barang);
//         endforeach;
//     endforeach;
// endforeach;
    
   

//     $daftar_barang['barang'] = $users->get();
//     $daftaro['key'] = $arekod;

//     $terima[3]=$term['area'];

     $users = $users->where('fid_area','=',$term['area']);
     // $terima[2]=$term['ruang'];


}
if (!empty($term['ruang'])) {
    // $users = $users->where('Genre', 'LIKE', '%'.Input::get('genre').'%');
    $users = $users->where('fid_ruang', '=', $term['ruang']);
     $terima[2]=$term['ruang'];
} 
if (!empty($term['sublokasi'])) {
    // $users = $users->where('Genre', 'LIKE', '%'.Input::get('genre').'%');
    $users = $users->where('fid_sub', '=', $term['sublokasi']);
     $terima[3]=$term['sublokasi'];
} 

    // $terima[3]="";
    
     // $daftaro['key'] = NULL;

    // $users=$users->get()->toArray();

 $daftar_barang['barang'] = $users->get();
$daftar_area['area']=Area::all();
$daftar_ruang['ruang']=Ruang::orderBy('fid_area','asc')->get();
$daftar_sublokasi['sublokasi']=Sublokasi::orderBy('fid_area','asc')->where('id_sub','>',0)->get();
$term['seb'] = Input::all();


    // return Excel::create('itsolutionstuff_example', function($excel) use ($users) {
    //     $excel->sheet('mySheet', function($sheet) use ($users)
    //     {
    //         $sheet->fromArray($users);
    //     });
    //    })->download("xls");
     
        // $pdf= PDF::loadView('barang.forprint',array('barang' => $daftar_barang));
        //  return $pdf->download('certificate.pdf');


 return view('barang.search',array('ruang' => $daftar_ruang, 'area' => $daftar_area ,'barang' => $daftar_barang,'seb' => $term,'sublokasi' => $daftar_sublokasi));

    // returns a view and passes the view the list of articles and the original query.
    // return view('barang.search', compact('articles', 'query'));
        // return view('barang.search',$daftar_barang,$daftaro);
    }






     public function forprint()
    {
   
      $namafile="PLN";

    $users = Barang::orderBy('fid_area','asc')->orderBy('fid_sub', 'asc')->orderBy('fid_ruang', 'asc')->orderBy('noperarea', 'asc')->where('id_barang', '>', 0);



   $term = Input::all();
   $rua['ruang']=null;
   $rea['area']=null;
   $sulok['sublokasi']=null;

// $users = Barang::all();
// $daftar_barang['barang'] = Barang::all();

if (!empty($term['nama_barang'])) {
    // $daftar_barang['barang'] = $daftar_barang['barang']->where('nama_barang', 'LIKE', '%'.$term['nama_barang'].'%');
    $users = $users->where('nama_barang','LIKE', '%'.$term['nama_barang'].'%');
    $terima[0]=$term['nama_barang'];
    $namafile=$namafile." nama ".$term['nama_barang']." ";
}


if (!empty($term['merek'])) {
    // $users = $users->where('Genre', 'LIKE', '%'.Input::get('genre').'%');
    $users = $users->where('merek', 'LIKE', '%'.$term['merek'].'%');
     $terima[1]=$term['merek'];
         $namafile=$namafile." merek ".$term['merek']." ";
}
$terima[1]="";
   

if (!empty($term['area'])) {

    // $daftar_barang['barang'] = $daftar_barang['barang']->where('nama_barang', 'LIKE', '%'.$term['nama_barang'].'%');
//     $rea = Area::where('id_area', '>', 0);
//     $arekod=array();

//     $rea = $rea->where('id_area', 'LIKE', '%'.$term['area'].'%');
//     // $users = $users->where('nama_barang', 'LIKE', '%'.$term['nama_barang'].'%');
//     $rea= $rea->get();
// foreach($rea as $reb):
//     foreach($reb->ruang as $lala):
//         foreach($lala->barang as $lele):
//             array_push($arekod,$lele->id_barang);
//         endforeach;
//     endforeach;
// endforeach;
    
   

//     $daftar_barang['barang'] = $users->get();
//     $daftaro['key'] = $arekod;

//     $terima[3]=$term['area'];

     $users = $users->where('fid_area', '=', $term['area']);
     // $terima[2]=$term['ruang'];
    $rea['area']= DB::table('area')->select('nama_area')->where('id_area','=',$term['area'])->first();
    $reas= DB::table('area')->select('nama_area')->where('id_area','=',$term['area'])->first();
    $namafile=$namafile." rayon ".$reas->nama_area." ";
   

}
if (!empty($term['ruang'])) {
    // $users = $users->where('Genre', 'LIKE', '%'.Input::get('genre').'%');
    $users = $users->where('fid_ruang', '=', $term['ruang']);
    $rua['ruang']= DB::table('ruang')->where('id_ruang','=',$term['ruang'])->first();
     $ruas= DB::table('ruang')->select('nama_ruang')->where('id_ruang','=',$term['ruang'])->first();
    $namafile=$namafile." ruang ".$ruas->nama_ruang." ";
} 

if (!empty($term['sublokasi'])) {
    // $users = $users->where('Genre', 'LIKE', '%'.Input::get('genre').'%');
       $users = $users->where('fid_sub', '=', $term['sublokasi']);
    $sulok['sublokasi']= DB::table('sublokasi')->where('id_sub','=',$term['sublokasi'])->first();
     $sukol= DB::table('sublokasi')->select('nama_sub')->where('id_sub','=',$term['sublokasi'])->first();
    $namafile=$namafile." sublokasi ".$sukol->nama_sub." ";
} 


    // $terima[3]="";
    
     // $daftaro['key'] = NULL;

    // $users=$users->get()->toArray();

    $daftar_barang['barang'] = $users->get();

    // $term['seb'] = Input::all();
    // return Excel::create('itsolutionstuff_example', function($excel) use ($users) {
    //     $excel->sheet('mySheet', function($sheet) use ($users)
    //     {
    //         $sheet->fromArray($users);
    //     });
    //    })->download("xls");
    $term['seb'] = Input::all();
        $pdf= PDF::loadView('barang.forprint',array('barang' => $daftar_barang,'seb' => $term,'area' => $rea,'ruang' => $rua,'sublokasi' => $sulok));
        return $pdf->download($namafile.".pdf");
         
// return view('barang.forprint',$daftar_barang,$term);
 // return view('barang.search',array('ruang' => $daftar_ruang, 'area' => $daftar_area ,'barang' => $daftar_barang,'seb' => $term));

    // returns a view and passes the view the list of articles and the original query.
    // return view('barang.search', compact('articles', 'query'));
        // return view('barang.search',$daftar_barang,$daftaro);
    }


    public function forexcel()
    {
    // Gets the query string from our form submission 
    // $query = Request::input('search');
    // Returns an array of articles that have the query string located somewhere within 
    // our articles titles. Paginates them so we can break up lots of search results.
    // $articles = DB::table('articles')->where('title', 'LIKE', '%' . $query . '%')->paginate(10);
        
 
            # code...
          
       
// $daftar_barang['barang'] = Barang::all();
        // $term = Input::all();
        // var_dump($term);
// if(!empty($term['nama_barang'])){
//     $query = Request::input('nama_barang');
//     // $daftar_barang['barang'] = Barang::where('nama_barang', $term['nama_barang'])->get();
//      // $daftar_barang['barang']->where('nama_barang','=',$term['nama_barang']);
//      $daftar_barang['barang'] = DB::table('barang')->where('nama_barang', 'LIKE', '%' . $query . '%')->paginate(10);

// }
// if(!empty($term['merek'])){
//     $query = Request::input('merek');
//     // $daftar_barang['barang'] = Barang::where('merek', $term['merek'])->get();
//      $daftar_barang['barang']->where('merek','=',$term['merek']);
// }
// if(!empty($term['ruang'])){
//     // $daftar_barang['barang'] = Barang::where('fid_ruang', $term['ruang'])->get();
//     $daftar_barang['barang']->where('fid_ruang','=',$term['ruang']);
// }










$users = Barang::select('nama_barang','merek','tahun','nomor_inventaris','jumlah','satuan','fisik','keterangan','nama_sub')->orderBy('fid_area','asc')->orderBy('fid_sub', 'asc')->orderBy('fid_ruang', 'asc')->orderBy('noperarea', 'asc')->where('id_barang', '>', 0);



   $term = Input::all();
$namafile="PLN";

// $users = Barang::all();
// $daftar_barang['barang'] = Barang::all();

    $terima=array();
if (!empty($term['nama_barang'])) {
    // $daftar_barang['barang'] = $daftar_barang['barang']->where('nama_barang', 'LIKE', '%'.$term['nama_barang'].'%');
    $users = $users->where('nama_barang', 'LIKE', '%'.$term['nama_barang'].'%');
     $namafile=$namafile." nama ".$term['nama_barang']." ";
}


if (!empty($term['merek'])) {
    // $users = $users->where('Genre', 'LIKE', '%'.Input::get('genre').'%');
    $users = $users->where('merek', 'LIKE', '%'.$term['merek'].'%');
  $namafile=$namafile." merek ".$term['merek']." ";
}


if (!empty($term['area'])) {

   

//     $daftar_barang['barang'] = $users->get();
//     $daftaro['key'] = $arekod;

//     $terima[3]=$term['area'];

     $users = $users->where('fid_area', '=', $term['area']);
     // $terima[2]=$term['ruang'];

   $reas= DB::table('area')->select('nama_area')->where('id_area','=',$term['area'])->first();
    $namafile=$namafile." rayon ".$reas->nama_area." ";

}
if (!empty($term['ruang'])) {
    // $users = $users->where('Genre', 'LIKE', '%'.Input::get('genre').'%');
    $users = $users->where('fid_ruang', '=',$term['ruang']);

     $ruas= DB::table('ruang')->select('nama_ruang')->where('id_ruang','=',$term['ruang'])->first();
    $namafile=$namafile." ruang ".$ruas->nama_ruang." ";
} 
if (!empty($term['sublokasi'])) {
    // $users = $users->where('Genre', 'LIKE', '%'.Input::get('genre').'%');
    $users = $users->where('fid_sub', '=', $term['sublokasi']);
    $sulok= DB::table('sublokasi')->select('nama_sub')->where('id_sub','=',$term['sublokasi'])->first();
        $namafile=$namafile." sublokasi ".$sulok->nama_sub." ";
} 

    // $terima[3]="";
    
     // $daftaro['key'] = NULL;

    // $users=$users->get()->toArray();

    $users=$users->get()->toArray();
    
    // $term['seb'] = Input::all();
return Excel::create($namafile, function($excel) use ($users) {
        $excel->sheet('mySheet', function($sheet) use ($users)
        {
            $sheet->fromArray($users);
        });
       })->export('xls');;
   
     
        // $pdf= PDF::loadView('barang.forprint',$daftar_barang,$term);
        // return $pdf->download('certificate.pdf');
         
// return view('barang.forprint',$daftar_barang,$term);
 // return view('barang.search',array('ruang' => $daftar_ruang, 'area' => $daftar_area ,'barang' => $daftar_barang,'seb' => $term));

    // returns a view and passes the view the list of articles and the original query.
    // return view('barang.search', compact('articles', 'query'));
        // return view('barang.search',$daftar_barang,$daftaro);
    }

        public function barcode($id)
    {
        $daftar_barang= Barang::all();
        foreach ($daftar_barang as $abc) {
    $sulok= DB::table('sublokasi')->select('nama_sub')->where('id_sub','=',$abc['fid_sub'])->first();

      DB::table('barang')->where('id_barang', '=', $abc['id_barang'])->update(array('nama_sub' => $sulok->nama_sub));
        }

    }

        public function forbarcode()
    {
   

    $users = Barang::orderBy('fid_area','asc')->orderBy('fid_sub', 'asc')->orderBy('fid_ruang', 'asc')->orderBy('noperarea', 'asc')->where('id_barang', '>', 0);


 $term = Input::all();
  $namafile="Barcode PLN";


// $users = Barang::all();
// $daftar_barang['barang'] = Barang::all();

if (!empty($term['nama_barang'])) {
    // $daftar_barang['barang'] = $daftar_barang['barang']->where('nama_barang', 'LIKE', '%'.$term['nama_barang'].'%');
    $users = $users->where('nama_barang','LIKE', '%'.$term['nama_barang'].'%');
    $namafile=$namafile." nama ".$term['nama_barang']." ";
    $namafile=$namafile." nama ".$term['nama_barang']." ";
}


if (!empty($term['merek'])) {
    // $users = $users->where('Genre', 'LIKE', '%'.Input::get('genre').'%');
    $users = $users->where('merek', 'LIKE', '%'.$term['merek'].'%');
       $namafile=$namafile." merek ".$term['merek']." ";
}

   

if (!empty($term['area'])) {


     $users = $users->where('fid_area', '=', $term['area']);
     // $terima[2]=$term['ruang'];
     $reas= DB::table('area')->select('nama_area')->where('id_area','=',$term['area'])->first();
    $namafile=$namafile." rayon ".$reas->nama_area." ";
   

}
if (!empty($term['ruang'])) {
    // $users = $users->where('Genre', 'LIKE', '%'.Input::get('genre').'%');
    $users = $users->where('fid_ruang', '=', $term['ruang']);
    $ruas= DB::table('ruang')->select('nama_ruang')->where('id_ruang','=',$term['ruang'])->first();
    $namafile=$namafile." ruang ".$ruas->nama_ruang." ";
} 
if (!empty($term['sublokasi'])) {
    // $users = $users->where('Genre', 'LIKE', '%'.Input::get('genre').'%');
    $users = $users->where('fid_sub', '=', $term['sublokasi']);
    $sulok= DB::table('sublokasi')->select('nama_sub')->where('id_sub','=',$term['sublokasi'])->first();
    $namafile=$namafile." sublokasi ".$sulok->nama_sub." ";
} 


    // $terima[3]="";
    
     // $daftaro['key'] = NULL;

    // $users=$users->get()->toArray();

    $item['barang'] = $users->get();
    $x=$users->get();
        $counter=0;
          foreach($x as $y):
            // $result = str_replace('/','',$y->nomor_inventaris);
         $bar['codbar'][$counter]= DNS1D::getBarcodeHTML($y->nomor_inventaris, "C128");
     $counter=$counter+1;
          endforeach;

          // $bar['codbar']= DNS1D::getBarcodeHTML($x[0]->nomor_inventaris, "C39");
          $pdf= PDF::loadView('barang.allbarcode',$bar,$item);
          return $pdf->download($namafile.".pdf");
   
         
// return view('barang.forprint',$daftar_barang,$term);
 // return view('barang.search',array('ruang' => $daftar_ruang, 'area' => $daftar_area ,'barang' => $daftar_barang,'seb' => $term));

    // returns a view and passes the view the list of articles and the original query.
    // return view('barang.search', compact('articles', 'query'));
        // return view('barang.search',$daftar_barang,$daftaro);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id_barang)
    {
        //
        if (Request::isMethod("get")) {
            # code...
            $item['lala'] = Barang::find($id_barang);
            $semua['yeye'] = Ruang::orderBy('fid_area','asc')->get();
            $daftar_sublokasi['sublokasi']= Sublokasi::where('id_sub','>',0)->orderby('fid_area','asc')->get();
            return view('barang.update',array('lala' => $item, 'yeye' => $semua ,'sublokasi' => $daftar_sublokasi));
        } elseif (Request::isMethod('post')) {
            # code...

            $item       = Barang::find($id_barang);

            if(Input::get('fid_sub')!=-1)
            {
            $rua2= DB::table('ruang')->select('fid_area')->where('id_ruang','=',Input::get('fid_ruang'))->first();
            $sulok2= DB::table('sublokasi')->select('fid_area')->where('id_sub','=', Input::get('fid_sub'))->first();
            
                if($rua2->fid_area!=$sulok2->fid_area)
                {
                alert()->error('Rayon untuk ruang dan sublokasi tidak sama');
                return back()->withInput();
                }
            }
        if($item->gambar!=NULL){
            
            if (!empty(Input::file('gambar'))) {
                     $destinationPath = 'imgbarang'; // upload path
                    $extension = Input::file('gambar')->getClientOriginalExtension(); // getting image extension
                     $fileName = rand(11111,99999).'.'.$extension; // renaming image
                    Input::file('gambar')->move($destinationPath, $fileName);
                    $gambar=$destinationPath. '/'.$fileName;}
            else{
                 $gambar=$item->gambar;
            }
        }
        else{
                
            if (!empty(Input::file('gambar'))) {
                     $destinationPath = 'imgbarang'; // upload path
                    $extension = Input::file('gambar')->getClientOriginalExtension(); // getting image extension
                     $fileName = rand(11111,99999).'.'.$extension; // renaming image
                    Input::file('gambar')->move($destinationPath, $fileName);
                    $gambar=$destinationPath. '/'.$fileName;}
            else{
                 $gambar=NULL;
            }

        }


    // $rea= DB::table('area')->select('kode_area')->where('id_area','=',Input::get('fid_area')->first();
    $rua= DB::table('ruang')->select('kode_ruang')->where('id_ruang','=',Input::get('fid_ruang'))->first();
    $cari = Ruang::find(Input::get('fid_ruang'));



    $norea= sprintf('%03d',Input::get('nomor_barang'));

    if(Input::get('tahun')>1999){
        $nohun=Input::get('tahun')%2000;
    }
    else{
        $nohun=Input::get('tahun')%1900;
    }
    $nohun=sprintf('%02d',$nohun);
 
    $noinv= $norea."/".$rua->kode_ruang."/".$cari->area->kode_area."/".$nohun;
     $sulok= DB::table('sublokasi')->select('nama_sub')->where('id_sub','=',$item->fid_sub)->first();

            $item->nama_barang = Input::get('nama_barang');
            $item->merek = Input::get('merek');
            $item->tahun = Input::get('tahun');
            $item->jumlah = Input::get('jumlah');
            $item->satuan = Input::get('satuan');
            $item->fisik = Input::get('fisik');
            $item->keterangan = Input::get('keterangan');
            $item->fid_ruang = Input::get('fid_ruang');
            $item->fid_area=$cari->area->id_area;
            $item->gambar=$gambar;
            $item->noperarea=Input::get('nomor_barang');
            $item->nomor_inventaris=$noinv;
            $item->fid_sub= Input::get('fid_sub');
            $item->nama_sub= $sulok->nama_sub;
            $item->save();
            alert()->success('Update Sukses!');
            return redirect('barang');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

        public function delete($id)
    {
        //
        $item = Barang::find($id);
        if($item->delete())
        {
        $item->delete();
        alert()->success('Barang telah dihapus!');
         return back()->withInput();
        }
    }

    // public function barcode($id)
    //     {
    //        $daftar_inventaris = Barang::all();
    //        foreach ($daftar_inventaris as $item):
    //          $rua= DB::table('sublokasi')->select('nama_sub')->where('id_sub','=',$item['fid_sub'])->first();
    //         DB::table('barang')->where('id_barang', $item['id_barang'])->update(['nama_sub' => $rua->nama_sub]);
    //         endforeach;
    //     }

        public function allbarcode()
        {
          $x=DB::table('barang')->select('nomor_inventaris')->where('id_barang', '>', 0)->orderBy('fid_ruang','asc')->get();
          // echo $x[0]->nomor_inventaris;

          $counter=0;
          foreach($x as $y):
            // $result = str_replace('/','',$y->nomor_inventaris);
         $bar['codbar'][$counter]= DNS1D::getBarcodeHTML($y->nomor_inventaris, "C128");
     $counter=$counter+1;
          endforeach;

          // $bar['codbar']= DNS1D::getBarcodeHTML($x[0]->nomor_inventaris, "C39");
          $item['barang'] = Barang::select('nomor_inventaris')->orderBy('fid_ruang','asc')->get();
          $pdf= PDF::loadView('barang.allbarcode',$bar,$item);
          return $pdf->download("semua_barcode.pdf");
        }


     public function uploadexcel()
    {
        if (Request::isMethod('get')) {
            return view('barang.uploadexcel');
        } elseif (Request::isMethod('post')) {
            $berhasil=0;
            $gagal=null;
            $gakod=array();
            $nogagal=0;
                    if(Input::hasFile('import_file')){
                 $path = Input::file('import_file')->getRealPath();

                 $data = Excel::load($path, function($reader) {
                 })->get();
                    if(!empty($data) && $data->count()){
                    foreach ($data as $key)
                     {
                        foreach($key as $value){
                    // $insert[] = ['nama_barang' => $value->nama_barang, 'merek' => $value->merek];
                    // echo $value->nama_barang;
                            $abc=str_replace(' ', '', $value->nomor_inventaris);
$angka=substr($abc,0,3)*1;
$koruang=substr($abc,4,3);
$koarea=substr($abc,8,3);
// echo $angka;
// echo " ";
// echo $koruang;
// echo " ";
// echo $koarea;
// echo " ";
// exit();
$sukol=null;

if($value->sublokasi==NULL)
{
    $sukol=-1;
    $namasukol="";
}
else{
    $sulok= DB::table('sublokasi')->select('id_sub','nama_sub')->where('nama_sub','=',$value->sublokasi)->first();

    if($sulok==null)
        {
            if (in_array($value->sublokasi, $gakod)) {}
            else{
            $fales='Sublokasi '.$value->sublokasi.' tidak ada di sistem';
            $gagal=$gagal.' '.$fales."\n";
            array_push($gakod,$value->sublokasi);
            // alert()->error($fales);
            // return redirect('barang');
            }
        }
        else{
            $sukol=$sulok->id_sub;
            $namasukol=$sulok->nama_sub;
        }
}


if($angka!=null){
        $cekinv=DB::table('barang')->select('nomor_inventaris')->where('nomor_inventaris','=',$abc)->first();
        if($cekinv!=null)
        {   $nogagal=$nogagal+1;
            if($nogagal<6){
            $fales='Nomor Inventaris '.$abc.' telah ada di sistem';
            $gagal=$gagal.' '.$fales."\n";
            }
        }

        $reas= DB::table('area')->select('id_area')->where('kode_area','=',$koarea)->first();
        if($reas==null)
        {
            if (in_array($koarea, $gakod)) {}
            else{
            $fales='Kode Rayon '.$koarea.' tidak ada di sistem';
            $gagal=$gagal.' '.$fales."\n";
            // alert()->error($fales);
            // return redirect('barang');
            array_push($gakod,$koarea);
            }
        }
    else{
     $ruas= DB::table('ruang')->select('id_ruang')->where('fid_area','=',$reas->id_area)->where('kode_ruang','=',$koruang)->first();
     if($ruas==null)
        {
            if (in_array($koruang, $gakod)) {}
            else{
            $fales='Kode Ruang '.$koruang.' tidak ada di sistem';
            $gagal=$gagal.' '.$fales."\n";
            // alert()->error($fales);
            // return redirect('barang');
            array_push($gakod,$koruang);
            }
        }
    }
    
} 

    
        if($value->nama_barang!=null && $value->nomor_inventaris!=null && $reas!=null && $ruas!=null && $sukol!=null && $cekinv==null)
        {
            $berhasil=$berhasil+1;
            Barang::insertGetId(array(
                    'nama_barang' => $value->nama_barang, 
                    'merek' => $value->merek, 
                    'tahun' => $value->tahun, 
                    'jumlah' => $value->jumlah, 
                    'satuan' => $value->satuan, 
                    'fisik' => $value->fisik, 
                    'keterangan' => $value->keterangan,
                    'fid_ruang' => $ruas->id_ruang,
                    'fid_area' => $reas->id_area,
                    'fid_sub' => $sukol,
                    'nama_sub' => $namasukol,
                    'noperarea' => $angka,
                    'nomor_inventaris' => $abc
                    ));
        }
                        }

                    }
                    
                    }
                }
                if($nogagal>5)
                {
                    $gagal=$gagal.' '.$nogagal.' barang memiliki nomor inventaris yang telah ada di sistem'."\n";
                }

                $pesan=$berhasil.' barang masuk ke dalam sistem!';
        // Alert::message('Welcome back!');
             alert()->success($gagal,$pesan)->persistent("close");
            return redirect('barang');
                
    }
        //
        
    }
   

   

    public function uploadexcel2()
    {
        //
        if (Request::isMethod('get')) {
            return view('barang.uploadexcel');
        } elseif (Request::isMethod('post')) {
            $gagal=null;
            $berhasil=0;
                    if(Input::hasFile('import_file')){
                 $path = Input::file('import_file')->getRealPath();

                 $data = Excel::load($path, function($reader) {
                 })->get();
                    if(!empty($data) && $data->count()){
                    foreach ($data as $key)
                     {
                        foreach($key as $value){
                    // $insert[] = ['nama_barang' => $value->nama_barang, 'merek' => $value->merek];
                    // echo $value->nama_barang;
$sukol=null;
 if($value->sublokasi==NULL)
{
    $sukol=-1;
}
else{

    $sulok= DB::table('sublokasi')->select('id_sub')->where('nama_sub','=',$value->sublokasi)->first();

    if($sulok==null)
        {
            $fales='Sublokasi '.$value->sublokasi.' tidak ada di sistem';
            $gagal=$gagal.' '.$fales."\n";
            // alert()->error($fales);
            // return redirect('barang');
        }
        else{
            $sukol=$sulok->id_sub;
        }
}
                             $reas= DB::table('area')->select('id_area')->where('nama_area','LIKE','%'.$value->rayon.'%')->first();
                if($reas==null)
        {
            $fales='Rayon '.$value->rayon.' tidak ada di sistem';
            $gagal=$gagal.' '.$fales."\n";
            // alert()->error($fales);
            // return redirect('barang');
        }
                           $ruas= DB::table('ruang')->select('id_ruang')->where('fid_area','=',$reas->id_area)->where('nama_ruang','LIKE','%'.$value->ruangan.'%')->first();
         if($ruas==null)
        {
            $fales='Ruang '.$value->ruangan.' tidak ada di sistem';
            $gagal=$gagal.' '.$fales."\n";
            // alert()->error($fales);
            // return redirect('barang');
        }
    $maxi= DB::table('barang')
    ->where('fid_area','=',$reas->id_area)
    ->max('noperarea');

    $reagen= DB::table('area')->select('kode_area')->where('id_area','=',$reas->id_area)->first();
    $ruagen= DB::table('ruang')->select('kode_ruang')->where('id_ruang','=',$ruas->id_ruang)->first();

    $norea= sprintf('%04d',$maxi+1);

    if(Input::get('tahun')>1999){
        $nohun=Input::get('tahun')%2000;
    }
    else{
        $nohun=Input::get('tahun')%1900;
    }
    $nohun=sprintf('%02d',$nohun);


  
    $noinv= $norea."/".$ruagen->kode_ruang."/".$reagen->kode_area."/".$nohun;
    

   

    

    
        if($value->nama_barang!=null && $reas!=null && $ruas!=null && $sukol!=null){
            $berhasil=$berhasil+1;
            Barang::insertGetId(array(
                
                    'nama_barang' => $value->nama_barang, 
                    'merek' => $value->merek, 
                    'tahun' => $value->tahun, 
                    'jumlah' => $value->jumlah, 
                    'satuan' => $value->satuan, 
                    'fisik' => $value->fisik, 
                    'keterangan' => $value->keterangan,
                    'fid_ruang' => $ruas->id_ruang,
                    'fid_area' => $reas->id_area,
                    'fid_sub' => $sukol,
                    'noperarea' => $maxi+1,
                    'nomor_inventaris' => $noinv
                    ));
        }
                        }
                    }
                    
                    }
                }

        // Alert::message('Welcome back!');
                 $pesan=$berhasil.' barang masuk ke dalam sistem!';
              alert()->success($gagal,$pesan)->persistent("close");
            return redirect('barang');
        }           
       
    }


    public function delete2() {

 if (Request::isMethod('get')) {
        } elseif (Request::isMethod('post')) {
            $checked = Input::only('checked')['checked'];

            if($checked==null)
            {
                alert()->error('Silahkan pilih terlebih dahulu item yang akan dihapus')->persistent('close');
                return redirect()->action('BarangController@index');
            }

            // Do whatever you want with this array
            foreach($checked as $che):
               $item = Barang::find($che);
           // echo $che;
           // echo " ";
                if($item->delete())
             {
                 $item->delete();
             }
                endforeach;

                alert()->success('Barang telah dihapus!');
                return redirect()->action('BarangController@index');
        }
    }

}
