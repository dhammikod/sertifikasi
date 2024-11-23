<?php

namespace App\Http\Controllers;
use App\Models\Author;

class Controller
{
    public function home(){
        return view('welcome', [
            'msg' => "",
            'titlepage' => "Home page"
        ]);
    }
}
