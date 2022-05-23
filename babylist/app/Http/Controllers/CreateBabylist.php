<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Babylist;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class CreateBabylist extends Controller
{
    public function show()
    {
        return view('home', [
            "babylists" => Babylist::all(),
        ]);
    }

    public function store()
    {
        // Validate the request...

        $user = auth()->user();
        $first_name_child = $_POST['first-name-child'];
        $last_name_child = $_POST['last-name-child'];
        $password = $_POST['password'];
        $password_confirmation = $_POST['password_confirmation'];
        // Afbeelding nog opslaan
        $img = (isset($_POST['baby_upload'])) ? $_POST['baby_upload'] : '';
        $message = $_POST['message'];

        if($password === $password_confirmation){
            $babylist = new Babylist();
            $babylist->user_id = $user->id;
            // $babylist->product_id = [];
            $babylist->first_name_child = $first_name_child;
            $babylist->last_name_child = $last_name_child;
            $babylist->password = Hash::make($password);
            $babylist->picture = $img;
            $babylist->message = $message;
            $babylist->closed = False;
            $babylist->save();
            return redirect()->route('home');
        }else{
            return back()->withInput();
        }
    }
}
