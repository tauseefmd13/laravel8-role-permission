<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function index()
    {
        return view('admin.auth.change_password');
    }

    public function update(Request $request)
    {
        $request->validate([
			'old_password' => 'required',
			'password' => 'required|confirmed',
			'password_confirmation' => 'required',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->old_password, $user->password)) 
        {
            return back()->with('error', 'Old password does not match.');
        }

        $user->password = $request->password;
        $user->save();

        return back()->with('success', 'Password changed successfully.');
    }
}
