<?php

use Illuminate\Database\Seeder;
use App\Kelas;

class kelasSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $kelas = new Kelas;
      $kelas->nama = '2101.1';
      $kelas->id_lantai = '1';
      $kelas->save();

      $kelas = new Kelas;
      $kelas->nama = '2101.2';
      $kelas->id_lantai = '1';
      $kelas->save();
    }
}
