@extends('layouts.AdminLayout')

@section('content')
<div class="container">
    <h3 class="text-center">Add New User</h3>
    <div class="row">
        <div class="offset-md-3 col-md-6">
            <form method="POST" action="/users/store" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="full_name">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="pass">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="pass">
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="permissionSelect">Permission</label>
                    <select class="form-control" name="permission" id="permissionSelect">
                        <option value="1">Active</option>
                        <option value="0">DeActive</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="role">Permission</label>
                    <select class="form-control" name="role" id="role">
                        <option value="0">User</option>
                        <option value="1">Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Create</button>
            </form>
        </div>
    </div>
</div>

@endsection