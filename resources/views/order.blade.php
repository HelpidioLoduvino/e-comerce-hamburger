@extends('main')

@section('content')

@foreach($orders as $order)
<div class="card mb-3 mt-3">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ asset('/img/bdImages/'. $order->image )}}" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{$order->product_name}}</h5>
                <p class="card-text">Preco: {{$order->price}}</p>
                <p class="card-text">Unidade: {{$order->quantity}}</p>
                <p class="card-text"><small class="text-muted">{{$order->description}}</small></p>
            </div>
        </div>
    </div>
</div>

@endforeach

<div class="card card-body" style="max-width: 540px;">
    <h3 style="color:green;">TOTAL: {{$order->total}}</h3>
    <h6>ESTADO DA ENCOMENDA: {{$order->status}}</h6>
    <h6>METODO DE PAGAMENTO: {{$order->payment_method}}</h6>
    <h6>DATA: {{$order->date}}</h6>
</div>

@endsection