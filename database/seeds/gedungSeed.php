<?php

use Illuminate\Database\Seeder;
use App\Gedung;

class gedungSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $gedung = new Gedung;
      $gedung->nama = 'Griya Legita';
      $gedung->save();

      $gedung = new Gedung;
      $gedung->nama = 'Rektorat';
      $gedung->save();
    }
}
