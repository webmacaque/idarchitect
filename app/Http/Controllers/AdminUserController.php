<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function users()
    {
        $users = User::orderBy('id')->get();

        return view('admin.users')
            ->with('users', $users);
    }

    public function editForm($id)
    {
        $user = User::find($id);

        return view('admin.user-edit')
            ->with('user', $user);
    }

    public function createForm()
    {
        return view('admin.user-create');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'login' => 'required',
            'password' => 'nullable'
        ]);

        $user = User::find($id);
        $user->login = $request->login;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin-users');
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
           'login' => 'required|unique:users',
           'password' => 'required'
        ]);

        $user = new User();
        $user->login = $request->login;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin-users');
    }

    public function delete(Request $request)
    {
        $user = User::find($request->user_id);
        $user?->delete();

        return redirect()->route('admin-users');
    }
}
