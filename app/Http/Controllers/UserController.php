<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use App\Category;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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

    public function My_Account()
    {
        $User = \Auth::user();
        return view('Users.My_Account.index',compact('User'));
    }

    public function index()
    {
        $this->authorize('view', User::class);
        $Users = User::select('id','name','email','isAdmin')->get();
        $UserCategories=auth()->user()->OwnerCategories;
        return view('Users.index',compact('Users','UserCategories'));
       
    }

    public function MyCategories()
    {
         $User = \Auth::user();
         $WorkingCateories = $User->categoriesWork;
         $OwnerCategories = $User->OwnerCategories;
        //   OwnerCategories hasMany 
        if (Gate::allows('viewAny',Category::class)) {
             $categories = Category::all();
             return view('Users.Owner_Categories.index',compact('categories','WorkingCateories','OwnerCategories'));
        } 
        
         return view('Users.Owner_Categories.index',compact('WorkingCateories','OwnerCategories'));
    }

    public function makeItAdmin(User $User ,Request $request)
    {
       $data = $request->validate([
            'isAdmin' => 'required'
        ]);
  
        if($data['isAdmin'] == 'on'){
            
            $User->isAdmin =1;
            $User->save();
            return redirect()->back();

            //  $isAdmin = ['isAdmin' => $data['isAdmin'] == 1 ];
            //  $value = $User->update($isAdmin);
            
            //  if($value){
            //     return redirect()->back();
            //    }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('Users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //dd($request->all());
       $data = $request->validate([
           'name' =>'required|max:30|min:2',
           'email' =>'required|email|unique:Users',
           'password'=>'required|min:8|max:15|String',
       ]);

       if($request->has('isAdmin')){
         $request['isAdmin'] = 1;
         $request['password'] =  Hash::make($request->password);
         $User = new User;
         if($User->create($request->all())){
            return redirect()->back();
         }  
       }

       $request['password'] =  Hash::make($request->password);
       $User = new User;
         if($User->create($request->all())){
            return redirect()->back();
         }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $User)
    {
       $WorkingCateories = $User->categoriesWork; //working 
       $OwnerCategories = $User->OwnerCategories;// Owner
       return view('Users.show',compact('User'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit(User $User)
    // {
       
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // updata my account
    public function update(Request $request, User $User) 
    {
       if($request->has('name')){

        $data = $request->validate([
            'name' => 'required|string|max:200'
        ]);
  
        if($User->update($data)){
           return redirect()->back();
        }
    }

    if($request->has('email')){

        $data = $request->validate([
            'email' => 'required|email|unique:Users',
        ]);

        if($User->update($data)){
            return redirect()->back();
         }
    }

    if($request->has('old-password')){

        $User =\Auth::user();
        if(Hash::check($request['old-password'],$User->password)){
            $data = $request->validate([
                'old-password' => 'required',
                'new-password'=>'required|max:15|min:8',
                'confirm-password'=>'required|max:15|min:8'
            ]);

           
               $password  =  [ 'password' => Hash::make($request['new-password'])];

            if($User->update($password)){
                return redirect()->back(); 
            }

        }
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User)
    {
        $this->authorize('delete', User::class);
        if($User->delete()){
            return redirect()->back(); 
        }
    }


}
