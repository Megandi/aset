<?php

use Illuminate\Database\Seeder;
use App\Alat;

class alatSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $alat = new Alat;
      $alat->nama = 'Lampu';
      $alat->keterangan = 'Sudah diperbaiki';
      $alat->status = '0';
      $alat->id_kelas = '1';
      $alat->save();

      $alat = new Alat;
      $alat->nama = 'Papan tulis';
      $alat->keterangan = 'Sudah diperbaiki';
      $alat->status = '1';
      $alat->id_kelas = '1';
      $alat->save();

    }
}
