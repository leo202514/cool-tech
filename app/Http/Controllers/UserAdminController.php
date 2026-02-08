<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserAdminController extends Controller
{
    public function index()
    {
        return view('user_admin', [
            'users' => User::all()
        ]);
    }

    // Change a user's role (Grant/Remove Privileges)
    public function updateRole(Request $request, User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Use the profile section to edit yourself!');
        }

        $user->update(['role' => $request->role]);
        return back()->with('success', "Role for {$user->name} updated.");
    }

   /**
    * Permanently deletes a user from the system.
    * Safety: Prevents the currently logged-in Admin from deleting themselves.
    */
public function destroy(User $user)
{
    if ($user->id === Auth::id()) {
        return back()->with('error', 'You cannot delete your own account!');
    }

    $user->delete();
    return back()->with('success', 'User has been removed.');
}
}
