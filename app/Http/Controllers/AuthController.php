<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Change 'focus2026' to whatever secure password you want for your admin panel
        if ($request->password === 'focus2026') {
            $request->session()->put('is_admin', true);
            return redirect('/admin');
        }

        return back()->withErrors(['password' => 'Password salah.']);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('is_admin');
        return redirect('/login');
    }
}