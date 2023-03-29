<?php

use App\Enums\UserTypes;

?>

@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Manage Plans</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Plan</li>
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
                                <h5 class="h5 mb-2 text-gray-800">Edit Plan</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input id="name" type="text" name="name" value="{{ old('name') ?? $plan->name }}" class="form-control @error('name') is-invalid @enderror" />
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input id="slug" type="text" name="slug" value="{{ old('slug') ?? $plan->slug }}" class="form-control @error('slug') is-invalid @enderror" />
                                    @error('slug')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input id="price" type="text" name="price" value="{{ old('price') ?? $plan->price }}" class="form-control @error('price') is-invalid @enderror" />
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" cols="30" rows="2" class="form-control @error('description') is-invalid @enderror">{{old('description') ?? $plan->description}}</textarea>
                                    @error('description')
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
    </div>
</div>
@endsection