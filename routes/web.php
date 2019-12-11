<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Page d'accueil du front
Route::get('/', 'FrontController@index')->name('home-front');

// Affichage d'un produit en fonction de son id, route sécurisée
Route::get('produit/{id}', 'FrontController@show')->where(['id' => '[0-9]+']);

// Page Soldes
Route::get('soldes', 'FrontController@showSalesProduct')->name('soldes');

// Affichage des produits d'une catégorie
Route::get('categorie/{id}', 'FrontController@showProductByCategory')->where(['id' => '[0-9]+']);

// Routes sécurisées de l'admin
Auth::routes();
Route::get('home', 'HomeController@index')->name('home');
Route::get('admin', 'HomeController@admin')->name('admin')->middleware('auth'); // redirige vers la page "admin/produits" si user authentifié
Route::resource('admin/produits', 'ProductController')->middleware('auth');
Route::resource('admin/categories', 'CategoryController')->middleware('auth');
