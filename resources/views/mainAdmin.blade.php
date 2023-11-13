<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{asset('/font/fontawesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/fontawesome.min.js" rel="stylesheet">
</head>

<body class="admin-body">
    <nav class="admin-navbar navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand"></a>

        </div>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/profile/{{session('id')}}">
                    <img src="{{asset('/img/profile.png')}}" alt="" width="35" height="30">
                </a>
            </li>
        </ul>
    </nav>
    <div class="row">
        <div class="col-md-2">
            <div class="sidebar">
                <ul>
                    <li>
                        <a class="navbar-brand">
                            LOGO
                        </a>
                    </li>
                    <div class="delimitador container">
                    </div>
                    <br>
                    <li>
                        <a href="/view/home">Home</a>
                    </li>
                    <div class="container">
                        <hr>
                    </div>
                    <li>
                        <a href="/view/order">
                            Encomendas 
                            @yield('order-qty')
                        </a>
                    </li>
                    <div class=" container">
                        <hr>
                    </div>
                    <li>
                        <a data-bs-toggle="collapse" href="#sellOption" role="button" aria-expanded="false"
                            aria-controls="collapseExample">
                            Vendas
                        </a>
                        <div class="collapse" id="sellOption">
                            <ul>
                                <li class="nav-item"><a class="nav-link" href="/view/add-product">Adicionar</a></li>
                                <li class="nav-item"><a class="nav-link" href="/view/show-sales">Ver</a></li>
                            </ul>
                        </div>
                    </li>
                    <div class=" container">
                        <hr>
                    </div>
                    <li><a href="/view/publicity">Publicidades</a></li>
                    <div class=" container">
                        <hr>
                    </div>
                    <li>
                        <a data-bs-toggle="collapse" href="#entityOption" role="button" aria-expanded="false"
                            aria-controls="collapseExample">
                            Entidades
                        </a>
                        <div class="collapse" id="entityOption">
                            <ul>
                                <li class="nav-item"><a class="nav-link" href="/view/show-client">Clientes</a></li>
                                <li class="nav-item"><a class="nav-link" href="/view/show-product">Produtos</a></li>
                            </ul>
                        </div>
                    </li>
                    <div class="delimitador container">
                    </div>
                    <br>
                    <form method="post" action="/profile/logout">
                        @csrf
                        <li>
                            <input type="submit" class="btn btn-danger" value="Logout">
                        </li>
                    </form>
                </ul>
            </div>
        </div>

        <div class="col">
            <main class="mt-3">
                @if(session('msg'))
                <div class="container">
                    <div class="msg-div">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <p class="msg d-flex justify-content-center">{{session('msg')}}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>

    <script src="{{asset('/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/bootstrap/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('/font/fontawesome.min.js')}}"></script>
</body>

</html>