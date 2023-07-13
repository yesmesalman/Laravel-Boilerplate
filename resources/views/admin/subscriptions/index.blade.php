@extends('layouts.dashboard')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <nav aria-label="breadcrumb" class="my-2">
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
                        @if (session()->has('flash_error'))
                            <div class="alert alert-danger">{{ session()->get('flash_error') }}</div>
                        @endif

                        @if (session()->has('flash_success'))
                            <div class="alert alert-success">{{ session()->get('flash_success') }}</div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>...</th>
                                        <th>Created At</th>
                                        <th>User</th>
                                        <th>Plan</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>...</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>...</th>
                                        <th>Created At</th>
                                        <th>User</th>
                                        <th>Plan</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>...</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($subscription as $s)
                                        <tr>
                                            <td>{{ $s->id }}</td>
                                            <td>{{ $s->getCreatedAtForHumans() }}</td>
                                            <td>
                                                @if($s->User)
                                                <a href="{{ route('users.view', $s->user_id) }}">{{ $s->User->full_name }}</a>
                                                @else
                                                -
                                                @endif
                                            </td>
                                            <td>
                                                @if($s->Plan)
                                                <a href="{{ route('plans.index', $s->Plan->id) }}">{{ $s->Plan->name }}</a>
                                                @else
                                                -
                                                @endif
                                            </td>
                                            <td>${{ $s->Plan->price }}</td>
                                            <td><span class="badge {{$s->status == 'cancelled' ? 'badge-danger' : 'badge-success'}} ">{{$s->status == 'cancelled' ? 'In-active' : 'Active'}}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
