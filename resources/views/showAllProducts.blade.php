@extends('main')

@section('content')
<div class="container">
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