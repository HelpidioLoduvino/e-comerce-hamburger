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
    <h5>TABELA DOS CLIENTES</h5>
    <div class="delimitador mb-3"></div>
    <table class="table table-bordered table-active">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>SOBRENOME</th>
                <th>EMAIL</th>
                <th>CONTACTO</th>
            </tr>
        </thead>
        @foreach ($clients as $client)
        <tbody>
            <tr>
                <td>{{$client->id}}</td>
                <td>{{$client->name}}</td>
                <td>{{$client->surname}}</td>
                <td>{{$client->email}}</td>
                <td>{{$client->contact}}</td>
            </tr>
        </tbody>
        @endforeach
    </table>
</div>
@endsection