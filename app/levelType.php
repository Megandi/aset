<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class levelType extends Model
{
  protected $table = 'lt_user_type';
  
  public $timestamps = false;

  protected $fillable = [
      'id',
      'name'
  ];
}
