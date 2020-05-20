<?php

namespace App\Http\Controllers;


use App\Product;
use App\Charts\ProductsChart;
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
        $numberOfProudcts =[];
        for ($month=1; $month <= 12; $month++) { 
            array_push($numberOfProudcts, Product::whereMonth('created_at', $month)->count());
        }
        // bar
        $ProductsChart_bar = new ProductsChart;
        $ProductsChart_bar->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July','August','Septemper','October','November','December']);
        $ProductsChart_bar->dataset('Products','bar',$numberOfProudcts)->backgroundColor('rgb(255, 99, 132)')->color('rgb(255, 99, 132)');
        // pic
        $borderColors = [
            "rgba(255, 99, 132, 1.0)",
            "rgba(22,160,133, 1.0)",
            "rgba(255, 205, 86, 1.0)",
            "rgba(51,105,232, 1.0)",
            "rgba(244,67,54, 1.0)",
            "rgba(34,198,246, 1.0)",
            "rgba(153, 102, 255, 1.0)",
            "rgba(255, 159, 64, 1.0)",
            "rgba(233,30,99, 1.0)",
            "rgba(205,220,57, 1.0)"
        ];
        $fillColors = [
            "rgba(255, 99, 132, 0.2)",
            "rgba(22,160,133, 0.2)",
            "rgba(255, 205, 86, 0.2)",
            "rgba(51,105,232, 0.2)",
            "rgba(244,67,54, 0.2)",
            "rgba(34,198,246, 0.2)",
            "rgba(153, 102, 255, 0.2)",
            "rgba(255, 159, 64, 0.2)",
            "rgba(233,30,99, 0.2)",
            "rgba(205,220,57, 0.2)"

        ];
        $ProductsChart_pie = new ProductsChart;
        $ProductsChart_pie->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July','August','Septemper','October','November','December']);
        $ProductsChart_pie->dataset('Products','pie',$numberOfProudcts)->
           backgroundColor($fillColors)->color($fillColors);
        //    backgroundColor('rgba(22,160,133, 1.0)')->color('rgba(22,160,133, 1.0)');
        

        return view('home',compact('ProductsChart_bar','ProductsChart_pie'));

    }
    
}
