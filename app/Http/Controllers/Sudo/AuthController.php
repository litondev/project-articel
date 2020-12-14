<?php

namespace App\Http\Controllers\Sudo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
	User
};
use Auth;

class AuthController extends Controller
{
    public function signin(){
    	return view("sudo/signin");
    }

    public function actionSignin(Request $request){
    	$validator = \Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ],[
            'email.required' => 'Email harus diisi',
            'email.email'  => 'Format email tidak sesuai',
            'password.required'  => 'Password harus diisi',
            'password.min'  => 'Password harus :min karakter',
        ]);

        if ($validator->fails()) {
        	return redirect()
            ->back()
            ->withInput()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => $validator->errors()->first()
                ]
            ]);
        }
    
        if(!User::where("email",$request->email)->first()){
       		return redirect()
            ->back()
            ->withInput()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Email tidak ditemukan"
                ]
            ]);
        }
        
        $credentials = $request->only("email","password");

        if(Auth::attempt($credentials)){  
        	return redirect("/sudo/home")
               ->with([
                   "success" => [
                       "title" => "Berhasil",
                       "text" => "Berhasil masuk"
                   ]
            ]);;        
        }

        return redirect()
        ->back()
        ->withInput()
        ->with([
            "error" => [
                "title" => "Terjadi Kesalahan",
                "text" => "Password salah"
            ]
        ]);
    }

    public function logout(){
        Auth::logout();

        return redirect("sudo")->with([
            "success" => [
                "title" => "Berhasil",
                "text" => "Berhasil Keluar"
            ]
        ]);
    }
}
