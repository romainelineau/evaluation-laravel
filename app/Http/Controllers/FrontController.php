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
        // retourne les derniers produits publiés
        $products = Product::where('visible', 'like', 'published')->orderBy('id', 'desc')->paginate(6);

        return view('front.index', ['products' => $products]);
    }

    // retourne un produit en fonction de son identifiant
    public function show(int $id) {
        $product = Product::find($id);

        // Récupération des tailles du produit pour les trier dans le bon ordre
        // Initialisation d'un tableau
        $sizesProduct = [];
        foreach($product->sizes as $sizeProduct) {
            $sizesProduct[$sizeProduct->id] = $sizeProduct->name; // on injecte une ligne dans le tableau
        }
        ksort($sizesProduct); // on tri le tableau en fonction de l'id

        return view('front.show', ['product' => $product, 'sizesProduct' => $sizesProduct]);
    }

    // retourne tous les produits en solde
    public function showSalesProduct() {
        // retourne les derniers produits en solde ayant le statut publié
        $products = Product::where('visible', 'like', 'published')->where('status', 'like', 'sale')->orderBy('id', 'desc')->paginate(6);

        return view('front.sale', ['products' => $products]);
    }

    // retourne un produit en fonction de son identifiant
    public function showProductByCategory(int $id) {
        // retourne les derniers produits d'une catégorie en fonction de son identifiant et ayant le statut publié
        $products =  Category::find($id)->product()->where('visible', 'like', 'published')->orderBy('id', 'desc')->paginate(6);
        // on retourne égalemnent la catégorie sélectionné
        $category = Category::find($id);

        return view('front.category', [
            'products' => $products,
            'category' => $category
        ]);
    }
}
