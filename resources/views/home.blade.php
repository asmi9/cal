@extends('layouts.userLayout')

@section('content')
<div id="exTab3" class="container">
    <ul class="nav nav-pills">
        <li class="active">
            <a href="#1b" data-toggle="tab">RD</a>
        </li>
        <li><a href="#2b" data-toggle="tab">RELOAD</a>
        </li>
        <li><a href="#3b" data-toggle="tab">SIM</a>
        </li>
    </ul>

    <div class="tab-content clearfix">
        <div class="tab-pane active" id="1b">
            <form id="card" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Target</label>
                    <input type="text" placeholder="Enter Your Target" class="form-control text" value="{{($rd != Null ? $rd->target : 0)}}" name="target" id="target" style="font-size: 22px;font-weight: 900;" a-describedby="emailHelp" disabled>

                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Achievements</label>
                    <input type="text" placeholder="Enter Your Achievements" name="achievements" class="form-control" style="font-size: 22px;font-weight: 900;" id="achievements">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Days</label>
                    <input type="text" placeholder="Enter Your Days" name="days" class="form-control" value="{{$balancedate}}" style="font-size: 22px;font-weight: 900;" id="days" disabled>
                </div>
                <input name="submit" class="bg-success" type="submit" value="Submit">
            </form><br><br>
            <div id="alert">

            </div>
        </div>
        <div class="tab-pane" id="2b">
            <form id="sim">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Target</label>
                    <input type="text" class="form-control" name="target" id="target" placeholder="Enter Your Target" value="{{($reload != Null ? $reload->target : 0)}}" style="font-size: 22px;font-weight: 900;" aria-describedby="emailHelp" disabled>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Achievements</label>
                    <input type="text" name="achievements" class="form-control" placeholder="Enter Your Achievements" style="font-size: 22px;font-weight: 900;" id="achievements">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Days</label>
                    <input type="text" name="days" placeholder="Enter Your Days" class="form-control" value="{{$balancedate}}" style="font-size: 22px;font-weight: 900;" id="days" disabled>

                </div>
                <input name="submit" class="bg-success" type="submit" value="Submit">
            </form><br><br>
            <div id="alert2">

            </div>
        </div>
        <div class="tab-pane" id="3b">
            <form id="reload">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Target</label>
                    <input type="text" class="form-control" name="target" id="target" placeholder="Enter Your Target" value="{{($sim != Null ? $sim->target : 0)}}" style="font-size: 22px;font-weight: 900;" aria-describedby="emailHelp" disabled>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Achievements</label>
                    <input type="text" name="achievements" class="form-control" placeholder="Enter Your Achievements" style="font-size: 22px;font-weight: 900;" id="achievements">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Days</label>
                    <input type="text" name="days" placeholder="Enter Your Days" class="form-control" value="{{$balancedate}}" style="font-size: 22px;font-weight: 900;" id="days" disabled>
                </div>
                <input name="submit" class="bg-success" type="submit" value="Submit">
            </form><br><br>
            <div id="alert3">

            </div>
        </div>

    </div>
</div>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }

        });
        $('#card').submit(function(event) {
            $("#alert").empty();
            var formData = {
                'target': $(this).closest('form').find('input[name=target]').val(),
                'achievements': $(this).closest('form').find('input[name=achievements]').val(),
                'days': $(this).closest('form').find('input[name=days]').val()

            };
            $.ajax({
                type: 'POST',
                url: 'rd',
                data: formData,
                dataType: 'json',
                encode: true
            })
            .done(function(data) {
                    if($.isEmptyObject(data.error)){
                       var  data=data.data;
                        $("#alert").append('<div class="alert alert-primary" role="alert"><p>Percentage = '+data.percentage+'%</p></div><div class="alert alert-danger" role="alert"><p>Balance = '+data.balance+'</p></div><div class="alert alert-danger" role="alert"><p>Day Target = '+data.daytarget+'</p></div>');
                    }else{
                       $("#alert").append('<div class="alert alert-danger" role="alert"><p>Percentage = ' + data.error + '%</p></div>')
                    }
                });

            event.preventDefault();
        });

    });

    $(document).ready(function() {
        $('#sim').submit(function(event) {
            $("#alert2").empty();
            var formData = {
                'target': $(this).closest('form').find('input[name=target]').val(),
                'achievements': $(this).closest('form').find('input[name=achievements]').val(),
                'days': $(this).closest('form').find('input[name=days]').val()
            };
           $.ajax({
                type: 'POST',
                url: 'reload',
                data: formData,
                dataType: 'json',
                encode: true
            })
            .done(function(data) {
                    if($.isEmptyObject(data.error)){
                         var  data=data.data;
                        $("#alert2").append('<div class="alert alert-primary" role="alert"><p>Percentage = '+data.percentage+'%</p></div><div class="alert alert-danger" role="alert"><p>Balance = '+data.balance+'</p></div><div class="alert alert-danger" role="alert"><p>Day Target = '+data.daytarget+'</p></div>');
                    }else{
                       $("#alert2").append('<div class="alert alert-danger" role="alert"><p>Percentage = ' + data.error + '%</p></div>')
                    }
                });

            event.preventDefault();
        });

    });
    $(document).ready(function() {
        $('#reload').submit(function(event) {
            $("#alert3").empty();
            var formData = {
                'target': $(this).closest('form').find('input[name=target]').val(),
                'achievements': $(this).closest('form').find('input[name=achievements]').val(),
                'days': $(this).closest('form').find('input[name=days]').val()
            };
           $.ajax({
                type: 'POST',
                url: 'sim',
                data: formData,
                dataType: 'json',
                encode: true
            })
            .done(function(data) {
                    if($.isEmptyObject(data.error)){
                        var  data=data.data;
                        $("#alert3").append('<div class="alert alert-primary" role="alert"><p>Percentage = '+data.percentage+'%</p></div><div class="alert alert-danger" role="alert"><p>Balance = '+data.balance+'</p></div><div class="alert alert-danger" role="alert"><p>Day Target = '+data.daytarget+'</p></div>');
                    }else{
                       $("#alert3").append('<div class="alert alert-danger" role="alert"><p>Percentage = ' + data.error + '%</p></div>')
                    }
                });

            event.preventDefault();
        });

    });
</script>

<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> -->

@endsection