@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
    </nav>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Users</h6>
        </div>
        <div class="card-body">
            @if(session()->has('flash_error'))
            <div class="alert alert-danger">{{ session()->get('flash_error') }}</div>
            @endif

            @if(session()->has('flash_success'))
            <div class="alert alert-success">{{ session()->get('flash_success') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>...</th>
                            <th>Created At</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Country</th>
                            <th>State</th>
                            <th>City</th>
                            <th>Status</th>
                            <th>...</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>...</th>
                            <th>Created At</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Country</th>
                            <th>State</th>
                            <th>City</th>
                            <th>Status</th>
                            <th>...</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->getCreatedAtForHumans() }}</td>
                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->Country ? $user->Country->name : '-' }}</td>
                            <td>{{ $user->State ? $user->State->name : '-' }}</td>
                            <td>{{ $user->City ? $user->City->name : '-' }}</td>
                            <td>
                                @if($user->status == 1)
                                <span class="badge badge-success">Activated</span>
                                @else
                                <span class="badge badge-secondary">Disabled</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('users.view', $user->id) }}">View</a> |
                                <a href="{{ route('users.view', $user->id) }}">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection