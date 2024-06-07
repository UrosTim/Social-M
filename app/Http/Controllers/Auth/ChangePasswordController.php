<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function showChangePasswordForm()
    {
        return view('auth.change-password');
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'current_password' => ['required'],
            'password' => ['required'],
            'password_confirmation' => ['required', 'same:password'],
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->getAuthPassword())) {
            return back()->withErrors([
                'current_password' => 'Your current password does not matches with the password you provided.',
            ]);
        }
        $user->setPasswordAttribute($request->password);
        $user->save();

        return redirect()->route('home')
            ->with('success', 'Your password has been changed successfully.');
    }
}
