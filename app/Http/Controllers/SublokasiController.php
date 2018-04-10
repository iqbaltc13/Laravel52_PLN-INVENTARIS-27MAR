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


class SublokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_area)
    {
        //
        if (Request::isMethod('get')) {
            $daftar_area['area'] = Area::find($id_area);
            return view('sublokasi.create',$daftar_area, $id_area);
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

            Sublokasi::insertGetId(array(
                    'nama_sub' => $data['nama_sub'], 
                    'fid_area' => $data['id_area'], 
                    'gambar' => $gambar
             ));


            // $item = array('nama_ruang' => Input::get('nama_ruang')
            //     , 'merek' => Input::get('merek')
            //      , 'tahun' => Input::get('tahun')
            //       , 'jumlah' => Input::get('jumlah')
            //       , 'satuan' => Input::get('satuan')
            //        , 'fisik' => Input::get('fisik')
            //        , 'keterangan' => Input::get('keterangan')
            // );

            alert()->success('SubLokasi berhasil ditambahkan!');
             return redirect()->action('AreaController@detail', [$id_area]);
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
    public function detail($id)
    {
        //
        $item['sublokasi'] = Sublokasi::find($id);
        $daftar_barang['barang'] = Barang::where('fid_sub', $id)->get();
            return view('sublokasi.detail', $item,$daftar_barang);
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
    public function update($id)
    {
        //
        if (Request::isMethod("get")) {
            # code...
            $item['sublokasi'] = Sublokasi::find($id);
            return view('sublokasi.update', $item, $id);
            
        } elseif (Request::isMethod('post')) {
            # code...

            $item       = Sublokasi::find($id);


        if($item->gambar!=NULL){
            
            if (!empty(Input::file('gambar'))) {
                     $destinationPath = 'imgruang'; // upload path
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
                     $destinationPath = 'imgruang'; // upload path
                    $extension = Input::file('gambar')->getClientOriginalExtension(); // getting image extension
                     $fileName = rand(11111,99999).'.'.$extension; // renaming image
                    Input::file('gambar')->move($destinationPath, $fileName);
                    $gambar=$destinationPath. '/'.$fileName;}
            else{
                 $gambar=NULL;
            }

        }

            $item->nama_sub = Input::get('nama_sub');
            $item->fid_area=Input::get('id_area');
            $item->gambar=$gambar;
            $item->save();
            alert()->success('Update Sukses!');
            $idp=Input::get('id_area');
             return redirect()->action('AreaController@detail', [$item->fid_area]);
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
        $item = Sublokasi::find($id);

        try { 
         $item->delete();
        alert()->success('Sub Lokasi telah dihapus!');
        return back()->withInput();
    // Closures include ->first(), ->get(), ->pluck(), etc.
} catch(\Illuminate\Database\QueryException $ex){ 
  alert()->error('','Sublokasi tidak dapat dihapus! Silahkan hapus terlebih dahulu barang yang berhubungan dengan sublokasi ini.')->persistent('Close');
    return redirect()->action('AreaController@detail', [$item['fid_area']]);
  // Note any method of class PDOException can be called on $ex.
}
    }
}
