@extends('layouts.userLayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Please Wait For Admin Approvel') }}</div>

                <div class="card-body">
                    {{ __('When Your Account is Verified We Will Send You A Email.') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection