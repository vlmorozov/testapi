<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class DemoClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (!DB::table('clients')->where('id', '123456789')->first()) {
            DB::table('clients')->insert([
                'id' => '123456789',
                'password' => bcrypt('secret'),
            ]);
        }
    }
}
