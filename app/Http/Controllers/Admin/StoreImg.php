<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class StoreImg extends Controller
{
    static function storeProductImg($img)
    {
        $ext = 'jpg';
        $year_month = date('Y/m/');
        $random_name = date('d'). '-'. Str::random(10) . '.'. $ext;

        $file_path = 'public/products/img/'. $year_month;
        $path_database = 'products/img/' . $year_month . $random_name;
        // $full_path = $file_path . $random_name;
        $file_system = Storage::disk('public');
        Storage::putFileAs($file_path, $img, $random_name);
        return redirect()->back()->with('full_path', $path_database);
    }

    static function storeBabyImg($img)
    {
        $ext = 'jpg';
        $year_month = date('Y/m/');
        $random_name = date('d'). '-'. Str::random(10) . '.'. $ext;

        $file_path = 'public/babylist/img/'. $year_month;
        $path_database = 'babylist/img/' . $year_month . $random_name;
        // $full_path = $file_path . $random_name;
        $file_system = Storage::disk('public');
        Storage::putFileAs($file_path, $img, $random_name);
        return redirect()->back()->with('full_path', $path_database);
    }

}
