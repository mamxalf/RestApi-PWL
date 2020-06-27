<?php

use App\Fotografer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        Fotografer::unguard();
        $this->call(FotografersTableSeeder::class);
        Fotografer::reguard();
    }
}
