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
    <h5>ADICIONE UMA PUBLICIDADE</h5>
    <div class="delimitador"></div>
    <div class="card-white card card-body mt-3 mb-3">
        <form method="post" action="/add-publicity" enctype="multipart/form-data">
            @csrf
            <div class="form-group mt-3 mb-3">
                <input type="text" name="title" class="form-control" placeholder="Titulo Da Publicacao">
            </div>

            <div class="form-group mb-3">
                <textarea name="pub_description" class="form-control" placeholder="Descricao da Publicacao"></textarea>
            </div>

            <div class="form-group mb-3">
                <input type="file" accept="image/*" class="form-control" name="img">
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-success mb-3" value="Publicar">
            </div>
        </form>

    </div>

    @if(!empty($publicity))
    <h5>TABELA DE PUBLICIDADES</h5>
    <div class="delimitador"></div>
    <div class="table-responsive">
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Imagem</th>
                    <th>Data</th>
                    <th>Apagar</th>
                </tr>
            </thead>

            @foreach($publicity as $post)
            <tbody>
                <tr>
                    <td>{{$post->title}}</td>
                    <td>{{$post->pub_description}}</td>
                    <td>
                        <img src="{{asset('/img/bdImages/'. $post->img)}}" class="d-block" height="30" alt="...">
                    </td>
                    <td>{{$post->date}}</td>
                    <td>
                        <form method="post" action="/delete-publicity/{{$post->id}}">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                <img src="{{asset('/img/trash.png')}}" width="20" height="20">
                            </button>
                        </form>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>

    @endif
</div>
@endsection