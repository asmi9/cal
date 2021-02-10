@extends('layouts.adminLayout')

@section('content')

<div class="container">
    <div class="row">
        <table class="table text-center">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Target</th>
                    <th scope="col">Achivement</th>
                    <th scope="col">Days</th>
                     <th scope="col">Controls</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr style="backgroundColor:#fff">
                    <td>{{$user->name}}</td>
                    <td>{{($user->target)?$user->target:0}}</td>
                    <td>{{($user->achivement)?$user->achivement:0}}</td>
                    <td>{{($user->days)?$user->days:0}}</td>
                    <td class="justify-content-center">
                        <!-- <a href={{"users/".$user->user_id}} class="btn btn-info btn-sm text-light">View</a> -->
                        <a href={{"/users/reloaddetails/change/".$user->user_id}} class="btn btn-success btn-sm text-light">Edit</a>
                        <form action="{{url('users/'.$user->user_id)}}" method="POST" style="display:inline-block">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            
                        </form>
                    </td>
                </tr>
                @empty
                <div class="display-3 text-center">No Users Available</div>
                @endforelse
            </tbody>
        </table>

    </div>

</div>
@endsection