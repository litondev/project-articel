<?php

namespace App\Http\Controllers\Sudo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
	User
};

class HomeController extends Controller
{
    public function index(){
    	return view("sudo/home");
    }
}
