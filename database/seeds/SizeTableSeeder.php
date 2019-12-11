<?php

use Illuminate\Database\Seeder;

class SizeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Création des tailles
        App\Size::create([
            'name' => 'XS'
        ]);
        App\Size::create([
            'name' => 'S'
        ]);
        App\Size::create([
            'name' => 'M'
        ]);
        App\Size::create([
            'name' => 'L'
        ]);
        App\Size::create([
            'name' => 'XL'
        ]);
    }
}
