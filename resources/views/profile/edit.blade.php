@extends('layouts.userLayout')

@section('content')
<div class="container">
        <h3 class="text-center">Edit User</h3>
    <div class="row">
        <div class="offset-md-3 col-md-6">
            <form method="POST" action={{url('profile/')}} enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="full_name" value='{{$user->name}}'>
                    @error('name')
                        <div class="invalid-feedback">
                                {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value='{{$user->email}}' disabled>
                    @error('email')
                        <div class="invalid-feedback">
                                {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="pass">New Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="pass">
                    @error('password')
                    <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <input type="hidden" name="_method" value="PUT">
                <button type="submit" class="btn btn-primary btn-block">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection