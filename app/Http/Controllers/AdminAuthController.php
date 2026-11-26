<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $emailAdmin = env('ADMIN_EMAIL', 'admin@essenzacoffee.com');
        $passwordAdmin = env('ADMIN_PASSWORD', 'Essenza123');

        if (
            $request->email === $emailAdmin &&
            $request->password === $passwordAdmin
        ) {
            $request->session()->regenerate();

            session([
                'admin_logged_in' => true,
                'admin_email' => $emailAdmin,
            ]);

            return redirect('/admin/dashboard')
                ->with('success', 'Selamat datang di Admin Essenza Coffee!');
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password yang Anda masukkan salah.',
            ])
            ->withInput($request->only('email'));
    }

    public function dashboard()
    {
        if (!session('admin_logged_in')) {
            return redirect('/admin/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        return view('admin.dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'Anda berhasil logout.');
    }
}
