<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Enums\UserTypes;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    private $users = null;

    public function __construct()
    {
        $this->users = User::orderby('created_at', 'desc');
    }

    public function index($type = UserTypes::LIST, Request $request)
    {
        $this->users->where('role_id', $type)->get();
        if ($request->ajax()) {
            $model = User::where('role_id', $type);
            return DataTables::of($model)
                ->addIndexColumn()
                ->addColumn('name', function (User $user) {
                    return $user->first_name . " " . $user->last_name;
                })
                ->addColumn('email', function (User $user) {
                    return $user->email;
                })
                ->addColumn('country', function (User $user) {
                    return $user->country_id;
                })
                ->addColumn('state', function (User $user) {
                    return $user->state_id;
                })
                ->addColumn('city', function (User $user) {
                    return $user->city_id;
                })
                ->addColumn('edit', function (User $user) {
                    return $user->id;
                })
                ->addColumn('view', function (User $user) {
                    return $user->id;
                })
                ->addColumn('created_at', function (User $user) {
                    return $user->getCreatedAtForHumans();
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('admin.users.index', compact('type'));
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
