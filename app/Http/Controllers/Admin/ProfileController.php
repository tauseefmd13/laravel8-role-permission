<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.auth.profile');
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name'=>'required',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users','email')->ignore($user)
            ],
            'status' => 'required|in:1,0',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = $request->status;
        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }
}
