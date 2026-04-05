<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return response()->json([
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = $request->type;
        $user->bio = $request->bio;
        $user->password = Hash::make($request->password);
        $user->save();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = $request->type;
        $user->bio = $request->bio;
        if ($request->password == '') {
            $user->password = $request->password;
        } else {
            $user->password = Hash::make($request->password);
        }

        $user->save();
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
    }
}
