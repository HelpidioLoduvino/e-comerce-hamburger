@extends('mainAdmin')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="profile-frame">
        <br><br><br><br><br>
        <div class="d-flex justify-content-center">
            <img src="{{asset('/img/profile.png')}}" class="d-block mb-3 mt-3" height="100">
        </div>
        <h5 class="card-title d-flex justify-content-center">Nome: {{$user->name}}</h5>
        <h5 class="card-title d-flex justify-content-center">Sobrenome: {{$user->surname}}</h5>
        <h5 class="card-title d-flex justify-content-center">Email: {{$user->email}}</h5>
        <br><br><br><br><br>
    </div>

</div>

@endsection