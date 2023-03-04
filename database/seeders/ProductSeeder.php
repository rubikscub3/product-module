<?php

namespace Database\Seeders;

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
        $person = 'John Doe';

		Product::create([
			'name' => 'Product 1',
			'price' => 10.99,
			'status' => 'active',
			'person' => $person,
			'type' => 'item',
			'history' => []
		]);
    }
}
