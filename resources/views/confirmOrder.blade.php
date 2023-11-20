@extends('main')

@section('content')
<h5 class="letra card-title mt-3">DETALHES DO PEDIDO</h5>
<div class="home-line"></div>
@foreach($orders as $order)
<div class="card card-body mt-3 mb-3">
    <h6>ID DO PEDIDO:</h6>
    <h7>{{$order->id}}</h7>
    <hr>
    <h6>PRODUTO(S):</h6>
        <h7>
        @foreach($items as $item)
        {{$item->product_name}} - unidade: {{$item->quantity}} <br>
        @endforeach
        </h7>
    <hr>
    <h6>TOTAL A PAGAR:</h6>
    <h7>{{$order->total}}</h7>
    <hr>
    <h6>METODO DE PAGAMENTO:</h6>
    <h7> {{$order->payment_method}}</h7>
    <hr>
    <h6>DATA:</h6>
    <h7> {{$order->date}}</h7>
</div>
@endforeach

<div class="card card-body" style="max-width:18rem;">
    <div class="d-flex">
        <form method="post" action="/confirm-order/{{session('id')}}">
            @csrf
            @foreach($items as $item)
            <input type="hidden" name="product_id[]" value="{{$item->product_id}}">
            <input type="hidden" name="quantity[]" value="{{$item->quantity}}">
            @endforeach
            <input type="hidden" name="total" value="{{$order->total}}">
            <input type="hidden" name="payment_method" value="{{$order->payment_method}}">
            <input type="hidden" name="confirm_order_id" value="{{$order->id}}">
            <input type="submit" class="btn btn-success m-2" value="Confirmar">
        </form>
        
        <form method="post" action="/cart/{{session('id')}}">
            @csrf
            <input type="submit" class="btn btn-danger m-2" value="Cancelar">
        </form>
    </div>
</div>




@endsection