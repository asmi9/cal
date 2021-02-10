
@extends('layouts.AdminLayout')

@section('content')
<div class="container">
        {{--Success Msg--}}
        @if (session('msg_success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('msg_success')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    <h3 class="text-center">Edit User</h3>
    <div class="row">
        <div class="offset-md-3 col-md-6">
            <form method="POST" action={{url('/users/reloaddeatailssave/' . $user->id)}} enctype="multipart/form-data">
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
                    <label for="target">Target</label>
                    <input type="text" name="target" class="form-control @error('target') is-invalid @enderror" id="email" value='{{$user_rddetails->target}}'>
                    @error('target')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="pass">Achivement</label>
                    <input type="text" name="achivement" class="form-control @error('achivement') is-invalid @enderror" value='{{$user_rddetails->achivement}}' id="achivement">
                    @error('achivement')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="pass">Days</label>
                    <input type="text" name="days" class="form-control @error('days') is-invalid @enderror" value='{{$user_rddetails->days}}' id="days">
                    @error('days')
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