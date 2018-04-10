<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ruang;
use App\Models\Area;
use App\Models\Barang;
use App\Models\Sublokasi;
use Input;
//use Illuminate\Http\Request;
use PDF;
use Request;

use html;
use App;
// use Maatwebsite\Excel\Facades\Excel;
use Excel;

use View;




class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $daftar_area['area'] = Area::orderBy('id_area','asc')->paginate(10);
         return view('area.index',$daftar_area);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         if (Request::isMethod('get')) {
            return view('area.create');
        } elseif (Request::isMethod('post')) {
            $data = Input::all();


            // file start
   

              if (!Input::file('gambar')) {
                     $destinationPath = 'imgarea'; // upload path
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

            Area::insertGetId(array(
                    'nama_area' => $data['nama_area'], 
                    'alamat' => $data['alamat'], 
                    'telepon' => $data['telp'], 
                    'kode_area' => $data['kode_area'],
                    'foto' => $gambar,
             ));


            // $item = array('nama_area' => Input::get('nama_area')
            //     , 'merek' => Input::get('merek')
            //      , 'tahun' => Input::get('tahun')
            //       , 'jumlah' => Input::get('jumlah')
            //       , 'satuan' => Input::get('satuan')
            //        , 'fisik' => Input::get('fisik')
            //        , 'keterangan' => Input::get('keterangan')
            // );

            alert()->success('Rayon berhasil ditambahkan!');
            return redirect('area');
        }
    }

     public function tambahruang($id)
    {
        //
         if (Request::isMethod('get')) {
             $daftar_area['area'] = Area::find($id);
            return view('area.tambahruang',$daftar_area);
        } elseif (Request::isMethod('post')) {
            $data = Input::all();


            // file start
   

              if (!empty($data['gambar'])) {
                     $destinationPath = 'imgruang'; // upload path
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

            Ruang::insertGetId(array(
                    'nama_ruang' => $data['nama_ruang'], 
                    'fid_area' => $data['fid_area'], 
                     'kode_ruang' => $data['kode_ruang'], 
                    'foto' => $gambar
             ));


            // $item = array('nama_ruang' => Input::get('nama_ruang')
            //     , 'merek' => Input::get('merek')
            //      , 'tahun' => Input::get('tahun')
            //       , 'jumlah' => Input::get('jumlah')
            //       , 'satuan' => Input::get('satuan')
            //        , 'fisik' => Input::get('fisik')
            //        , 'keterangan' => Input::get('keterangan')
            // );

            alert()->success('Ruangan berhasil ditambahkan!');
            return redirect()->action('AreaController@detail', [$id]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id_area)
    {
        //
        $item['area'] = Area::find($id_area);
        $daftar_ruang['ruang'] = Ruang::where('fid_area', $id_area)->get();
        $daftar_sublokasi['sublokasi'] = Sublokasi::where('fid_area', $id_area)->get();
        $daftar_barang['barang'] = Barang::where('fid_area', $id_area)->orderBy('fid_ruang','asc')->get();
        return view('area.detail',array('ruang' => $daftar_ruang, 'area' => $item ,'barang' => $daftar_barang,'sublokasi' => $daftar_sublokasi));
    }

    public function cetakbarang($id)
    {
        //
        
        $item['area'] = Area::find($id);
        $users = Barang::where('id_barang', '>', 0)->orderBy('fid_ruang','asc');
        $users = $users->where('fid_area', 'LIKE', '%'.$id.'%');
        $daftar_barang['barang'] = $users->get();
        $namafile="PLN";
        $namafile=$namafile." Rayon ".$item['area']->nama_area." ";
         $pdf= PDF::loadView('area.forprint',$daftar_barang,$item);
        return $pdf->download($namafile.".pdf");
        // $daftar_barang['barang'] = Barang::where('fid_area', $id)->orderBy('fid_ruang','asc')->get();

    }

    //  public function barcode($id)
    // {
    //     //
        
    //     $item['area'] = Area::find($id);
    //     $users = Barang::where('id_barang', '>', 0)->orderBy('fid_ruang','asc');
    //     $users = $users->where('fid_area', 'LIKE', '%'.$id.'%');
    //     $daftar_barang['barang'] = $users->get();
    //     $namafile="PLN";
    //     $namafile=$namafile." Rayon ".$item['area']->nama_area." ";
        
    //      $pdf= PDF::loadView('area.forprint',$daftar_barang,$item);
    //     return $pdf->download($namafile.".pdf");
    //     // $daftar_barang['barang'] = Barang::where('fid_area', $id)->orderBy('fid_ruang','asc')->get();

    // }

    public function cetakexcel($id)
    {
        //
        $item['area'] = Area::find($id);
       $users = Barang::select('nomor_inventaris','nama_barang','merek','tahun','jumlah','satuan','fisik','keterangan')->orderBy('fid_ruang','asc')->where('id_barang', '>', 0);
        $users = $users->where('fid_area', 'LIKE', '%'.$id.'%');

        // $daftar_barang['barang'] = $users->get();

        $users=$users->get()->toArray();
        $namafile="PLN";
        $namafile=$namafile." Rayon ".$item['area']->nama_area." ";

        return Excel::create($namafile, function($excel) use ($users) {
        $excel->sheet('mySheet', function($sheet) use ($users)
        {
            
            $sheet->fromArray($users);
        });
       })->download("xls");



        //  $pdf= PDF::loadView('area.forprint',$daftar_barang,$item);
        // return $pdf->download('certificate.pdf');
        // // $daftar_barang['barang'] = Barang::where('fid_area', $id)->orderBy('fid_ruang','asc')->get();
        // return view('area.forprint',$item ,$daftar_barang);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id_area, Request $request)
    {
        //
        if (Request::isMethod("get")) {
            # code...
            $item['area'] = Area::find($id_area);
            $item['id']=$id_area;
            return view('area.update', $item);
            
        } elseif (Request::isMethod("post")) {
            # code...
            //$request->all();
            $item       = Area::find($id_area);


        if($item->gambar!=NULL){
            
            if (!empty(Input::file('gambar'))) {
                     $destinationPath = 'imgarea'; // upload path
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
                     $destinationPath = 'imgarea'; // upload path
                    $extension = Input::file('gambar')->getClientOriginalExtension(); // getting image extension
                     $fileName = rand(11111,99999).'.'.$extension; // renaming image
                    Input::file('gambar')->move($destinationPath, $fileName);
                    $gambar=$destinationPath. '/'.$fileName;}
            else{
                 $gambar=NULL;
            }

        }

            $item->nama_area = Input::get('nama_area');
            $item->alamat = Input::get('alamat');
            $item->telepon = Input::get('telepon');
            $item->kode_area= Input::get('kode_area');
            $item->foto=$gambar;
            $item->save();
 
            alert()->success('Update Sukses!');
             return redirect()->action('AreaController@index');
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
        $item = Area::find($id);
        try { 
  $item->delete();
        alert()->success('Rayon telah dihapus!');
         return back()->withInput();
    // Closures include ->first(), ->get(), ->pluck(), etc.
} catch(\Illuminate\Database\QueryException $ex){ 
  alert()->error('','Rayon tidak dapat dihapus! Silahkan hapus terlebih dahulu barang dan atau ruangan yang berhubungan dengan rayon ini.')->persistent('Close');
    return redirect()->action('AreaController@detail', [$item['fid_area']]);
  // Note any method of class PDOException can be called on $ex.
}
        
    }

   
}