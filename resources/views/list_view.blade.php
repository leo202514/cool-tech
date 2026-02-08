@extends('layouts.app')

@section('content')
    <header style="margin-bottom: 2rem;">
        h2>{{ $title }}</h2>
        <p style="color: #64748b;">Showing all articles related to this topic.</p>
        <hr>
    </header>

    @if($articles->isEmpty())
        <div class="card">
            <p>No articles found for this selection.</p>
            <a href="/" class="btn">Return Home</a>
        </div>
    @else
        @foreach($articles as $article)
            <div class="card">
                <h3>
                    <a href="/article/{{ $article->id }}" style="color:var(--primary); text-decoration:none;">
                        {{ $article->title }}
                    </a>
                </h3>

                <p>{{ Str::limit($article->content, 150) }}</p>

                <a href="/article/{{ $article->id }}" style="font-size: 0.9rem; font-weight: bold; color: var(--primary);">
                    Read More →
                </a>
            </div>
        @endforeach
    @endif

    <div style="margin-top: 2rem;">
        <a href="/" class="btn" style="background: #64748b;">← Back to All News</a>
    </div>
@endsection
