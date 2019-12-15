<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function __construct()
    {
        // injection de données à une vue partielle
        view()->composer('partials.menu', function ($view) {
            $categoriesMenu = Category::pluck('name', 'id')->all(); // on récupère un tableau de type [2=>'femme', 1=>'homme']

            ksort($categoriesMenu); // on remet le tableau dans l'ordre en fonction de l'id et non du name

            $view->with('categoriesMenu', $categoriesMenu);
        });
    }

    // retourne tous les produits
    public function index() {

        $products = Product::where('visible', 'like', 'published')->paginate(6);

        return view('front.index', ['products' => $products]);
    }

    // retourne un produit en fonction de son identifiant
    public function show(int $id) {
        $product = Product::find($id);

        return view('front.show', ['product' => $product]);
    }

    // retourne tous les produits en solde
    public function showSalesProduct() {
        $products = Product::where('visible', 'like', 'published')->where('status', 'like', 'sale')->paginate(6);

        return view('front.sale', ['products' => $products]);
    }

    // retourne un produit en fonction de son identifiant
    public function showProductByCategory(int $id) {
        $products =  Category::find($id)->product()->where('visible', 'like', 'published')->paginate(6); // retourne les produits d'une catégorie en fonction de son identifiant
        $category = Category::find($id);

        return view('front.category', [
            'products' => $products,
            'category' => $category
        ]);
    }
}
