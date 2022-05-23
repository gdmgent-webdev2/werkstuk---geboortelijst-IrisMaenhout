<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function Show($name)
    {
        $url = '/babylist-' . $name;

        return view('password-babylist', [
            "babylist_url" => $url
        ]);
    }
}
