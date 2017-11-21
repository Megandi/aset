<?php

use Illuminate\Database\Seeder
use App\Lantai;

class lantaiSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $lantai = new Lantai;
      $lantai->nama = 'Lantai 1';
      $lantai->id_gedung = '1';
      $lantai->save();

      $lantai = new Lantai;
      $lantai->nama = 'Lantai 2';
      $lantai->id_gedung = '1';
      $lantai->save();

      $lantai = new Lantai;
      $lantai->nama = 'Lantai 3';
      $lantai->id_gedung = '1';
      $lantai->save();
    }
}
