@extends('layouts.userLayout')

@section('content')
<div class="container">
    <a class="btn btn-secondary" href="/home">Go Back</a>
    <h3 class="text-center">{{$user->name}}</h3>
    <div class="row">
        <div class="offset-md-2 col-md-8 mt-3 user-info">
            <div class="text-center mb-4">
                <img class="profile_image text-center" src="{{($user->image == NULL) ? '/img/no-photo.png' : '/storage/' . $user->image }}" alt="image">
            </div>

            <p><strong>Email: </strong> {{$user->email}}</p>


            <a href="/profile/edit" class="btn btn-primary">Edit Profile</a>
        </div>
    </div>
</div>
@endsection