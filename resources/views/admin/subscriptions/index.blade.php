@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Subscriptions</li>
        </ol>
    </nav>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Subscriptions</h6>
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
                            <th>User</th>
                            <th>Plan</th>
                            <th>Amount</th>
                            <th>Status</th>
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
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr>
                            <td>{{ $payment->id }}</td>
                            <td>{{ $payment->getCreatedAtForHumans() }}</td>
                            <td>
                                @if($payment->User)
                                <a href="{{ route('users.view', $payment->user_id) }}">{{ $payment->User->first_name ." ". $payment->User->last_name }}</a>
                                @else
                                -
                                @endif
                            </td>
                            <td>
                                @if($payment->Plan)
                                <a href="{{ route('plans.index', $payment->Plan->id) }}">{{ $payment->Plan->name }}</a>
                                @else
                                -
                                @endif
                            </td>
                            <td>${{ $payment->amount }}</td>
                            <td><span class="badge badge-success">COMPLETED</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection