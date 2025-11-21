<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('components.header', compact('categories'));
    }
}
