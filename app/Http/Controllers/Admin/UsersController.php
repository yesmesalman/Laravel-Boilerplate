<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Enums\UserTypes;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{
    private $users = null;

    public function __construct()
    {
        $this->users = User::orderby('created_at', 'desc');
    }

    public function index($type = UserTypes::User)
    {
        $users = $this->users->where('role_id', $type)->get();

        return view('admin.users.index', [
            "users" => $users
        ]);
    }

    public function view(Request $request, $id)
    {
        $user = User::where('id', $id)->first();

        if ($user == null) {
            return Redirect::back()->with(['flash_error' => "User not found"]);
        }

        if ($request->isMethod('post')) {
            $validation = [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'state_id' => ['required', 'numeric'],
                'city_id' => ['required', 'numeric'],
                'zip_code' => ['required'],
                'contact_number' => ['required'],
            ];

            $request->validate($validation);

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->status = $request->status;
            $user->state_id = $request->state_id;
            $user->city_id = $request->city_id;
            $user->zip_code = $request->zip_code;
            $user->contact_number = $request->contact_number;

            if ($user->save()) {
                return Redirect::back()->with(['flash_success' => "Congratulations!, User details are updated."]);
            }

            return Redirect::back()->with(['flash_error' => "Oops!, Something went wrong."]);
        }

        return view('admin.users.view', [
            "user" => $user,
            "users_url" => route('users.index', $user->role_id)
        ]);
    }
}
