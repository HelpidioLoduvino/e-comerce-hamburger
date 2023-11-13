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
    <h5>TABELA DE ENCOMENDAS</h5>
    <div class="delimitador"></div>
    <table class="table table-bordered border-primary table-sm mt-3">
        <thead>
            <tr>
                <th>ID PEDIDO</th>
                <th>CLIENTE</th>
                <th>CONTACTO</th>
                <th>PAGAMENTO</th>
                <th>TOTAL</th>
                <th>ESTADO</th>
                <th>DATA</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($orders))
            @foreach($orders as $order)
            <tr>
                <td>{{$order[0]->id}}</td>
                <td>{{$order[0]->name}} {{$order[0]->surname}}</td>
                <td>{{$order[0]->contact}}</td>
                <td>{{$order[0]->payment_method}}</td>
                <td>{{$order[0]->total}} AOA</td>
                <td>{{$order[0]->status}}</td>
                <td>{{$order[0]->date}}</td>
                <td>
                    @if(trim($order[0]->status) === 'PENDENTE')
                    <form method="post" action="/order/accept-order/{{$order[0]->id}}">
                        @csrf

                        <input type="submit" class="btn btn-success" value="ACEITAR">
                    </form>

                    @elseif(trim($order[0]->status =='EM ANDAMENTO'))
                    <form method="post" action="/order/finish-order/{{$order[0]->id}}">
                        @csrf
                        <input type="submit" class="btn btn-success" value="CONCLUIR">
                    </form>

                    @else(trim($order[0]->status =='CONCLUIDO'))
                    <form method="post" action="/store-sale/{{$order[0]->id}}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{$order[0]->user_id}}">
                        <input type="hidden" name="total" value="{{$order[0]->total}}">
                        <input type="hidden" name="payment_method" value="{{$order[0]->payment_method}}">
                        <input type="hidden" name="order_date" value="{{$order[0]->date}}">
                        @foreach($order as $item)
                        <input type="hidden" name="product_id[]" value="{{$item->product_id}}">
                        <input type="hidden" name="quantity[]" value="{{$item->quantity}}">
                        @endforeach
                        <input type="submit" class="btn btn-success" value="PAGO">
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h5>PRODUTO</h5>
    <div class="delimitador"></div>

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