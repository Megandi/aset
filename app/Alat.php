<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kelas;

class Alat extends Model
{
  protected $table = 'alat';
  public $timestamps = false;

  protected $fillable = [
      'id',
      'nama',
      'keterangan',
      'status',
      'foto',
      'no_aset',
      'id_kelas'
  ];

  public function kelas(){
    return $this->belongsTo('App\Kelas', 'id_kelas');
  }


}
