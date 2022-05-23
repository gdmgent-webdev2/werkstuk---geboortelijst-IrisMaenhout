<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GetSubCategoriesController extends Controller
{
    static function getSubCategories()
    {
        $sub_categories = DB::table('sub_categories')->get();

        return $sub_categories;
    }
}
