<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdministratorController extends Controller
{
    static function store()
    {
        $administrator = new User();
        $administrator->name = $_ENV["AMINISTRATOR_NAME"];
        $administrator->email = $_ENV["AMINISTRATOR_EMAIL"];
        $administrator->password = bcrypt($_ENV["AMINISTRATOR_PASSWORD"]);
        $administrator->save();
    }
}
