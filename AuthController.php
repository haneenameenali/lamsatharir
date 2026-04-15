<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; // 👈 هذا السطر مهم

class AuthController extends Controller
{
    public function showlogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // جلب المستخدم حسب البريد
        $user = User::where('email', $request->email)->first();

        // التحقق بدون تشفير
        if ($user && $user->password === $request->password) {

            // تسجيل الدخول
            auth()->login($user);

            return redirect('/admin/products');
        }

        return back()->withErrors(['error' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة ياجوجو']);
    }
}