<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
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
    public function index()
    {
        // $user = User::find(3)->roles;

        // dd($user);
        // $users= User::has('roles')->get();
        // dd($users);
        //$usersData =$users->select('id','name','email')->get();

        //  $usersRoles=$users->roles->all();
        //  dd($usersRoles);
        if (Gate::allows('full-primission', Auth::user())) {
            // The current user can edit settings
            $users = User::with('roles')->get();
            
           // $UserRoles = $User->roles->pluck('id')->toArray();
            $rolesPrimissions= Role::select('id','primissions')->get()->toArray();
            return \view('Users.index', \compact('users','rolesPrimissions'));
        }
        return \abort(401);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('full-primission', Auth::user())) {
            // The current user can edit settings
            //$users = User::with('roles')->get(); 

            return \view('Users.create');
        }
        return abort(401);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::allows('full-primission', Auth::user())) {
            // The current user can edit settings
            //$users = User::with('roles')->get();


            if ($request['isAdmin']) {
                $request['isAdmin'] = 1;
                $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:8',
                    'role_name' => 'required|string|max:255',
                    'primissions' => 'required|string|max:255',
                    'isAdmin' => 'required|boolean',
                ]);

                //hash password
                $request['password'] = Hash::make($request['password']);


                $user = new User;
                $role = new Role;
                $userDate = $user->create($request->only('name', 'email', 'password'));
                $roleDate = $role->create($request->only('role_name', 'primissions'));
                $userDate->roles()->attach($roleDate->id); //get the last id when create user
                return \redirect(\route('Users.index'));
            }
        }
        return abort(401);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $User)
    {
        if (Gate::allows('full-primission', Auth::user())) {
            // The current user can edit settings
            // $users = User::with('roles')->get();
            return \view('Users.show', \compact('User'));
        }
        return abort(401);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $User)
    {
        if (Gate::allows('full-primission', Auth::user())) {
            // The current user can edit settings
            //$users = User::with('roles')->get();
            $UserRoles = $User->roles->pluck('id')->toArray();
            $roles= Role::select('id','primissions')->get();
            
            return \view('Users.edit', \compact('User', 'UserRoles','roles'));
        } 
        return abort(401);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $User)
    {
        if (Gate::allows('full-primission', Auth::user())) {
            // The current user can edit settings
            //$users = User::with('roles')->get();
            //dd($request->all());
            if ($request->only('primissions')) {
                
                //dd($request->primissions);
                $User->roles()->sync($request['primissions']);
                return redirect()->back();
               // $User->roles()->update($request->only('primissions'));
            }
            if ($request->only('name', 'email')) {
                $User->update($request->all());
            }
            if ($request->only('current_password', 'new_password', 'Confirm_password')) {
                $request->validate([
                    'current_password' => 'required|string|max:255',
                    'new_password' => 'required|string|max:255|min:8|different:current_password',
                    'Confirm_password' => 'required|string|max:255|min:8',
                ]);
                $currentPassword = $User->password; //get password form databace
                
                if (Hash::check($request['current_password'], $currentPassword)) {
                    
                    $request['password'] = Hash::make($request['new_password']);
                   
                    $User->update($request->only('password'));
                } else {
                    return response(['message' => 'this password not in data bace']);
                }
            }
            return \redirect()->back();
        }
        return abort(401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User)
    {
        if (Gate::allows('full-primission', Auth::user())) {
            // The current user can edit settings
            //$users = User::with('roles')->get();
            $User->delete();
            return \redirect(\route('Users.index'));
        }
        return abort(401);
    }
}
