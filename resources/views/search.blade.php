@extends('layouts.app')

@section('content')
<div class="card">
    <form action="/search" method="GET" style="display: flex; gap: 15px; flex-wrap: wrap;">
        <div style="flex: 2; min-width: 200px;">
            <label>Search Keywords/ID:</label>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Title, content, or ID..." style="width: 100%; padding: 10px;">
        </div>

        <div style="flex: 1; min-width: 150px;">
            <label>Category:</label>
            <input list="categories" name="category_name" placeholder="Start typing..." style="width: 100%; padding: 10px;">
            <datalist id="categories">
                @foreach($categories as $cat)
                    <option value="{{ $cat->name }}">
                @endforeach
            </datalist>
        </div>

        <div style="flex: 1; min-width: 150px;">
            <label>Tag:</label>
            <input list="tags" name="tag_name" placeholder="Start typing..." style="width: 100%; padding: 10px;">
            <datalist id="tags">
                @foreach($tags as $t)
                    <option value="{{ $t->name }}">
                @endforeach
            </datalist>
        </div>

        <button type="submit" class="btn" style="align-self: flex-end; height: 42px;">Search</button>
    </form>
</div>

<hr>

@if($articles->isEmpty())
    <div class="card" style="text-align: center; border: 2px dashed #cbd5e1; background: #f8fafc;">
        <h3 style="color: #64748b;">No articles found!</h3>
        <p>We couldn't find anything matching your search criteria. Try using different keywords or clearing your filters.</p>
        <a href="/search" class="btn" style="background: #64748b;">Reset Search</a>
    </div>
@else
    <p style="margin-bottom: 20px;">Showing {{ $articles->count() }} results.</p>
    @foreach($articles as $article)
        <div class="card">
            <h3>{{ $article->title }}</h3>
            <p>{{ Str::limit($article->content, 150) }}</p>
            <a href="/article/{{ $article->id }}" style="color: var(--primary);">Read More &rarr;</a>
        </div>
    @endforeach
@endif
@endsection
