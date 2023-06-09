<?php

namespace App\Controllers;

class HomePageController extends BaseController
{
    public function index()
    {
        return view('home_page');
    }
}
