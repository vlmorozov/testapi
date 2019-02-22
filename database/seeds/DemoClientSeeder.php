<?php

use Illuminate\Database\Seeder;

class DemoClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('clients')->insert([
            'id' => '123456789',
            'password' => bcrypt('secret'),
        ]);
    }
}
