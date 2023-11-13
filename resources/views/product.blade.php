@extends('mainAdmin')

@section('order-qty')
<span id="order-qty">
    @if(!empty($sum))
    ({{$sum}})
    @endif
</span>
@endsection

@section('content')
<div class="container">
    <h5>PRODUTOS</h5>
    <div class="delimitador mb-3"></div>
    @if(!empty($products))
    @foreach($products as $product)
    <div class="card-white card mb-3 mt-3">
        <div class="row g-0">
            <div class="col">
                <img src="{{ asset('/img/bdImages/' . $product->image)}}" class="img-fluid rounded-start" width="200"
                    alt="...">
            </div>
            <div class="col-md-10">
                <div class="card-body">
                    <h5>NOME: {{$product->product_name}}</h5>
                    <h6 class="card-title">ID: {{ $product->id }}</h6>
                    <p class="card-text">PREÇO: {{$product->price}} AOA</p>
                    <p class="card-text"><small class="text-muted">DESCRIÇÃO: {{ $product->description }}</small></p>
                    <div class="d-flex">
                        <button type="button" class="btn btn-primary edit-product" data-bs-toggle="modal"
                            data-bs-target="#exampleModal{{$product->id}}" data-product-id="{{ $product->id }}">
                            <img src="{{asset('/img/edit-icon.png')}}" width="20" height="20">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal{{$product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Produto</h5>
                </div>
                <div class="modal-body">
                    <form method="post" action="/edit-product/{{$product->id}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3 mt-3">
                            <input type="text" class="form-control" name="name" placeholder="Nome do Produto"
                                value="{{$product->product_name}}">
                        </div>
                        <div class="form-group mb-3">
                            <textarea type="text" class="form-control" name="description"
                                placeholder="Descrição do Produto">{{$product->description}}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <input type="number" class="form-control" name="price" step="0.01" min="0.01"
                                placeholder="Preço do Produto" value="{{$product->price}}">
                        </div>
                        <div class="form-group mb-3">
                            <input type="file" accept="image/*" name="image">
                        </div>
                        <div class="form-group mb-3">
                            <span class="d-flex justify-content-center">
                                <input type="submit" class="btn btn-success" value="Editar">
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>
@endsection