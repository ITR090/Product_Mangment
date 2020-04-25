<?php

namespace App\Http\Controllers;


use App\Product;
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
        $products =  new Product();
        $newProducts=$products->orderBy('created_at','DESC')->get();
        return view('home',compact('newProducts'));
    }
    
}
