@extends('layouts.app')

@section('content')
<div class="card">
    <h1>Admin Console</h1>
    <p>Welcome, {{ Auth::user()->name }}. You have full administrative access.</p>
    <hr>

    <h3>Manage Article Types (Categories)</h3>
       <form action="/admin/category" method="POST" style="margin-bottom: 20px;">
        @csrf
        <input type="text" name="name" placeholder="New Category Name" required style="padding: 8px;">
        <button type="submit" class="btn">Create Category</button>
    </form>

    <table style="width: 100%; border-collapse: collapse;">
        @foreach($categories as $cat)
        <tr style="border-bottom: 1px solid #eee;">
            <td style="padding: 10px;">{{ $cat->name }}</td>
            <td>
                <form action="/admin/category/{{ $cat->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PATCH')
                    <input type="text" name="name" placeholder="Rename..." required style="padding: 4px;">
                    <button type="submit" class="btn" style="padding: 5px 10px; font-size: 0.8rem;">Update</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    <hr style="margin: 2rem 0;">

    <h3>Delete Articles</h3>
    <table style="width: 100%;">
        @foreach($articles as $article)
        <tr style="border-bottom: 1px solid #eee;">
            <td style="padding: 10px;">{{ $article->title }}</td>
            <td style="text-align: right;">
                <form action="/admin/article/{{ $article->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="color: #ef4444; border: none; background: none; cursor: pointer; font-weight: bold;" onclick="return confirm('Permanent delete?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
