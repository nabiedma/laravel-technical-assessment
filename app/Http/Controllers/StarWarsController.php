<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StarWarsController extends Controller
{
    public function index()
    {
        return view('sw.index');
    }
}
