<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
</head>

<body class="admin-body">

    <nav class="admin-navbar navbar navbar-expand-md navbar-light">

        <button class="toggle-btn navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarNav"
            aria-controls="sidebarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="sidebarNav">

            <div class="sidebar d-md-none">

                <div class="close-btn mb-3">
                        <a href="#" class="btn btn-close d-md-none" data-bs-toggle="collapse"
                            data-bs-target="#sidebarNav" aria-controls="sidebarNav" aria-expanded="false"
                            aria-label="Close sidebar">
                        </a>
    

                </div>

                <ul>
                    <li>
                        <a href="#">LOGO</a>
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

        <div class="ms-auto">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/profile/{{session('id')}}" style="margin-right:20px;">
                        <img src="{{ asset('/img/profile.png') }}" width="40" height="35">
                    </a>
                </li>
            </ul>
        </div>

    </nav>


    <div class="row">
        <div class="col-md-2">
            <div class="sidebar d-none d-md-block">
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
            <div class="content">
                <main class="mt-3">
                    <div class="container">
                        <div class="row">
                            @if(session('msg'))
                            <div class="container">
                                <div class="msg-div">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <p class="msg d-flex justify-content-center">{{session('msg')}}</p>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="/bootstrap/jquery/jquery.min.js"></script>

</body>

</html>