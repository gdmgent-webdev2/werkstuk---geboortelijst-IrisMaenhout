<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Babylist;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Admin\StoreImg;

class CreateBabylist extends Controller
{
    public function show()
    {
        return view('home', [
            "babylists" => Babylist::all(),
        ]);
    }


    public function ShowForm()
    {
        if(isset($_POST['babylist_id'])){

            $babylist_id = $_POST['babylist_id'];
            $babylist = Babylist::where('id', '=', $babylist_id)->first();

            return view('create_babylist', [
                "babylist" => $babylist,
            ]);
        }else{
            return view('create_babylist', [
                "babylist" => null,
            ]);
        }

    }

    public function store()
    {
        // Validate the request...
        $user = auth()->user();
        $first_name_child = $_POST['first-name-child'];
        $last_name_child = $_POST['last-name-child'];
        $password = $_POST['password'];
        $password_confirmation = $_POST['password_confirmation'];

        // Save img and get path
        if ($_FILES['baby_upload']['tmp_name'] !== "") {
            $saved_img = StoreImg::storeBabyImg($_FILES['baby_upload']['tmp_name']);
            $path_saved_img = session('full_path');
        }else{
            $path_saved_img = 'babylist/img/default/default.jpg';
        }

        $message = $_POST['message'];


        if($password === $password_confirmation){
            $babylist = new Babylist();
            $babylist->user_id = $user->id;
            $babylist->first_name_child = $first_name_child;
            $babylist->last_name_child = $last_name_child;
            $babylist->password = Hash::make($password);
            $babylist->picture = $path_saved_img;
            $babylist->message = $message;
            $babylist->closed = False;
            $babylist->save();
            return redirect()->route('home');
        }else{
            return back()->withInput();
        }
    }


    public function update()
    {
        $babylist = Babylist::find(1);

        $first_name_child = $_POST['first-name-child'];
        $last_name_child = $_POST['last-name-child'];
        $password = $_POST['password'];
        $password_confirmation = $_POST['password_confirmation'];
        // save img
        if ($_FILES['baby_upload']['tmp_name'] !== "") {
            $saved_img = StoreImg::storeBabyImg($_FILES['baby_upload']['tmp_name']);
            $path_saved_img = session('full_path');
        }

        $message = $_POST['message'];

        if($password === $password_confirmation){
            $babylist->first_name_child = $first_name_child;
            $babylist->last_name_child = $last_name_child;
            $babylist->password = $password;
            if ($_FILES['baby_upload']['tmp_name'] !== "") {
                $babylist->picture = $path_saved_img;
            }
            $babylist->message = $message;
            $babylist->closed = False;
            $babylist->save();
            return redirect()->route('home');
        }else{
            return back()->withInput();
        }
    }
}
