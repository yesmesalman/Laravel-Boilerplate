<?php

use App\Enums\UserTypes;

?>

@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ $users_url }}">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $user->first_name }} {{ $user->last_name }}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            @if(session()->has('flash_error'))
            <div class="alert alert-danger">{{ session()->get('flash_error') }}</div>
            @endif
            @if(session()->has('flash_success'))
            <div class="alert alert-success">{{ session()->get('flash_success') }}</div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <form method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="h5 mb-2 text-gray-800">Personal Details</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="role_id">Account Type</label>
                                    <input id="role_id" type="text" value="{{ $user->Role->name }}" class="form-control" readonly disabled />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input id="first_name" type="text" name="first_name" value="{{ old('first_name') ?? $user->first_name }}" class="form-control @error('first_name') is-invalid @enderror" />
                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input id="last_name" type="text" name="last_name" value="{{ old('last_name') ?? $user->last_name }}" class="form-control @error('last_name') is-invalid @enderror" />
                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" value="{{ $user->email }}" class="form-control" readonly disabled />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="0" {{ $user->status == "0" ? 'selected' : '' }}>Disabled</option>
                                        <option value="1" {{ $user->status == "1" ? 'selected' : '' }}>Activated</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="state_id">State</label>
                                    <select name="state_id" id="state_id" class="form-control @error('state_id') is-invalid @enderror">
                                        <option value="">Select State</option>
                                        @foreach(getStates($user->country_id ?? 167) as $stateItem)
                                        <option value="{{ $stateItem->id }}" {{ $user->state_id == $stateItem->id ? 'selected' : '' }}>{{ $stateItem->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('state_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="city_id">City</label>
                                    <select name="city_id" id="city_id" class="form-control @error('city_id') is-invalid @enderror">
                                        <option value="">Select City</option>
                                    </select>
                                    @error('city_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="zip_code">ZIP Code</label>
                                    <input id="zip_code" type="text" name="zip_code" value="{{ old('zip_code') ?? $user->zip_code }}" class="form-control @error('zip_code') is-invalid @enderror" />
                                    @error('zip_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact_number">Contact Number</label>
                                    <input id="contact_number" type="text" name="contact_number" value="{{ old('contact_number') ?? $user->contact_number }}" class="form-control @error('contact_number') is-invalid @enderror" />
                                    @error('contact_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="h5 mb-2 text-gray-800">Advanced Details</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Current OTP</label>
                                <input type="text" readonly disabled value="{{ $user->otp }}" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Account Verified</label>
                                <input type="text" readonly disabled value="{{ $user->status == '1' ? 'Yes' : 'No' }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
<script>
    const old_state_id = "{{ (old('state_id') ? old('state_id') : $user->state_id) ? $user->state_id : '' }}";
    const old_city_id = "{{ (old('city_id') ? old('city_id') : $user->city_id) ? $user->city_id : '' }}";

    function getCities(state_id) {
        const url = "{{ route('states.get-cities') }}"
        var html = "";

        $.ajax({
            url,
            type: 'GET',
            data: {
                state_id
            },
            success: function(response) {
                let html = "";

                response.forEach(element => {
                    html += `
                        <option value="${element.id}" ${old_city_id == element.id ? 'selected' : ''}>${element.name}</option>
                    `;
                });

                $("#city_id").html(html)
            }
        });
    }

    $(document).on("change", "#state_id", function(e) {
        const selectedState = e.target.value

        if (selectedState) {
            getCities(selectedState);
        }
    });

    if (old_state_id) {
        getCities(old_state_id);
    }
</script>
@endsection