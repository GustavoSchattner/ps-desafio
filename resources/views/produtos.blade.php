@extends('estilos.modelo')
@section('produtos')


<div id="produtosid">
    @foreach ($produtos as $produto)
          <ul>
            <li><h3 id="nome-produto">{{ $produto->nome }}</h3></li>
            <li><h5>Categoria: {{ $produto->categoria()->pluck('categoria')->first() }}</h5></li>
            <li><h5>R${{ $produto->preco }}</h5></li>
            <li><h5>Descrição: {{ $produto->descricao }}</h5></li>
            @if($produto->quantidade <= 0)
              <li><h5 id="esgotado">Esgotado</h5></li>
            @else
              <li><h5>Estoque: {{ $produto->quantidade }}</h5></li>
            @endif
            <li><img id="imagem-produto" src="/storage/{{ $produto->imagem }}" alt="Imagem de {{ $produto->nome }} "></h3></li>
          </ul>
    @endforeach
  </div>
@endsection
