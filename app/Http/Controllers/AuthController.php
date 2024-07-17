<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function checkAuth()
    {
        if (!Auth::check()) {
            return false;
        }
        return true;
    }

    public function index()
    {
        if ($this->checkAuth()) {
            return redirect()->route('home');
        }
        return view('pages.login');
    }

    public function register()
    {
        if ($this->checkAuth()) {
            return redirect()->route('home');
        }
        return view('pages.register');
    }

    public function registerProcess(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'username' => 'required|unique:users,username|exists:wargas,no_ktp',
            'password' => 'required|max:32|min:6',
            'email' => 'required|email|unique:users,email',
        ], [
            'username.exists' => 'Data NIK tidak ada, silahkan hubungi petugas'
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->name = Warga::where('no_ktp', $request->username)->get()[0]->nama_lengkap;
        $user->email = $request->email;
        // $user->name = $request->name;
        // $user->level = 'member';
        $user->password = bcrypt($request->password);
        $user->status = 1;
        $user->level = 'warga';
        $user->save();

        $request->session()->flash('success', $request->username . ' berhasil dibuat');
        return redirect()->route('login')->with('success', 'Berhasil membuat akun silahkan login');
    }



    public function login(Request $request)
    {
        // dd($request->all());
        request()->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ]
        );

        $kredensil = $request->only(['username', 'password']);

        if (Auth::attempt($kredensil)) {
            $user = Auth::user();

            // if ($user->status == 1 && $user->status == 2) {
            if ($user->status != 1) {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Akses anda diblokir');
            }

            if ($user->level === 'warga') {
                return redirect('surat-saya');
            } else {
                return redirect()->intended('home');
            }
        }

        return redirect()->route('login')->with('error', 'Username atau password anda salah');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda berhasil Logout');
    }
}
