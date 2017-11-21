<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class levelAkses extends Model
{
  protected $table = 'level_akses';

  public $timestamps = false;

  protected $fillable = [
      'id',
      'id_level',
      'id_menu'
  ];

  public function menu()
  {
    return $this->belongsTo('App\menuModel', 'id_menu');
  }
}
