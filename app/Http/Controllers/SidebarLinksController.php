<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SidebarLinksController extends Controller
{

    // public function goldEco()
    // {

    //     return view('layouts.gold-eco');
    // }
    // public function books()
    // {

    //     return view('layouts.book');
    // }
    public function moneyEco()
    {

        return view('layouts.money');
    }
    public function codeHome()
    {

        return view('layouts.code');
    }
    public function criptoEco()
    {

        return view('layouts.crypto');
    }
    public function landEco()
    {

        return view('layouts.land');
    }
}
