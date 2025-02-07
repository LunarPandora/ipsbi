<?php

namespace App\Http\Controllers;

use App\Models\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function fetch(Request $request){
        $banners = Category::select('id', 'nama')->get();

        return response()->json($banners);
    }
}
