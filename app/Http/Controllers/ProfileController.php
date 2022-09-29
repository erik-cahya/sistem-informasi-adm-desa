<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Hash;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $data = [
            'title' => "Profile pengguna",
            'userLogin' => User::where(['username' => auth()->user()->username])->first()
        ];

        return view('pages.profile', $data);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'username' => [
                'required',
                'max:64','min:2',
                Rule::unique('users', 'username')->ignore($request->id),
            ],
            'email' => 'required|email|max:64|min:2',
        ]);

        $user = Auth::user();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        return response()->json([
            'data' => [
                'username' => $request->username,
                'email' => $request->email
            ],
            'message'=>'Profile berhasil diperbarui'
        ]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_sekarang' => 'required|max:200|min:2',
            'password_baru' => 'max:200|min:2|required_with:ulang_password_baru|same:ulang_password_baru',
            'ulang_password_baru' => 'max:200|min:2',
        ]);

        if (!(Hash::check($request->password_sekarang, Auth::user()->password))) {
            // The passwords matches
            return response()->json(['message'=>'Password saat ini salah'],422);
        }
        

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->password_baru);
        $user->save();

        return response()->json([
            'message'=>'Password berhasil diperbarui'
        ]);
    }
}
