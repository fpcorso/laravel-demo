<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class NonLoggedInController extends Controller
{
    public function home()
    {
        $articles = Article::latest()->take(10)->get();
        return view('home', compact('articles'));
    }
}
