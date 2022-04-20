<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserApiController extends Controller
{
    public function ShowUser($id = null)
    {

        if ($id == '') {
            $user = User::get();
            return response()->json(['users' => $user], 200);
        } else {
            $user = User::find($id);
            return response()->json(['users' => $user], 200);
        }
    }
    public function AddUser(Request $request)
    {


        if ($request->isMethod('post')) {
            $data = $request->all();
            
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ];
    
        $customMessages = [
            'name.required' => 'Name field is required.',
            'email.email' => 'Email field is required.',
            'password.required' => ' Password  field is required.'
        ];
    
        $validator=Validator::make($data, $rules, $customMessages);
            if($validator->fails()){
                return response()->json($validator->errors(),422);
            }

            $user = new User;
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();
            $message = 'user successfully Added';
            return response()->json(['message' => $message], 201);
        }
    }
}
