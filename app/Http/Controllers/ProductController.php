<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Size;
use App\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(5);

        return view('back.product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Récupération du tableau des tailles
        $sizes = Size::pluck('name', 'id')->all();
        // Récupération du tableau des catégories
        $categories = Category::pluck('name', 'id')->all();
        ksort($categories); // on tri le tableau avec l'id

        return view('back.product.create', ['sizes' => $sizes, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation des données saisies
        // Si incorrectes, redirection vers la page de création de formulaire
        $this->validate($request, [
            'name'  =>  'required|string|between:5,100',
            'description'   =>  'required|string',
            'price' =>  'required|regex:/^([0-9]+)(\.[0-9]{2}){0,1}$/',
            'visible' =>  'required|in:published,unpublished',
            'status' =>  'required|in:sale,standard',
            'reference' =>  'required|alpha_num|size:16',
            'category_id' =>  'required|integer',
            'sizes' => 'required|array',
            'sizes.*' => 'integer',
            'picture' => 'required|file|image'
        ]);

        // Insertion dans la table produit
        $product = Product::create($request->all());

        // Insertion dans la table sizes
        $product->sizes()->attach($request->sizes);

        // Insertion dans la table picture
        // Méthode store pour retourner un hash sécurisé
        $link = $request->file('picture')->store('');
        // Insertion dans la table pictures
        $product->picture()->create([
            'link' => $link
        ]);

        // Si tout est ok, redirection vers la page admin produits avec message de succès
        return redirect()->route('produits.index')->with('message', 'Produit ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Récupération du produit
        $product = Product::find($id);
        //Récupération du tableau des tailles
        $sizes = Size::pluck('name', 'id')->all();
        // Récupération du tableau des catégories
        $categories = Category::pluck('name', 'id')->all();
        ksort($categories); // on tri le tableau avec l'id

        return view('back.product.edit', ['product' =>  $product, 'sizes' => $sizes, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'  =>  'required|string|between:5,100',
            'description'   =>  'required|string',
            'price' =>  'required|regex:/^([0-9]+)(\.[0-9]{2}){0,1}$/',
            'visible' =>  'required|in:published,unpublished',
            'status' =>  'required|in:sale,standard',
            'reference' =>  'required|alpha_num|size:16',
            'category_id' =>  'required|integer',
            'sizes' => 'required|array',
            'sizes.*' => 'integer'
        ]);

        $product = Product::find($id);

        $product->update($request->all());

        $product->sizes()->sync($request->sizes);

        // On vérifie sur l'utilisateur a chargé une nouvelle image
        // Si c'est le cas, on remplace l'ancienne par la nouvelle
        // Sinon on ne fait rien, on laisse l'ancienne en BDD
        $newLink = $request->file('picture');

        if(!empty($newLink)) {
            // Suppression de l'image si elle existe
            if(!empty($product->picture['link'])) {
                // Suppression physique de l'image
                Storage::disk('local')->delete($product->picture['link']);
            }

            // Retourne un hash sécurisé
            $link = $request->file('picture')->store('');
            // Mise à jour dans la table pictures
            $product->picture()->update([
                'link' => $link
            ]);
        }

        return redirect()->route('produits.index')->with('message', 'Livre mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if(!empty($product->picture['link'])) {
            Storage::disk('local')->delete($product->picture['link']); // supprimer physiquement l'image
        }
        $product->delete();

        return redirect()->route('produits.index')->with('message', 'Produit supprimé !');
    }
}
