<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('user.pages.index');
    }
    public function Faq()
    {
        return view('user.pages.faq');
    }
}
