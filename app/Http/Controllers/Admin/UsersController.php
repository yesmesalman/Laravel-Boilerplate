<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Enums\UserTypes;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Khsing\World\Models\Country;
use Khsing\World\Models\Division as State;
use Khsing\World\Models\City;
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
        if ($request->ajax()) {
            $query = User::query()
                ->where('role_id', $type)
                ->leftJoin('world_countries as countries', 'users.country_id', '=', 'countries.id')
                ->leftJoin('world_countries as states', 'users.state_id', '=', 'states.id')
                ->leftJoin('world_countries as cities', 'users.city_id', '=', 'cities.id');
            return DataTables::eloquent($query)
                ->addIndexColumn()
                ->addColumn('name', function (User $user) {
                    return $user->first_name . " " . $user->last_name;
                })
                ->addColumn('email', function (User $user) {
                    return $user->email;
                })
                ->addColumn('country', function (User $user) {
                    return $user->getUserDisplayFields()['country'];
                })
                ->addColumn('state', function (User $user) {
                    return $user->getUserDisplayFields()['state'];
                })
                ->addColumn('city', function (User $user) {
                    return $user->getUserDisplayFields()['city'];
                })
                ->addColumn('edit', function (User $user) {
                    return $user->id;
                })
                ->addColumn('view', function (User $user) {
                    return $user->id;
                })
                ->addColumn('delete', function (User $user) {
                    return $user->id;
                })
                ->addColumn('created_at', function (User $user) {
                    return $user->getCreatedAtForHumans();
                })
                // Add searching functionality for specific columns
                ->filterColumn('name', function ($query, $keyword) {
                    $query->whereRaw("CONCAT(users.first_name, ' ', users.last_name) like ?", ["%{$keyword}%"]);
                })
                ->filterColumn('email', function ($query, $keyword) {
                    $query->where('users.email', 'like', "%{$keyword}%");
                })
                ->filterColumn('country', function ($query, $keyword) {
                    $query->where('countries.name', 'like', "%{$keyword}%");
                })
                ->filterColumn('state', function ($query, $keyword) {
                    $query->where('states.name', 'like', "%{$keyword}%");
                })
                ->filterColumn('city', function ($query, $keyword) {
                    $query->where('cities.name', 'like', "%{$keyword}%");
                })
                ->orderColumn('created_at', 'users.created_at $1')
                ->orderColumn('name', 'users.first_name $1, users.last_name $1')
                ->orderColumn('email', 'users.email $1')
                ->orderColumn('country', 'countries.name $1')
                ->orderColumn('state', 'states.name $1')
                ->orderColumn('city', 'cities.name $1')
                ->make(true);
        }
        return view('admin.users.index', compact('type'));
    }

    public function create($type = UserTypes::LIST)
    {
        $country = Country::get();
        return view('admin.users.add', [
            'country' => $country,
            'type' => User::where('role_id', $type)->get()
        ]);
    }

    public function store(Request $request)
    {
        $validationRules = [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users,email'],
            'password' => ['required', 'string'],
            'country_id' => ['numeric'],
            'state_id' => ['numeric'],
            'city_id' => ['numeric'],
            'zip_code' => ['required'],
            'contact_number' => ['required'],
        ];
        // Create the validator instance
        $validator = Validator::make($request->all(), $validationRules);

        $image_name = null;
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $image_name = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('/images/users'), $image_name);
        }

        // Check if the validation fails
        if ($validator->fails()) {
            return redirect()->back()->with(['flash_error' => "Whoops! Something went wrong."]);
        }
        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_picture' => $image_name,
            'role_id' => 1,
            'status' => 1,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'zip_code' => $request->zip_code,
            'contact_number' => $request->contact_number,
        ]);
        return redirect()->back()->with(['flash_success' => "Congratulations! User has been created."]);
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
                'country_id' => ['numeric'],
                'state_id' => ['numeric'],
                'city_id' => ['numeric'],
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
            $user->profile_picture = $request->profile_picture;
            if ($request->hasFile('profile_picture')) {
                $image = $request->file('profile_picture');
                $image_name = $user->id . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/users'), $image_name);
                $user->profile_picture = $image_name;
            }
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

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back()->with(['flash_success' => "Congratulations! User account has been deleted."]);
    }
}
