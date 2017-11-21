<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(alatSeed::class);
        $this->call(kelasSeed::class);
        $this->call(gedungSeed::class);
        $this->call(lantaiSeed::class);
        Model::reguard();
    }


}
