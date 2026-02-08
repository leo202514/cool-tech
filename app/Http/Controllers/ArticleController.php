<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;

class ArticleController extends Controller
{
    /**
     * Display the Search Page.
     * Handles keyword searches, category/tag filters, and direct ID lookups.
     */
    public function index(Request $request)
    {
        $query = Article::query();

        // Check if the search input is a number (Potential ID search)
        if ($request->filled('q') && is_numeric($request->q)) {
            $articleById = Article::find($request->q);
            if (!$articleById) {
                return back()->with('error', "Article ID #{$request->q} not found.");
            }
            return redirect("/article/{$articleById->id}");
        }

        // Filter results based on search keyword (Title or Content)
        if ($request->filled('q')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->q . '%')
                  ->orWhere('content', 'like', '%' . $request->q . '%');
            });
        }

        // Filter by Category Name (Linked to the 'search-as-you-type' datalist)
        if ($request->filled('category_name')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('name', $request->category_name);
            });
        }

        return view('search', [
            'articles' => $query->latest()->get(),
            'categories' => Category::all(),
            'tags' => Tag::all()
        ]);
    }

    /**
     * Display the Full Archive.
     * Uses pagination to prevent loading too many records at once.
     */
    public function all()
    {
        return view('all_articles', [
            'articles' => Article::latest()->paginate(10)
        ]);
    }

    /**
     * Display a Single Article.
     * Includes 404 handling if the ID doesn't exist.
     */
    public function show($id)
    {
        $article = Article::with(['category', 'tags'])->findOrFail($id);
        return view('article_view', compact('article'));
    }

    /**
     * Filter Articles by Category Slug.
     */
    public function byCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        return view('list_view', [
            'title' => "Category: {$category->name}",
            'articles' => $category->articles()->latest()->get()
        ]);
    }
    /**
     * Filter Articles by Tag Slug.
     */
    public function byTag($slug)
{
    $tag = Tag::where('slug', $slug)->firstOrFail();
    return view('list_view', [
        'title' => "Tag: #{$tag->name}",
        'articles' => $tag->articles()->latest()->get()
    ]);
}
}
