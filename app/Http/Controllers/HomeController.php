<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;

class HomeController extends Controller
{
    /**
     * Display the landing page with the 5 most recent articles.
     */
    public function index()
    {
        $articles = Article::latest()->take(5)->get();

        return view('home', compact('articles'));
    }
}
