<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DirectorController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    //edit Director
    public function editDirector($directorId)
    {
        
    }
}
