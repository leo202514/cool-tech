@extends('layouts.app')

@section('content')
<div class="card" style="background: none; box-shadow: none; padding-left: 0;">
    <h1>Article Archive</h1>
    <p>Browsing all stories from Cool Tech.</p>
</div>

<div style="display: grid; gap: 20px;">
    @foreach($articles as $article)
        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <h2 style="margin-top: 0;">{{ $article->title }}</h2>
                    <span style="background: #e2e8f0; padding: 2px 8px; border-radius: 4px; font-size: 0.8rem; text-transform: uppercase;">
                        {{ $article->category->name }}
                    </span>
                </div>
                <small style="color: #94a3b8;">{{ $article->created_at->diffForHumans() }}</small>
            </div>

            <p style="margin: 15px 0;">{{ Str::limit($article->content, 200) }}</p>

            <a href="/article/{{ $article->id }}" style="color: var(--primary); font-weight: bold; text-decoration: none;">
                Read Story &rarr;
            </a>
        </div>
    @endforeach
</div>
<div style="margin-top: 20px;">
    {{ $articles->links() }}
</div>
@endsection
