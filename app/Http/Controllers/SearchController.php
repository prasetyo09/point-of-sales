<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Category;
use App\Models\Product;

class SearchController extends Controller
{
    public function index(Request $request){
        $keyword = $request->input('keyword');

        if (blank($keyword)) {
            $results = [
                'products'   => collect(),
                'categories' => collect(),
                'users'      => collect(),
                'roles'      => collect(),
            ];
            return view('search.index', compact('results', 'keyword'));
        }

        $results = [
            'users'      => User::where('name', 'like', "%{$keyword}%")->orWhere('email', 'like', "%{$keyword}%")->get(),
            'products' => Product::where('name', 'like', "%{$keyword}%")->get(),
            'categories' => Category::where('name', 'like', "%{$keyword}%")->get(),
            'roles'      => Role::where('name', 'like', "%{$keyword}%")->get()
        ];

        return view('search.index', compact('results', 'keyword'));
    }
}
