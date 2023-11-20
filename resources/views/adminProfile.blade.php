@extends('mainAdmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 profile-frame">
            <div class="d-flex justify-content-center">
                <img src="{{asset('/img/profile.png')}}" class="d-block mb-3 mt-3" height="100">
            </div>
            <h5 class="card-title text-center">Nome: {{$user->name}}</h5>
            <h5 class="card-title text-center">Sobrenome: {{$user->surname}}</h5>
            <h5 class="card-title text-center">Email: {{$user->email}}</h5>
        </div>
    </div>
</div>


@endsection