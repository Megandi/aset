<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
  protected $table = 'gedung';
  public $timestamps = false;

  protected $fillable = [
      'id',
      'nama'
  ];

  public function lantai(){
    return $this->hasMany('App\Lantai', 'id_gedung');
  }
}
