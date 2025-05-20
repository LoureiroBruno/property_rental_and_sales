<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserAccountRequest;
use App\Http\Requests\UserAccountRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserAccountController extends Controller
{
    public function create()
    {
        return inertia('UserAccount/Create');
    }

    public function store(UserAccountRequest $request)
    {
        $validated = $request->validated();

        $user = User::create($validated);

        Auth::login($user);

        return redirect()->route('listing.index')
            ->with('success', 'Account created!');
    }

    public function edit(Request $request)
    {
        return inertia('UserAccount/Edit', [
            'user' => $request->user()
        ]);
    }

    public function update(UpdateUserAccountRequest $request, User $user)
    {
        if ($request->user()->id !== $user->id) {
            abort(403, 'You do not have access permission');
        }

        $validated = $request->validated();

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->back()->with('success', 'Updated successfully');
    }
}
