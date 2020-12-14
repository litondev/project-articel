<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
	User,
	Articel
};

class HomeController extends Controller
{
    public function index(){
    	$user = User::where('is_active',true)->first();

    	$articel = Articel::orderBy('id','desc')->paginate(6);
        
    	return view("welcome",compact("user","articel"));
    }

    public function detail($id){    	
    	if(intval($id) < 0){
    		return redirect()->back();
    	}

    	$articel = Articel::where('id',$id)->first();

    	if(!$articel){
    		return redirect()->back();
    	}

    	return view("detail",compact("articel"));
    }
}
