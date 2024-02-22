<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\UserRequest;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index(): Response
    {
        $users = User::all();

        return response(view('users.index', ['users' => $users]));
    }

    public function create(): Response
    {
        return response(view('users.create'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        // Simpan data pengguna baru ke dalam database
        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = bcrypt($request->password); // Hash password sebelum disimpan
        $user->save();

        // Redirect atau response sesuai kebutuhan
        return redirect()->back()->with('success', 'User created successfully!');
    }


    public function edit(string $id): Response
    {
        $user = User::findOrFail($id);

        return response(view('users.edit', ['user' => $user]));
    }

    public function update(UserRequest $request, string $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        if ($user->update($request->validated())) {
            return redirect(route('users.index'))->with('success', 'Updated!');
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        if ($user->delete()) {
            return redirect(route('users.index'))->with('success', 'Deleted!');
        }
    }

}
