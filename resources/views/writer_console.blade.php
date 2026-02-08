@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Writer's Console</h2>
    <form action="/writer" method="POST">
        @csrf
        <div style="margin-bottom: 1rem;">
            <label>Title:</label><br>
            <input type="text" name="title" style="width:100%;" required>
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Category:</label><br>
<select name="category_id" required style="width:100%; padding: 8px;">
    @foreach($categories as $cat)
        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
    @endforeach
</select>
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Content:</label><br>
            <textarea name="content" rows="10" style="width:100%;" required></textarea>
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Tags (comma separated):</label><br>
            <input type="text" name="tags" placeholder="AI, Technology, Linux" style="width:100%;" required>
        </div>

        <button type="submit" class="btn">Publish Article</button>
    </form>
</div>
@endsection
