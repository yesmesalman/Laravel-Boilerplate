<?php

use App\Enums\UserTypes;

?>

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
                    <div class="card-header py-3 d-flex justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Users</h6>
                        <div>
                            @if (request()->segment(3) == UserTypes::User || request()->segment(3) == UserTypes::Moderator)
                                <a href="{{ route('users.create', ['type' => request()->segment(3)]) }}"
                                    class="btn btn-primary">
                                    Add User
                                </a>
                            @endif
                        </div>
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
                                        <th>Id</th>
                                        <th>Created At</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Country</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Created At</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Country</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function($) {
            var table = $('#dataTable').DataTable({
                "pagingType": "full_numbers",
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('users.index', ['type' => $type]) }}",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'country',
                        name: 'country'
                    },
                    {
                        data: 'state',
                        name: 'state'
                    },
                    {
                        data: 'city',
                        name: 'city'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            var badgeClass = (data == 1) ? 'badge badge-success bg-success' :
                                'badge badge-danger bg-danger';
                            var statusText = (data == 1) ? 'Activated' : 'Disabled';
                            return '<span class="' + badgeClass + '">' + statusText + '</span>';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            var editButton = '<a href="/users/view/' + row.id +
                                '" class="btn btn-warning">Edit</a>';
                            var viewButton = '<a href="/users/view/' + row.id +
                                '" class="btn btn-info">View</a>';
                            var deleteButton = '';

                            // Check if the user role_id is either 1 or 2, and if so, add the delete button
                            if (row.role_id == 1 || row.role_id == 2) {
                                deleteButton = '<form class="delete-form" action="/users/delete/' +
                                    row.id +
                                    '" method="POST">@csrf @method('POST')<button type="submit" class="btn btn-danger">Delete</button></form>';
                            }

                            var buttonHtml = '<div class="d-flex justify-content-evenly">' +
                                editButton + ' ' +
                                viewButton + ' ' + deleteButton + '</div>';
                            return buttonHtml;
                        }
                    }
                ]
            });
        });
    </script>
@endsection
