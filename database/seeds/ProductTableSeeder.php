<?php

use App\Product;
use App\Size;
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

        // Suppression des images avant renvoi des seeders
        Storage::disk('local')->delete(Storage::allFiles());

        // création de 80 produits exemple
        factory(Product::class, 20)->create()->each(function($product){
            // Association à une catégorie
            $category = App\Category::find(rand(1,2)); // on récupère l'id random d'une catégorie
            $product->category()->associate($category); // pour chaque livre crée, on lui associe la catégorie avec l'id random
            $product->save(); // Sauvegarde de l'association pour faire persister en base

            // Association à une image
            $link = Str::random(12) . '.jpg'; // hash du lien pour se protéger des injections de scripts
            $file = file_get_contents('https://picsum.photos/id/'.rand(1, 9).'/511/639/'); // récupération du flux
            Storage::disk('local')->put($link, $file);

            // Enregistrement dans la table pictures, book_id crée automatiquement
            $product->picture()->create([
                'link'  =>  $link
            ]);

            // Association à une ou plusieurs tailles
            $sizes = Size::pluck('id')->shuffle()->slice(0, rand(1,5))->all(); // on récupère les id des tailles dans un tableau
            $product->sizes()->attach($sizes); // on attache les id des tailles dans la table de liaison

        });
    }
}
