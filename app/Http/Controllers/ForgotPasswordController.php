<?php 
  
namespace App\Http\Controllers; 
  
use App\Http\Controllers\Controller;

use Illuminate\Http\Request; 
use DB; 
use Carbon\Carbon; 
use App\Models\User; 
use Mail; 
use Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
  
class ForgotPasswordController extends Controller
{
    public function showForgetPasswordForm()
    {
        $auth = new AuthController();
        if ($auth->checkAuth()) {
            return redirect()->route('home');
        }

        return view('pages.forgot-password');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        //cek user di database
        $data = User::where('email',$request->email)->first();

        if(!empty($data)){
            $token = Str::random(64);
            
            //encryt
            $emailCrypt = Crypt::encryptString($request->email);

            DB::table('password_resets')->insert([
                'email' => $request->email, 
                'token' => $token, 
                'created_at' => Carbon::now()
            ]);

            Mail::send('email.forgetPassword', ['token' => $token, 'email' => $emailCrypt, 'data' => $data], function($message) use($request){
                $message->to($request->email);
                $message->subject('Reset Password');
            });
        }

        return redirect()->route('login')->with('success', 'Kami sudah mengirimkan link, Silahkan cek email anda');
    }

    public function showResetPasswordForm($token, $emailCrypt) { 
        
        $auth = new AuthController();
        if ($auth->checkAuth()) {
            return redirect()->route('home');
        }

        $emailDecrypt =Crypt::decryptString($emailCrypt);
        return view('pages.reset-password', ['token' => $token, 'email' => $emailDecrypt]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'max:200|min:2|required_with:ulang_password_baru|same:ulang_password_baru',
            'ulang_password_baru' => 'required',
        ]);

        $updatePassword = DB::table('password_resets')
                            ->where([
                            'email' => $request->email, 
                            'token' => $request->token
                            ])
                            ->first();
    
        if(!$updatePassword){
            return back()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
                    ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect()->route('login')->with('success', 'Silahkan login dengan password baru anda');
    }
}