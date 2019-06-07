<?php

namespace App\Controllers;

class PagesController
{
    /**
     * Show the home page.
     */
    public function home()
    {
        session_start();
        $datos["userLogueado"] = $_SESSION['user'];
        return view('index.home',compact('datos'));
    }

    /**
     * Show the about page.
     */
    public function about()
    {
        $company = 'Laracasts';

        return view('about', ['company' => $company]);
    }
    public function login()
    {
        $company = 'Laracasts';

        return view('index');
    }
}
