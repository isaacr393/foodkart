<?php

namespace App\Http\Controllers;

use Auth;
use Inertia\Inertia;
use Illuminate\Http\Request;

class RegisterController extends Controller
{    
    //
    public function index(){
        
        return Inertia::render('register/register');
    }
}
