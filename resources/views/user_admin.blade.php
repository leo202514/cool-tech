@extends('layouts.app')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h2>User Management Console</h2>
        </div>
    <hr>

    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr style="text-align: left; background: #f1f5f9;">
                <th style="padding: 12px;">Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr style="border-bottom: 1px solid #e2e8f0;">
                <td style="padding: 12px;">{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <form action="/user-admin/{{ $user->id }}/role" method="POST">
                        @csrf @method('PATCH')
                        <select name="role" onchange="this.form.submit()" {{ $user->id === Auth::id() ? 'disabled' : '' }}>
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                            <option value="writer" {{ $user->role == 'writer' ? 'selected' : '' }}>Writer</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </form>
                </td>
                <td>
                    @if($user->id !== Auth::id())
                    <form action="/user-admin/{{ $user->id }}" method="POST" onsubmit="return confirm('Delete user permanently?')">
                        @csrf @method('DELETE')
                        <button type="submit" style="color: #ef4444; border: none; background: none; cursor: pointer;">Delete</button>
                    </form>
                    @else
                    <span style="color: #94a3b8; font-style: italic;">(You)</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
