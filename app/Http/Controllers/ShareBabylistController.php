<?php

namespace App\Http\Controllers;

use App\Mail\shareBabylist;
use App\Models\Babylist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ShareBabylistController extends Controller
{
    public function Show($babylist_id)
    {
        // check if babylist exist
        $babylist = Babylist::where('id', '=', $babylist_id)->firstOrFail();

        // check if babylist is of logged in user
        if(! ($babylist->user_id === auth()->user()->id)){
            abort(404);
        }


        return view('share_babylist');
    }


    public function Share($babylist_id)
    {
        $all = $_POST;
        $babylist = Babylist::where('id', '=', $babylist_id)->firstOrFail();
        $url = 'babylist-' . strtolower($babylist->first_name_child) . '-' . str_replace( ' ', '-', strtolower($babylist['last_name_child']));

        // dd($url);

        for ($i=1; $i < count($all); $i++) {
            // dd($babylist);
            $email = $_POST['email-' . $i];
            Mail::to($email)->send(new shareBabylist($babylist, auth()->user()->name, $url));
        }

        return back();


    }
}
