<?php

use App\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Créaqtion des catégories
        App\Category::create([
            'name' => 'Homme',
        ]);
        App\Category::create([
            'name' => 'Femme'
        ]);

        // Créaqtion des tailles
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

        // Suppression des images avant renvoi des seeders
        Storage::disk('local')->delete(Storage::allFiles());

        // création de 80 produits exemple
        factory(Product::class, 20)->create()->each(function($product){
            // Association à une catégorie
            $category = App\Category::find(rand(1,2)); // on récupère l'id random d'une catégorie
            $product->category()->associate($category); // pour chaque livre crée, on lui associe la catégorie avec l'id random

            // Association à une taille
            $size = App\Size::find(rand(1,5)); // on récupère l'id random d'une taille
            $product->size()->associate($size); // pour chaque livre crée, on lui associe la taille avec l'id random

            $product->save(); // sauvegarde de l'association pour faire persister en base

            // Association à une image
            $link = Str::random(12) . '.jpg'; // hash du lien pour se protéger des injections de scripts
            $file = file_get_contents('https://picsum.photos/id/'.rand(1, 9).'/250/250/'); // récupération du flux
            Storage::disk('local')->put($link, $file);

            // Enregistrement dans la table pictures, book_id crée automatiquement
            $product->picture()->create([
                'link'  =>  $link
            ]);

        });
    }
}
