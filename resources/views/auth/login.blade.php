@extends('layouts.app')
@section('content')
<div class="card">
    <h2>Login</h2>
    <form action="/login" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit" class="btn">Login</button>
    </form>
</div>
@endsection
