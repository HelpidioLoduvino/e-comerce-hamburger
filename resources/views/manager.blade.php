@extends('mainAdmin')

@section('order-qty')
<span id="order-qty">
    @if(!empty($sum))
    ({{$sum}})
    @endif
</span>
@endsection

@section('content')
<div class="container mb-3">
    <h5>ESTATÍSTICAS</h5>
    <div class="delimitador"></div>
</div>
<div class="container d-flex justify-content-center">
    <div class="row">
        <div class="col">
            <div class="card-white card" style="max-width: 18rem;">
                <div class="card-body">
                    <span class="d-flex justify-content-center">
                        <img src="{{ asset('/img/grafico-vendas.png')}}" class="img-fluid rounded-start" width="200"
                            alt="...">
                    </span>
                    <h5 class="card-title mt-3 d-flex justify-content-center">{{$statistics->sales}} VENDA(S)</h5>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card-white card" style="max-width: 18rem;">
                <div class="card-body">
                    <span class="d-flex justify-content-center">
                        <img src="{{ asset('/img/grafico-subida.png')}}" class="img-fluid rounded-start" width="200"
                            alt="...">
                    </span>
                    <h5 class="card-title mt-3 d-flex justify-content-center">{{$statistics->clients}} CLIENTE(S)</h5>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="container mt-3 mb-3">
    <div class="d-flex m-3">
        <h5 style="margin-right:10px;">FINANÇAS</h5>
        <select>
            <option>
                @php
                echo now()->year;
                @endphp
            </option>
        </select>
    </div>
    <div class="delimitador"></div>
</div>

<div class="container">
    <table class="table table-bordered table-active">
        <thead>
            <tr>
                <th>Jan</th>
                <th>Fev</th>
                <th>Mar</th>
                <th>Abr</th>
                <th>Mai</th>
                <th>Jun</th>
                <th>Jul</th>
                <th>Ago</th>
                <th>Set</th>
                <th>Out</th>
                <th>Nov</th>
                <th>Dez</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @if(!empty($total_month))
                @for($i = 1; $i <= 12; $i++) 
                <td>
                    @php
                    $month = now()->format('m');
                    @endphp

                    @if($month == $i)
                    {{$total_month}},00 AOA
                    @endif
                </td>
                @endfor
                @endif
            </tr>
        </tbody>
    </table>

</div>
@endsection