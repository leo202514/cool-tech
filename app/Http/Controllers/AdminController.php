<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Main dashboard: Fetches all data needed for the site admin view.
     */
    public function index() {
        return view('admin_console', [
            'categories' => Category::all(),
            'articles' => Article::latest()->get(),
            'users' => User::all()
        ]);
    }

    /**
     * Updates the logged-in Admin's credentials (Name, Email, Password).
     */
    public function updateAdmin(Request $request) {
        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return back()->with('success', 'Admin profile updated!');
    }

    /**
     * Simple category creation with automatic slug generation.
     */
    public function storeCategory(Request $request)
    {
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return back()->with('success', 'Category Created!');
    }
}
