<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

use function Flasher\Toastr\Prime\toastr;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // $users = User::paginate(10);
        $users = DB::table('users')->when($request->input('name'), function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('pages.user.index', compact('users'));
    }

    public function create()
    {
        return view('pages.user.create');
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $data = $request->all();
            $data['password'] = Hash::make($request->password);
            $data['is_member'] = $request->has('is_member') ? $request->input('is_member') : false; // Default to false

            User::create($data);
            toastr()->success('User created successfully.');
            return redirect()->route('user.index');
        } catch (\Throwable $th) {
            toastr()->error('Failed to create user. Please try again.');
            return redirect()->route('user.create');
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        if (!$user) {
            abort(404);
        }
        return view('pages.user.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $data = $request->validated();
            $data['is_member'] = $request->has('is_member') ? $request->input('is_member') : false; // Default to false
            $user->update($data);
            toastr()->success('User updated successfully.');
            return redirect()->route('user.index');
        } catch (\Throwable $th) {
            toastr()->error('Failed to update user. Please try again.');
            return redirect()->route('user.index');
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            abort(404);
        }
        try {
            $user->delete();
            toastr()->success('User deleted successfully.');
            return redirect()->route('user.index');
        } catch (\Throwable $th) {
            toastr()->error('Failed to delete user. Please try again.');
            return redirect()->route('user.index');
        }
    }
}
