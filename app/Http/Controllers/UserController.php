<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\Http\Requests\UserRequest;

use App\Http\Requests\UserUpdateRequest;

use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('trabajador')
                      ->where('estado','1')
                      ->get();

        return $users;
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $users = User::all();

        foreach ($users as $user) {

            if($user['id_trabajador'] == $request->user['trabajador'] && $request->user['trabajador'] > 0){
                return 0;
            }
        }

        $user = new User;
        $user->name =  $request->user['nombre'];
        $user->email= $request->user['email'];
        $user->password = Hash::make($request->user['password']);
        $user->isAdmin =  $request->user['admin'];
        $user->id_trabajador= $request->user['trabajador'];
        $user->save();

        return;
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        
        if($request->delete['delete'] == 1){
            $product = User::find($id);
            $product->estado = 0;
            $product->save();

            }else{

            $user = User::find($id);
            $user->name = $request->user['nombre'];
            $user->email= $request->user['email'];
            $user->isAdmin =  $request->user['admin'];
            $user->id_trabajador= $request->user['trabajador'];
            $user->save();
            
            }

        return;

    }

    public function newpass(Request $request,$id){

            $user = User::find($id);
            $pass = $request->password;

            if (Hash::check( $pass , $user->password)) {

                return 0;
            
            }

            $user2 = User::find($id);

            $user2->password = Hash::make($pass);
            $user2->save();

            return "";

            
            

    }

   
}
