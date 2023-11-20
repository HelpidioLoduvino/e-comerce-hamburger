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
        <div class="col-sm-12 col-md-6 mb-3">
            <div class="card-white card mx-auto" style="max-width: 18rem;">
                <div class="card-body text-center">
                    <span class="d-flex justify-content-center">
                        <img src="{{ asset('/img/grafico-vendas.png')}}" class="img-fluid rounded-start" width="200"
                            alt="...">
                    </span>
                    <h5 class="card-title mt-3">{{$statistics->sales}} VENDA(S)</h5>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6">
            <div class="card-white card mx-auto" style="max-width: 18rem;">
                <div class="card-body text-center">
                    <span class="d-flex justify-content-center">
                        <img src="{{ asset('/img/grafico-subida.png')}}" class="img-fluid rounded-start" width="200"
                            alt="...">
                    </span>
                    <h5 class="card-title mt-3">{{$statistics->clients}} CLIENTE(S)</h5>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container mt-3 mb-3">
    <div class="d-flex">
        <h5 style="margin-right:10px;">FINANÇAS</h5>
        <select>
            <option>
                @php
                echo now()->year;
                @endphp
            </option>
        </select>
    </div>
    <div class="delimitador mt-3"></div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-active">
                    <thead>
                        <tr>
                            <th>Mês</th>
                            <td colspan="2">
                                @php
                                $month = now()->format('m');
                                @endphp
                                {{$month}}
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @if(!empty($total_month))

                            <th>Total</th>
                            <td colspan="2">
                                {{$total_month}},00 AOA

                            </td>

                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection