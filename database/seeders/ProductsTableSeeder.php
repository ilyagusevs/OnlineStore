<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        for($i = 1; $i < 21; $i++)
            DB::table('products')->insert([ 
                'title' => 'Product '.$i,
                'brand' => 'NIKE',
                'old_price' => rand(50, 500),
                'new_price' => rand(40, 350),
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ',
                'category_id' => rand(9, 16)
        ]);
    }
}
