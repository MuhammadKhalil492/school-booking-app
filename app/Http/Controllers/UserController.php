<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function create()
    {
        return view('user-create');
    }
    public function store(Request $request)
    {
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'integer|exists:roles,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create a new user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        // dd($user);ss
        dump($request->roles);
        // Assign roles to the user
        $user->syncRoles($request->roles); // Use assignRole instead of syncRoles
        // Debugging output
        //dd($user->roles); // Check if roles are assigned correctly

        // Redirect to users list with success message
        // return redirect()->route('users.index')->with('success', 'User  created successfully!');
    }
}
