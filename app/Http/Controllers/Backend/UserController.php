<?php
/*
 * Copyright (c) 2021.
 * This file is originally created and maintained by Ariful Islam.
 * You are not allowed to modify any parts of this code or copy or even redistribute
 * full or small portion to anywhere. If you have any question
 * fee free to ask me at arif98741@gmail.com.
 * Ariful Islam
 * Software Engineer
 * https://github.com/arif98741
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = [
            'users' => User::with('role')->whereNotIn('role_id', [1, 2, 5])->get()
        ];

        return view('backend.user.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data = [
            'roles' => Role::orderBy('name', 'asc')->whereNotIn('id', [1])->get()
        ];
        return view('backend.user.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return void
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $data['user_slug'] = Str::slug($request->first_name) . rand(11111, 99999);
        $data['password'] = Hash::make('123');
        if (User::create($data)) {
            return redirect()->route('backend.user.index')->with(
                [
                    'message' => 'User successfully to system',
                    'alert-type' => 'success'
                ]
            );
        }

        return redirect()->back()->with(
            [
                'message' => 'Failed to add user',
                'alert-type' => 'error'
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(User $user)
    {
        $data = [
            'roles' => Role::orderBy('name', 'asc')->whereNotIn('id', [1])->get(),
            'user' => $user
        ];
        return view('backend.user.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UserRequest $request, User $user)
    {
        $data = $request->all();
        $data['user_slug'] = Str::slug($request->first_name) . rand(11111, 99999);
        $data['password'] = Hash::make('123');
        if ($user->update($data)) {
            return redirect()->route('backend.user.index')->with(
                [
                    'message' => 'User successfully updated',
                    'alert-type' => 'success'
                ]
            );
        }

        return redirect()->back()->with(
            [
                'message' => 'Failed to update user',
                'alert-type' => 'error'
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            return redirect()->route('backend.user.index')->with(
                [
                    'message' => 'User successfully deleted',
                    'alert-type' => 'success'
                ]
            );
        }

        return redirect()->back()->with(
            [
                'message' => 'Failed to delete user',
                'alert-type' => 'error'
            ]
        );
    }
}
