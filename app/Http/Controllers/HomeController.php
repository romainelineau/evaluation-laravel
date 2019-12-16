<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // redirection automatique /home vers /admin
        return redirect('admin');
    }
    public function admin()
    {
        // redirection automatique /admin vers /admin-produits
        return redirect('admin/produits');
    }
}
