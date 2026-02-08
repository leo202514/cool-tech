@extends('layouts.app')

@section('content')
    <article class="card">
        <header style="margin-bottom: 2rem;">
            <h1>{{ $article->title }}</h1>
            <p style="color: #64748b;">
                Published on {{ $article->created_at->format('M d, Y') }} |
                Category: <a href="/category/{{ $article->category->slug }}">{{ $article->category->name }}</a>
            </p>
        </header>

        <div class="content" style="font-size: 1.1rem; line-height: 1.8;">
            {!! nl2br(e($article->content)) !!}
        </div>

        <hr style="margin: 2rem 0;">

        <div class="tags">
            <strong>Tagged with:</strong>
            @foreach($article->tags as $tag)
                <a href="/tag/{{ $tag->slug }}" class="tag-badge">
                    #{{ $tag->name }}
                </a>
            @endforeach
        </div>

        <footer style="margin-top: 2rem;">
            <a href="/" class="btn" style="background: #64748b;">← Back to Home</a>
        </footer>
    </article>
@endsection
