<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lantai extends Model
{
    protected $table = 'lantai';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nama',
        'id_gedung'
    ];

    public function kelas(){
      return $this->hasMany('App\Kelas', 'id_lantai');
    }

    public function gedung(){
      return $this->belongsTo('App\Gedung', 'id_gedung');
    }

}
