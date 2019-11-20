<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserRequest $request)
    {
        $User = User::create($request->all());
        return response(['data' => $User ], 201);

    }

    public function show($id)
    {
        $User = User::findOrFail($id);

        return response(['data', $User ], 200);
    }

    public function update(UserRequest $request, $id)
    {
        $User = User::findOrFail($id);
        $User->update($request->all());

        return response(['data' => $User ], 200);
    }

    public function destroy($id)
    {
        User::destroy($id);

        return response(['data' => null ], 204);
    }
}
