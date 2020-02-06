<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ShowProductsByCategory(Request $request)
    {
        //dd($request->all());
        $Category_id = array_values($request->all());
        $Products = Category::find($Category_id[0])->products;
        return \view('Products.ProductsByCategory', \compact('Products'));
    }

    public function index()
    {

        $category = Category::pluck('name', 'id');

        return \view('Products.index', \compact('category'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::pluck('name', 'id');
        $category_id = Category::select('id')->get(); //this is for select category
        return \view('Products.create', \compact('category', 'category_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->file());
        // dd($request->category_name);
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|max:1999',
            'priec' => 'required',
            'category_id' => 'required'
        ]);

        // get file name with ext
        $fileNameWithExt = $request->file('image')->getClientOriginalName();
        //get just file name
        $fileName = \pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        // get ext file
        $fileExt = \pathinfo($fileNameWithExt, PATHINFO_EXTENSION);
        // set full path
        $fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;
        // store in dir images
        $request->file('image')->storeAs('Images', $fileNameToStore, 'public');
        // store file with aother data
        $request['imege'] = $fileNameToStore;
        $request['user_id'] = Auth::user()->id;
        $product = new Product;
        $product->create($request->all());
        return \redirect(\route('Products.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

        return \view('Product.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $Product)
    {
        $category = Category::pluck('name', 'id');
        return \view('Products.edit', \compact('Product', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $Product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|max:1999',
            'priec' => 'required',
            'category_id' => 'required'
        ]);
        if ($request->hasFile('image')) {
            // get file name with ext
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            //get just file name
            $fileName = \pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // get ext file
            $fileExt = \pathinfo($fileNameWithExt, PATHINFO_EXTENSION);
            // set full path
            $fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;
            // store in dir images
            $request->file('image')->storeAs('Images', $fileNameToStore, 'public');

            $request['imege'] = $fileNameToStore;
            $request['user_id'] = Auth::user()->id;
            // dd($request->all());
            $Product->update($request->all());
        } else {
            $request['user_id'] = Auth::user()->id;
            $Product->update($request->all());
        }


        return \redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $Product)
    {

        $Product->delete();
        return \redirect()->back();
    }
}
