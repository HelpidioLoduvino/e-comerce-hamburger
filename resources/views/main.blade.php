<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="client-body">
    <nav class="myNavbar navbar navbar-expand">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="{{asset('/img/logo.png')}}" alt="" width="40" height="35">
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    @if (session('type'))
                    <li class="nav-item">
                        <a class="link-color" href="/order/{{session('id')}}">Encomendas</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="link-color" data-bs-toggle="modal" data-bs-target="#loginModal">
                        Encomendas
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
            <ul class="navbar-nav">
                @if(session('type'))
                <li class="nav-item">
                    <a class="link-color nav-link" href="/cart/{{session('id')}}">
                        <img src="{{asset('/img/cart.png')}}" alt="" width="40" height="35">
                        @yield('cart-count')
                    </a>
                </li>
                @endif
                @if(!session('type'))
                <li class="nav-item">
                    <a class="link-color" data-bs-toggle="modal" data-bs-target="#loginModal" style="margin-right:10px;">
                        Entrar
                    </a>
                </li>
                <li class="nav-item">
                    <a class="link-color" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Registrar-se
                    </a>
                </li>
                @endif
                @if(session('type'))
                <li class="nav-item">
                    <a class="link-color nav-link" href="/my-profile/{{ session('id')}}">
                        <img src="{{asset('/img/profile.png')}}" alt="" width="40" height="35">
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </nav>

    <main>
        <div class="container">
            <div class="row">
                @if(session('msg'))
                <div class="alert alert-light alert-dismissible fade show" role="alert">
                    <p class="msg d-flex justify-content-center">{{session('msg')}}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @yield('content')
            </div>
        </div>
    </main>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>REGISTRO</h5>
                </div>
                <div class="modal-body">
                    <form action="/register" method="POST">
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
                            <input type="number" name="contact" id="contact" class="form-control"
                                placeholder="Contacto">
                        </div>

                        <div class="mb-3">
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Palavra-Passe">
                        </div>

                        <div class="mb-3">
                            <input type="password" name="confirm_password" id="password" class="form-control"
                                placeholder="Confirmar Palavra-Passe">
                        </div>

                        <div class="mb-3">
                            <input type="submit" class="btn btn-success" value="Registrar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-center mb-3">
                        <img src="{{asset('/img/profile.png')}}" alt="" width="100" height="100">
                    </div>
                    <form action="/login" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                        </div>

                        <div class="mb-3">
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Palavra-Passe" required>
                        </div>

                        <div class="mb-3">
                            <input type="submit" class="btn btn-success" value="Entrar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="mt-3">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>Pedido</th>
                    <th>Ajuda</th>
                    <th>Perfil</th>
                    <th>Logo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a class="link-color" href="#">Encomendas</a></td>
                    <td><a class="link-color" href="#">Métodos de Pagamento</a></td>
                    @if(session('id'))
                    <td><a class="link-color" href="/my-profile/{{session('id')}}">Meu Perfil</a></td>
                    @else
                    <td><a class="link-color" href="#">Meu Perfil</a></td>
                    @endif
                    <td><a class="link-color" href="#">Sobre Nós</a></td>
                </tr>

                <tr>
                    <td><a class="link-color" href="#">Menu</a></td>
                    <td><a class="link-color" href="#">Entregas</a></td>
                    <td><a class="link-color" href="#"></a></td>
                    <td><a class="link-color" href="#">Termos e Condições</a></td>
                </tr>

                <tr>
                    <td><a class="link-color" href="#">Carrinho</a></td>
                    <td><a class="link-color" href="#">Dê uma ideia</a></td>
                    <td><a class="link-color" href="#"></a></td>
                    <td><a class="link-color" href="#">Políticas de Privacidade</a></td>
                </tr>
            </tbody>
        </table>
        <div>
            @copyright Helpidio Mateus.
        </div>
    </footer>

    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="/bootstrap/jquery/jquery.min.js"></script>
</body>

</html>