<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    //
    protected $table = "area";

    protected $primaryKey='id_area';

	protected $fillable = ['id_area', 'nama_area','alamat','telepon','kode_area','foto',]; 

	public function ruang(){
    	return $this->hasMany('App\Models\Ruang', 'fid_area', 'id_area');
    }
    	public function sublokasi(){
    	return $this->hasMany('App\Models\Sublokasi', 'fid_area', 'id_area');
    }
}
