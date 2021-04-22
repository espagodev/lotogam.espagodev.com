<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * return welcome page
     * @return \Illuminate\Http\Response
     */
    public function showWelcomePage()
    {

        return view('welcome');
    }
}
