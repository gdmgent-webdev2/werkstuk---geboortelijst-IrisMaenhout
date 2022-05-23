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
        // $id = '';
        $example_img="https://cdn.webshopapp.com/shops/327983/files/397690037/252x252x2/image.jpg";

        // $product_img = 'https://cdn.webshopapp.com/shops/327983/files/' . $id .'/252x252x2/image.jpg';

        $ext = 'jpg';
        $random_name = date('d'). '-'. Str::random(10) . '.'. $ext;
        $file_path = 'public/products/img/'. date('Y/m/');
        $full_path = $file_path . $random_name;
        $file_system = Storage::disk('public');
        Storage::putFileAs($file_path, $example_img, $random_name);
        dump($img);

        // save in database
    }
}
