<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.users',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::allows('isAdmin')){
            return view('admin.users.create-user');
        }else{
            abort('401',"Unauthorized");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::allows('isAdmin')){
            $request->validate([
                'name' => 'required|alpha_dash|unique:users,name|min:3|max:50',
                'email' => 'required|unique:users,email',
                'password' => ['required',Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
                'confirm_password' => 'required|same:password',
                'role' => 'required|unique:users,role',
    
            ],[
                'name.required' => 'Username is required',
                'name.alpha_dash' => 'Username is not allow space',
                'name.unique' => 'Username have already exit',
                'name.min' => 'Username must be minimum 3 characters',
                'name.max' => 'Username must be maximum 50 characters',
                'email.required' => 'Email is required',
                'email.unique' => 'Email have already exit',
                'password.required_with' => 'Password is required',
                'password.min' => 'Password must be at least 8 characters',
                'confirm_password.required' => 'Confirm Password is required',
                'confirm_password.same' => 'Confirm Password does not match password',
                'role.required' => 'Role is required',
                'role.unique' => 'Role have already exit',
            ]);
    
            $update_password = Hash::make($request->password);
            $update_role = Str::lower($request->role);
            User::create([
                'name' => $request->name ,
                'email' => $request->email,
                'password' => $update_password,
                'role'=> $update_role,
                'status'=> 1,
            ]);
            return redirect()->route('users.index')->with('success','User is successfully added');
        }else{
            abort('401','Unauthorized');
        }
       
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
    public function edit(User $user)
    {
        if(Gate::allows('isAdmin')){
            return view('admin.users.edit-user',['user'=> $user]);
        }
        else{
            abort('401',"Unauthorized");
        }
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
        if(Gate::allows('isAdmin')){
                $update_status = intval($request->status);
                $update_role = Str::lower($request->role);
                $user = User::findOrFail($id);
                if($user->name !== $request->name){
                    $request->validate([
                            'name' => 'required|alpha_dash|unique:users,name|min:3|max:50',
                        ],[
                            'name.required' => 'Username is required',
                            'name.alpha_dash' => 'Username is not allow space',
                            'name.unique' => 'Username have already exit',
                            'name.min' => 'Username must be minimum 3 characters',
                            'name.max' => 'Username must be maximum 50 characters',
                        ]);
                }
                if($user->email !== $request->email){
                   $request->validate([
                            'email' => 'required|email|unique:users,email',    
                        ],[
                            'email.required' => 'Email is required',
                            'email.email' => 'Email is not email type',
                            'email.unique' => 'Email have already exit',
                        ]);
                }
                if($user->role !== $update_role){
                    $request->validate([
                        'role' => 'required|unique:users,role',
                    ],[
                        'role.required' => 'Role is required',
                        'role.unique' => 'Role have already exit',
                    ]);
                }
                if($user->name !== $request->name || $user->email !== $request->email 
                    || $user->role !== $update_role || $user->status !== $update_status){
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->role = $update_role;
                    $user->status = $update_status;
                    $user->save();
                    return redirect()->route('users.index')->with('success','User is successfully updated');
                }else{
                    return redirect()->route('users.index')->with('success',"You don't change any data.");
                }
            
        }else{
            abort('401',"Unauthorized");
        }
       
    }

    public function resetPassword(Request $request, $id){
        if(Gate::allows('isAdmin')){
            $user = User::findOrFail($id);
            return view('admin.users.reset-password',['user' => $user]);
        }else{
            abort('401',"Unauthorized");
        }
    }
    public function changePassword(Request $request, $id){
        if(Gate::allows('isAdmin')){
            $request->validate([
                'password' => ['required',Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
                'confirm_password' => 'required|same:password',
            ],[
                'password.required' => 'Password is required',
                'password.min' => 'Password must be at least 8 characters',
                'confirm_password.required' => 'Confirm Password is required',
                'confirm_password.same' => 'Confirm Password does not match password',
            ]);

            $update_password = Hash::make($request->password);
            $user = User::findOrFail($id);
            $user->password = $update_password;
            $user->save();
            return redirect()->route('users.index')->with('success',$user->email."'s password is successfully changed.");
        }else{
            abort('401',"Unauthorized");
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::allows('isAdmin')){
            $user = User::find($id);
            try{
                $user->delete();
            }
            catch(QueryException $e){
                return redirect()->route('users.index')->with(["unsuccess"=>"user can't be deleted ."]);
            }
            return redirect()->route('users.index')->with(["success"=>"user is successfully deleted."]);
        }else{
            abort('401','Unauthorized');
        }
        
    }
}
