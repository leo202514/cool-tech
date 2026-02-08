@extends('layouts.app')

@section('content')
<div class="welcome-section" style="margin-bottom: 2rem;">
    <h1>Latest Tech News</h1>
    <p>Welcome back! Here are the 5 most recent updates from the world of technology.</p>
</div>

@foreach($articles as $article)
    <div class="card">
        <h2>{{ $article->title }}</h2>
        <p style="color: #64748b; font-size: 0.9rem;">
            Posted on {{ $article->created_at->format('M d, Y') }}
            in <strong>{{ $article->category->name }}</strong>
        </p>
        <p>{{ Str::limit($article->content, 150) }}</p>
        <a href="/article/{{ $article->id }}" class="btn">Read Full Article</a>
    </div>
@endforeach

<div style="text-align: center; margin-top: 2rem;">
    <a href="/search" style="color: var(--primary);">Looking for something older? Use our Search Page.</a>
</div>
@endsection
