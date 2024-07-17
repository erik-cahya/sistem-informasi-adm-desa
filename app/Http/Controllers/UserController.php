<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Datatables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->users = new User();
    }

    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(User::select('*'))
                ->addIndexColumn()
                ->make(true);
        }
        $data = [
            'title' => "Akun Pengguna"
        ];

        return view('pages.users', $data);
    }

    public function add()
    {
        return view('pages.user_add');
    }

    public function create(Request $request)
    {
        $request->validate([
            'username' => 'required|max:32|min:3|alpha_dash|unique:users,username|exists:wargas,no_ktp',
            'name' => 'required|max:32|min:3',
            'password' => 'required|max:32|min:3',
            'email' => 'required|email|unique:users,email',
            'status' => 'required'
        ], [
            'username.exists' => 'Data NIK tidak ada, silahkan hubungi petugas'
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->status = ($request->status == 1) ? 1  : 0;
        $user->level = 'warga';
        $user->save();

        return response()->json(['message' => 'Data berhasil di simpan.']);
    }

    public function show($id)
    {
        $data = User::find($id);

        return response()->json($data);
    }

    public function edit($id)
    {
        $data = [
            'user' => $this->users->where(['id' => decrypt($id)])->first(),
            'from' => 'users'
        ];
        return view('pages.user_edit', $data);
    }

    public function update(Request $request)
    {
        $user = $this->users->find($request->id);

        $request->validate([
            'username' => 'required|max:32|exists:wargas,no_ktp',
            'email' => 'required|email',
            'status' => 'required'
        ], [
            'username.exists' => 'Data NIK tidak ada, silahkan hubungi petugas'
        ]);

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'status' => ($request->status == 1) ? 1  : 0
        ]);

        return response()->json(['message' => 'Data berhasil diperbarui']);
    }

    public function delete($id)
    {
        $user = $this->users->find($id);

        $user->forceDelete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }

    public function profile()
    {
        $data = [
            'user' => Auth::user(),
            'from' => 'profile'
        ];
        return view('pages.user_edit', $data);
    }

    public function changePassword(Request $request)
    {

        $user = $this->users->find($request->id);

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|same:confirm_password|min:3',
            'confirm_password' => 'required',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            $request->session()->flash('error', 'password not match');
            return redirect()->route('profile.change.password');
        }

        $user->password = Hash::make($request->new_password);

        $user->save();

        $request->session()->flash('success', 'password berhasil di ganti');
        return redirect()->route('profile.change.password');
    }
}
