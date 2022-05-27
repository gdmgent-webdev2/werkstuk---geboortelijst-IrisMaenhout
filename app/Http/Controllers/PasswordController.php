<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function Show($name)
    {
        $url = '/babylist-' . $name;

        // $password = $_POST['password'];

        // dd($password);

        // session_start();

        // // Add values to the session.
        // $_SESSION['item_name'] = $password;

        return view('password-babylist', [
            "babylist_url" => $url
        ]);
    }
}
