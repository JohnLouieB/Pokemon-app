<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $user = User::select('id', 'first_name', 'last_name', 'email')
            ->orderBy('id', 'desc')
            ->get();
        return $user;
    }
    public function update(Request $request) {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'string', 'date', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
        $user =Auth::user();
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->date_of_birth = $request['date_of_birth'];
        $user->email = $request['email'];
        $user->save();
        return back()->with('message','Profile Updated');
    }

    public function getUser(Request $request) {
        $id = $request->user();
        dd($id);
        $user = User::findorFail($id);  
        return response()->json([data=>$user]);
    }
}
