<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManajemenAsset extends Model
{
  protected $table = 'manajemen_asset';
  public $timestamps = false;

  protected $fillable = [
      'id',
      'nama',
      'parent',
      'status',
      'keterangan',
      'header',
      'user_last_updated'
  ];

  public function user_last()
  {
    return $this->belongsTo('App\User', 'user_last_updated');
  }

  public function log()
  {
    return $this->hasMany('App\LogModel','id_aset');
  }

}
