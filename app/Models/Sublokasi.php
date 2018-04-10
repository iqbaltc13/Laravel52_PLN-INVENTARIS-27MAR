<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sublokasi extends Model
{
    //
    protected $table = "sublokasi";

    protected $primaryKey='id_sub';

	protected $fillable = ['id_sub', 'nama_sub','fid_area','gambar']; 

	public function area(){
		return $this->belongsTo('App\Models\Area','fid_area','id_area');
	}

	public function barang(){
    	return $this->hasMany('App\Models\Barang', 'fid_sub', 'id_sub');
    }
}
