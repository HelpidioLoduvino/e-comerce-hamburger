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
    <h5>ADICIONE UM PRODUTO</h5>
    <div class="delimitador"></div>
    <div class="card-white mt-3 d-flex justify-content-center" >
        <form method="post" action="/add-product" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3 mt-3">
                <input type="text" class="form-control" name="product_name" placeholder="Nome do Produto">
            </div>
            <div class="form-group mb-3">
                <textarea type="text" class="form-control" name="description"
                    placeholder="Descrição do Produto"></textarea>
            </div>
            <div class="form-group mb-3">
                <input type="number" class="form-control" name="price" step="0.01" min="0.01"
                    placeholder="Preço do Produto">
            </div>
            <div class="form-group mb-3">
                <input type="file" accept="image/*" name="image">
            </div>
            <div class="form-group mb-3">
                <span class="d-flex justify-content-center">
                    <input type="submit" class="btn btn-success" value="Adicionar">
                </span>
            </div>
        </form>
    </div>

</div>

@endsection