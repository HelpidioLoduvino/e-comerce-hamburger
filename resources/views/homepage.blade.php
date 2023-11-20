@extends('main')

@if(session('type'))
@section('cart-count')
<span class="letra"><small>{{$sum}}</small></span>
@endsection
@endif

@section('content')
<div class="container mt-2">
<div id="carouselExampleInterval" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="2000">
            <img src="{{asset('/img/logo.png')}}" class="d-block w-100" alt="..." style="transform: rotate(12deg)">
        </div>
        <div class="carousel-item d-flex justify-content-center" data-bs-interval="2000">
            <img src="{{asset('/img/logo.png')}}" class="d-block w-100" style="transform: rotate(25deg)">
        </div>
        <div class="carousel-item d-flex justify-content-end" data-bs-interval="2000">
            <img src="{{asset('/img/logo.png')}}" class="d-block w-100" alt="...">
        </div>
    </div>
</div>

</div>

<h5 class="letra card-title mt-3">MENU</h5>
<div class="home-line"></div>

<div class="d-flex justify-content-center mt-3">
    <div class="row">
        @foreach($products as $product)
        <div class="col">
            <div class="card mb-3 mx-auto" style="width: 18rem;">
                <img src="{{ asset('/img/bdImages/'. $product->image) }}" class="myImg card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$product->product_name}}</h5>
                    <p class="card-text">{{$product->price}} AOA</p>
                    <p class="card-text"> <small>{{$product->description}}</small></p>
                    @if(session('id'))
                    <form method="POST" action="/add-to-cart/{{$product->id}}/{{session('id')}}">
                        @csrf
                        <span class="d-flex justify-content-center">
                            <input type="submit" class="btn btn-success" value="ADICIONAR">
                        </span>
                    </form>
                    @else
                    <span class="d-flex justify-content-center">
                        <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#loginModal">
                            ADICIONAR
                        </a>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="d-flex justify-content-center">
    <a class="more" href="/view/show-all-products">...</a>
</div>

<h5 class="letra card-title mt-3">NOVIDADES</h5>
<div class="home-line"></div>
<div id="carouselExampleCaptions" class="carousel slide mt-3" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach($publicities as $index => $publicity)
            <div class="carousel-item {{$index === 0 ? 'active' : ''}} d-flex justify-content-center">
                <img src="{{asset('/img/bdImages/'. $publicity->img)}}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{$publicity->title}}</h5>
                    <p>{{$publicity->pub_description}}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>

<h5 class="letra card-title mt-3">ENTRE EM CONTACTO</h5>
<div class="home-line"></div>
<div class="d-flex justify-content-end mt-3">
    <div class="row">
        <div class="col">
            <a class="btn btn-outline-success" href="https:/wa.me/944459953" target="_blank">
                <img src="{{asset('/img/whatsapp-logo.png')}}" width="15" height="15">
            </a>
        </div>
        <div class="col">
            <a class="btn btn-outline-primary" href="https:/www.facebook.com/sua_pagina" target="_blank">
                <img src="{{asset('/img/facebook-logo.png')}}" width="15" height="15">
            </a>
        </div>
        <div class="col">
            <a class="btn btn-outline-danger" href="https:/www.instagram.com/sua_pagina" target="_blank">
                <img src="{{asset('/img/instagram-logo.png')}}" width="15" height="15">
            </a>
        </div>
    </div>
</div>
@endsection