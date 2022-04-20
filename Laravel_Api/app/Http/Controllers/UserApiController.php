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

            $validator = Validator::make($data, $rules, $customMessages);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
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

    public function AddMultipleUser(Request $request)
    {


        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'users.*.name' => 'required',
                'users.*.email' => 'required|email',
                'users.*.password' => 'required',
            ];

            $customMessages = [
                'users.*.name.required' => 'Name field is required.',
                'users.*.email.email' => 'Email field is required.',
                'users.*.password.required' => ' Password  field is required.'
            ];

            $validator = Validator::make($data, $rules, $customMessages);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            foreach ($data['users'] as $addUser) {
                $user = new User;
                $user->name = $addUser['name'];
                $user->email = $addUser['email'];
                $user->password = bcrypt($addUser['password']);
                $user->save();
                $message = 'user successfully Added';
                return response()->json(['message' => $message], 201);
            }
        }
    }


    public function UpdateUserDetails(Request $request, $id)
    {


        if ($request->isMethod('put')) {
            $data = $request->all();

            $rules = [
                'name' => 'required',
                'password' => 'required',
            ];

            $customMessages = [
                'name.required' => 'Name field is required.',
                'password.required' => ' Password  field is required.'
            ];

            $validator = Validator::make($data, $rules, $customMessages);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $user = User::find($id);
            $user->name = $data['name'];
            $user->password = bcrypt($data['password']);
            $user->save();
            $message = 'user successfully updated';
            return response()->json(['message' => $message], 202);
        }
    }
}
