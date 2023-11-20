@extends('main')

@section('content')

<div class="container">

    <h5 class="letra card-title mt-3">TABELA DE PEDIDO</h5>
    <div class="home-line"></div>

    <div class="table-responsive">
        <table class="table table-bordered mt-3 table-light">
            <thead>
                <tr>
                    <th>ID PEDIDO</th>
                    <th>TOTAL</th>
                    <th>ESTADO</th>
                    <th>METODO DE PAGAMENTO</th>
                    <th>DATA</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($orders))
                @foreach($orders as $order)
                <tr>
                    <td>{{$order[0]->id}}</td>
                    <td>{{$order[0]->total}}</td>
                    <td>{{$order[0]->status}}</td>
                    <td>{{$order[0]->payment_method}}</td>
                    <td>{{$order[0]->date}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <h5 class="letra card-title mt-3">PRODUTO</h5>
    <div class="home-line"></div>

    @foreach($orders as $order)
    @foreach($order as $item)
    <div class="card-white card mb-3 mt-3">
        <div class="row g-0">
            <div class="col">
                <img src="{{ asset('/img/bdImages/' . $item->image)}}" class="img-fluid rounded-start" width="200"
                    alt="...">
            </div>
            <div class="col-md-10">
                <div class="card-body">
                    <h5>ID DO PEDIDO: {{$order[0]->id}}</h5>
                    <h7 class="card-title">{{ $item->product_name }}</h7><br>
                    <h7 class="card-title">Unidade: {{ $item->quantity }}</h7>
                    <p class="card-text"><small class="text-muted">{{ $item->description }}</small></p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endforeach
    @endif

</div>

@endsection