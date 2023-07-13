@extends('layouts.dashboard')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <nav aria-label="breadcrumb" class="my-2">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Plans</li>
                    </ol>
                </nav>
                <div>
                    <a href="{{ route('plans.create') }}" class="btn btn-primary">Create New Plan</a>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Manage Plans</h6>
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
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Price</th>
                                        <th>Created At</th>
                                        <th>...</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>...</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Price</th>
                                        <th>Created At</th>
                                        <th>...</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($plans as $plan)
                                        <tr>
                                            <td>{{ $plan->id }}</td>
                                            <td>{{ $plan->name }}</td>
                                            <td>{{ $plan->slug }}</td>
                                            <td>${{ $plan->price }}</td>
                                            <td>{{ $plan->getCreatedAtForHumans() }}</td>
                                            <td>
                                                <a href="{{ route('plans.edit', $plan->id) }}">View</a> |
                                                <a href="{{ route('plans.edit', $plan->id) }}">Edit</a>
                                                {{-- <a href="{{ route('plans.delete', $plan->id) }}" style="color: red" onclick="return confirm('Are you sure?')">Delete</a> --}}
                                            </td>
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
