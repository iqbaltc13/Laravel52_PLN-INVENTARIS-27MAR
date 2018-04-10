<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
Route::group( [
    'middleware' => 'auth' ,
        ] , function() {

        	
Route::get('/maintenance',function(){
  return view('maintenance');
});

Route::get('/barang', 'BarangController@index');
Route::get('/barang/create/{fid_area}', 'BarangController@create');
Route::post('/barang/create/{fid_area}', array('before' => 'csrf', 'uses' => 'BarangController@create'));
Route::get('/barang/update/{id}', 'BarangController@update');
Route::post('/barang/update/{id}', array('before' => 'csrf', 'uses' => 'BarangController@update'));
Route::post('/barang/delete/{id}', array('before' => 'csrf', 'uses' => 'BarangController@delete'));
Route::get('/barang/delete/{id}', 'BarangController@delete');
Route::get('/barang/detail/{id}', 'BarangController@detail');
Route::get('/barang/barcode/{id}','BarangController@barcode');
Route::get('/barang/allbarcode/','BarangController@allbarcode');
Route::get('/barang/search', 'BarangController@index2');
Route::post('/barang/search',array('before' => 'csrf', 'uses' => 'BarangController@search'));
Route::get('/barang/coco', 'BarangController@printpdf');
Route::post('/barang/search/forprint',array('before' => 'csrf', 'uses' => 'BarangController@forprint'));
Route::post('/barang/search/forexcel',array('before' => 'csrf', 'uses' => 'BarangController@forexcel'));
Route::post('/barang/search/allbarcode',array('before' => 'csrf', 'uses' => 'BarangController@forbarcode'));

Route::get('/barang/printpdf', 'BarangController@printpdf');
Route::get('/barang/uploadexcel', 'BarangController@uploadexcel');
Route::post('/barang/uploadexcel',array('before' => 'csrf', 'uses' =>  'BarangController@uploadexcel'));
Route::post('/barang/uploadexcel2',array('before' => 'csrf', 'uses' =>  'BarangController@uploadexcel2'));
Route::post('/barang/delete2', array('before' => 'csrf', 'uses' => 'BarangController@delete2'));
Route::get('/barang/delete2','BarangController@delete2');

Route::get('/area', 'AreaController@index');
Route::get('/area/create', 'AreaController@create');
Route::post('/area/create', array('before' => 'csrf', 'uses' => 'AreaController@create'));
Route::get('/area/update/{id}', 'AreaController@update');
Route::post('/area/update/{id}', array('before' => 'csrf', 'uses' => 'AreaController@update'));
Route::get('/area/delete/{id}', 'AreaController@delete');
Route::get('/area/detail/{id}', 'AreaController@detail');
Route::get('/area/forprint/{id}', 'AreaController@cetakbarang');
Route::get('/area/cetakexcel/{id}', 'AreaController@cetakexcel');

Route::get('/sublokasi/create/{id_area}', 'SublokasiController@create');
Route::post('/sublokasi/create/{id_area}', array('before' => 'csrf', 'uses' => 'SublokasiController@create'));
Route::get('/sublokasi/detail/{id}', 'SublokasiController@detail');
Route::get('/sublokasi/update/{id}', 'SublokasiController@update');
Route::post('/sublokasi/update/{id}', array('before' => 'csrf', 'uses' => 'SublokasiController@update'));
Route::get('/sublokasi/delete/{id}', 'SublokasiController@delete');


Route::get('/ruang', 'RuangController@index');
Route::get('/ruang/create', 'RuangController@create');
Route::post('/ruang/create', array('before' => 'csrf', 'uses' => 'RuangController@create'));
Route::get('/ruang/update/{id}', 'RuangController@update');
Route::post('/ruang/update/{id}', array('before' => 'csrf', 'uses' => 'RuangController@update'));
Route::get('/ruang/delete/{id}', 'RuangController@delete');
Route::get('/ruang/detail/{id}', 'RuangController@detail');
Route::get('/ruang/forprint/{id}', 'RuangController@cetakbarang');
Route::get('/ruang/cetakexcel/{id}', 'RuangController@cetakexcel');
});

Route::auth();

Route::get('/home', 'HomeController@index');
