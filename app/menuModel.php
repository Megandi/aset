<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class menuModel extends Model
{
  protected $table = 'menus';
  public $timestamps = false;

  protected $fillable = [
      'id',
      'nama'
  ];
}
