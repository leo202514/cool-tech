@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Join Cool Tech</h2>
    <p>Create an account to join our community.</p>
    <hr>

    <form action="/register" method="POST">
        @csrf

        <div style="margin-bottom: 1rem;">
            <label>Name:</label><br>
            <input type="text" name="name" style="width:100%; padding: 8px;" required>
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Email Address:</label><br>
            <input type="email" name="email" style="width:100%; padding: 8px;" required>
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Password:</label><br>
            <input type="password" name="password" style="width:100%; padding: 8px;" required>
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Confirm Password:</label><br>
            <input type="password" name="password_confirmation" style="width:100%; padding: 8px;" required>
        </div>

        <button type="submit" class="btn">Create Account</button>
    </form>

    <p style="margin-top: 1rem; font-size: 0.9rem;">
        Already have an account? <a href="/login">Login here</a>.
    </p>
</div>
@endsection
