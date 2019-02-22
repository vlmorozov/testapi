<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        for ($i=1; $i<10; $i++)
        \Illuminate\Support\Facades\DB::table('products')->insert([
            'id' => $i,
            'quantity' => 10+$i,
        ]);
    }
}
