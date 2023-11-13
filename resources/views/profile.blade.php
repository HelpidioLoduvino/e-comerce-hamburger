@extends('main')

@section('content')
<div class="container d-flex justify-content-center">

    <div class="card-profile mt-3" style="width:40rem;">

        <div class="d-flex justify-content-center mt-3 mb-3">
            <img src="{{asset('/img/profile.png')}}" alt="" height="200">
        </div>

        <h5 class="card-text d-flex justify-content-center">{{$user->name}} {{$user->surname}}</h5>
        <h5 class="card-text d-flex justify-content-center">{{$user->email}}</h5>
        <h5 class="card-text d-flex justify-content-center">{{$user->contact}}</h5>

        <div class="d-flex justify-content-center mb-3">
            <a class="btn btn-dark" id="letra" data-bs-toggle="modal" data-bs-target="#editUserModal">Editar</a>
        </div>

        <div class="d-flex justify-content-center">
            <form method="POST" action="/profile/logout">
                @csrf
                <input type="submit" class="btn  btn-danger mb-3" id="letra" value="Logout">
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>REGISTRO</h5>
            </div>
            <div class="modal-body">
                <form action="/main/register" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="client">

                    <div class="mb-3">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nome">
                    </div>

                    <div class="mb-3">
                        <input type="text" name="surname" id="surname" class="form-control" placeholder="Sobrenome">
                    </div>

                    <div class="mb-3">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                    </div>

                    <div class="mb-3">
                        <input type="number" name="contact" id="contact" class="form-control" placeholder="Contacto">
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Palavra-Passe">
                    </div>

                    <div class="mb-3">
                        <input type="submit" class="btn btn-success" value="Registrar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex justify-content-center mb-3">
                    <img src="{{asset('/img/profile.png')}}" alt="" width="100" height="100">
                </div>
                <form action="/update-profile/{{session('id')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" value="{{$user->name}}">
                    </div>

                    <div class="mb-3">
                        <input type="text" name="surname" class="form-control" value="{{$user->surname}}">
                    </div>

                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" value="{{$user->email}}">
                    </div>

                    <div class="mb-3">
                        <input type="number" name="contact" class="form-control" value="{{$user->contact}}">
                    </div>

                    <div class="mb-3">
                        <input type="submit" class="btn btn-outline-dark" value="Editar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection