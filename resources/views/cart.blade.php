@extends('main')

@section('content')
@php
$total = 0;
@endphp

@foreach($cartProducts as $cartProduct)
<div class="card mb-3 mt-3">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ asset('/img/bdImages/'. $cartProduct->image) }}" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{$cartProduct->name}}</h5>
                <p class="card-text">{{$cartProduct->price}} AOA</p>
                <p class="card-text"><small class="text-muted">{{$cartProduct->description}}</small></p>
                <div class="d-flex">
                    <form method="post" action="/cart/delete-product/{{$cartProduct->id}}/{{session('id')}}">
                        @csrf
                        <button type="submit" class="btn btn-danger" style="margin-right: 10px;">
                            <img src="{{asset('/img/trash.png')}}" width="20" height="20">
                        </button>
                    </form>
                    <form method="post" action="/cart/subtract-product-quantity/{{$cartProduct->id}}/{{session('id')}}">
                        @csrf
                        <input type="submit" class="btn btn-dark" value="-">
                    </form>
                    <p class="card-text m-2">{{$cartProduct->quantity}}</p>
                    <form method="post" action="/cart/add-product-quantity/{{$cartProduct->id}}/{{session('id')}}">
                        @csrf
                        <input type="submit" class="btn btn-dark" value="+">
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@php
$total += $cartProduct->quantity * $cartProduct->price;
@endphp

@endforeach
<div class="card card-body" style="max-width: 540px;">
    <form method="post" action="/cart/order/{{session('id')}}">
        @csrf
        <h3 style="color:green;">TOTAL: {{$total}}.00 AOA </h3>
        <input type="hidden" name="total" value="{{$total}}">
        <hr>
        <h7>Método de Pagamento:</h7>
        <div>
            <input type="checkbox" name="payment_method" id="payment_method" value="PAGAR NA ENTREGA">
            <label>PAGAR NA ENTREGA</label><br>
            <input type="checkbox" name="payment_method" id="payment_method" value="TRANSFÊNCIA BANCÁRIA">
            <label>PAGAR POR TRANSFÊRENCIA BANCÁRIA</label>
        </div>
        <button type="submit" class="btn btn-success" id="confirm_button" name="confirm_button">Confirmar</button>
        <hr>
        <small id="paymentWarning" style="color:red;">É necessário escolher um método de pagamento para confirmar o pedido.</small>
    </form>
</div>

<script>
const checkboxes = document.querySelectorAll('input[name="payment_method"]');
const confirmButton = document.getElementById('confirm_button');
const paymentWarning = document.getElementById('paymentWarning');

checkboxes.forEach((checkbox) => {
    checkbox.addEventListener('change', function() {
        checkboxes.forEach((otherCheckbox) => {
            if (otherCheckbox !== this) {
                otherCheckbox.checked = false;
            }
        });

        if (isChecked(checkboxes)) {
            confirmButton.disabled = false;
            paymentWarning.style.display = 'none';
        } else {
            confirmButton.disabled = true;
            paymentWarning.style.display = 'block';
        }
    });
});

function isChecked(checkboxes) {
    for (const checkbox of checkboxes) {
        if (checkbox.checked) {
            return true;
        }
    }
    return false;
}
</script>


@endsection