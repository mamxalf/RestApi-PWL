<?php

use Illuminate\Database\Seeder;

class FotografersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Fotografer::class, 5)->create();
    }
}
