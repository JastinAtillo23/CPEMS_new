<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        // Optional: Log activity when user logs in
        \App\Models\ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'login',
            'details' => 'User logged in from ' . $request->ip(),
            'status' => 'success'
        ]);
    }
}