<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\User;
use Illuminate\Support\Facades\Gate;
use App\Notifications\UserAddItCategory;
use Illuminate\Database\Eloquent\Collection;
class CategoryController extends Controller
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
    public function index()
    {   //to show all the categories
        $Categories =  Category::pluck('name');
        return \view('Categories.index',\compact('Categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        // show form of the create category
        return \view('Categories.create');
    }

    public function AddUserTOTheCategory(Request $request)
    {
       $data = $request->validate([
           'email' => 'required|email|exists:App\User,email',
           'Category_id' => 'required'
          
       ]);
        
        if($data){
            $User =User::where('email',$data['email'])->first();//get the user
            if(is_array($data['Category_id'])){  
              foreach ($data['Category_id'] as $value) {
                  $result = $User->categoriesWork()->find($value);
                if(!$result){
                    $User->categoriesWork()->attach($value);
                }// end if
            } // end for 
              $User->notify(new UserAddItCategory());
              return \redirect()->back();
            }
         }
         return \redirect()->back();
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // to store category in the dataace 
        $categoryData =$request->validate([
            'name'=>'required|unique:categories',
        ]);
        $User = \Auth::user();
        $request['user_id'] = $User->id;
        $Category = new Category;
        $CategoryId = $Category->create($request->all());
        $User->categoriesWork()->attach($CategoryId->id);
        return \redirect(\route('Categories.index'));
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
    public function edit(Request $request, Category $Category)
    {
        $this->authorize('update', $Category);
        return view('Categories.edit',compact('Category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $Category)
    {
        $this->authorize('update', $Category);
       $data= $request->validate([
            'name'=>'required|unique:categories',
        ]);

        if($Category->update($data)){
            return \redirect()->back();
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $Category)
    {
        $this->authorize('delete', $Category);
        if($Category->delete()){
            return \redirect()->back();
        }
    }
}
