<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
  protected $table = 'kelas';
  public $timestamps = false;

  protected $fillable = [
      'id',
      'nama',
      'id_lantai'
  ];

  public function alat(){
    return $this->hasMany('App\Alat', 'id_kelas');
  }

  public function lantai(){
    return $this->belongsTo('App\Lantai', 'id_lantai');
  }

}
