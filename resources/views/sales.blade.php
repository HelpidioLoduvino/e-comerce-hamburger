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
    <h5>TABELA DE VENDAS</h5>
    <div class="delimitador"></div>
    <div class="table-responsive">
        <table class="table table-bordered border-primary table-sm mt-3">
            <thead>
                <tr>
                    <th>CLIENTE</th>
                    <th>PRODUTO/qtd</th>
                    <th>TOTAL</th>
                    <th>PAGAMENTO</th>
                    <th>DATA PEDIDO</th>
                    <th>DATA ENTREGA</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($sales))
                @foreach($sales as $sale)
                <tr>
                    <td>{{$sale[0]->name}} {{$sale[0]->surname}}</td>

                    <td>
                        @foreach($sale as $product)
                        {{$product->quantity}} - {{$product->product_name}} <br>
                        @endforeach
                    </td>

                    <td>{{$sale[0]->total}}</td>

                    <td>{{$sale[0]->payment_method}}</td>

                    <td>{{$sale[0]->order_date}}</td>

                    <td>{{$sale[0]->created_at}}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>

</div>
@endsection