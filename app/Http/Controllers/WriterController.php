<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WriterController extends Controller
{
    public function index() {
    return view('writer_console', ['categories' => \App\Models\Category::all()]);
}

   /**
    * Processes a new article submission.
    * Splits comma-separated tags and attaches them to the new article.
    */
public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'content' => 'required',
        'category_id' => 'required',
        'tags' => 'required',
    ]);

    $article = Article::create([
        'title' => $request->title,
        'content' => $request->content,
        'category_id' => $request->category_id,
    ]);

    // Convert string "Tech, News" into array ["Tech", "News"]
    $tagNames = explode(',', $request->tags);
    foreach ($tagNames as $name) {
        $name = trim($name);
        $tag = Tag::firstOrCreate(
            ['name' => $name],
            ['slug' => Str::slug($name)]
        );
        $article->tags()->attach($tag->id);
    }

    return redirect('/')->with('success', 'Article published!');
}
}
