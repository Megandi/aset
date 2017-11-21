<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogModel extends Model
{
  protected $table = 'log';

  public $timestamps = false;

  protected $fillable = [
      'id',
      'id_aset',
      'log',
      'id_user',
      'waktu',
      'status_awal',
      'status_akhir'
  ];

  public function user()
  {
    return $this->belongsTo('App\User', 'id_user');
  }
}
