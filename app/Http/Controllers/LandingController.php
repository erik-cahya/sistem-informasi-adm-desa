<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Kategori;
use App\Models\Keluarga;
use App\Models\Announce;
use Illuminate\Support\Facades\Auth;
use Session;

class LandingController extends Controller
{
    public function index()
    {

        return view('landing.index', [
            'active' => 'index',
            'newses' => Berita::latest()
                ->take(3)
                ->get(),
            'total' => Keluarga::get()->count()
        ]);

        return view('landing.index', [
            'active' => 'index',
            'newses' => Announce::latest()
                ->take(3)
                ->get()
        ]);

    }
    public function about()
    {
        return view('landing.about', [
            'active' => 'index',
        ]);
    }
    public function visimisi()
    {
        return view('landing.visimisi', [
            'active' => 'index',
        ]);
    }
    public function sejarahdesa()
    {
        return view('landing.sejarahdesa', [
            'active' => 'index',
        ]);
    }
    public function geografidesa()
    {
        return view('landing.geografidesa', [
            'active' => 'index',
        ]);
    }
    public function demografidesa()
    {
        return view('landing.demografidesa', [
            'active' => 'index',
            'total' => Keluarga::get()->count()
        ]);
    }
    public function strukturdesa()
    {
        return view('landing.strukturdesa', [
            'active' => 'index',
        ]);
    }
    public function pemerintahandesa()
    {
        return view('landing.pemerintahandesa', [
            'active' => 'index',
        ]);
    }
    public function lembagadesa()
    {
        return view('landing.lembagadesa', [
            'active' => 'index',
        ]);
    }
    public function karangtaruna()
    {
        return view('landing.karangtaruna', [
            'active' => 'index',
        ]);
    }
    public function beritadesa()
    {
        return view('landing.beritadesa', [
            'active' => 'index',
            'newses' => Berita::orderBy('created_at', 'desc')
                ->paginate(10)
                ->withQueryString(),
            'categories' => Kategori::get(),
        ]);
    }
    public function beritadesa_cat($category)
    {
        $datakategori = Kategori::find($category);

        return view('landing.beritadesacat', [
            'active' => 'index',
            'newses' => Berita::select('beritas.*','kategoris.nama')
                ->join('kategoris', 'beritas.kategori', '=', 'kategoris.id')
                ->where('kategori', $category)
                ->orderBy('created_at', 'desc')
                ->paginate(10)
                ->withQueryString(),
            'categories' => Kategori::get(),
            'cat' => $datakategori,
        ]);
    }
    public function pengumumandepan()
    {
        return view('landing.pengumuman', [
            'active' => 'index',
            'announces' => Announce::orderBy('created_at', 'desc')
                ->paginate(15)
                ->withQueryString(),
        ]);
    }
    public function unduhan()
    {
        return view('landing.unduhan', [
            'active' => 'index',
        ]);
    }
    public function produkhukum()
    {
        return view('landing.produkhukum', [
            'active' => 'index',
        ]);
    }
    public function apbdes()
    {
        return view('landing.apbdes', [
            'active' => 'index',
        ]);
    }
    public function beritadesa_detail($id)
    {
        return view('landing.beritadesadetail', [
            'news' => Berita::find($id),
            'active' => 'news',
            'categories' => Kategori::get(),
        ]);
    }
    public function pengumuman_detail(Announce $announce)
    {
        return view('landing.pengumumandetail', [
            'active' => 'index',
            'announce' => $announce,
        ]);
    }
    public function login()
    {
        return view('landing.login', [
            'active' => 'login',
        ]);
    }
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()
                ->intended('/dashboard')
                ->with('success', 'Selamat Datang di Dashboard Sistem Informasi Desa Rantau Puri!');
        }
        return back()->with('loginError', 'E-mail/Password Anda Salah, Coba Lagi!');
    }
}
