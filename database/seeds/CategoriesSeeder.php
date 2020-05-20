<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            	// insert data ke table categories
                DB::table('categories')->insert([
                    'title' => 'Dosa'
                ]);

                DB::table('categories')->insert([
                    'title' => 'Pahala'
                ]);
    }
}
