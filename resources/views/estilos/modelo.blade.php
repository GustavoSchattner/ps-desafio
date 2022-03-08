<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Produtos</title>
        <!-- Css para estilizar o Html -->
        <link rel="stylesheet" href="/material/css/estilo.css">
        <!-- Biblioteca de icones -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('fontawesome') }}/css/all.min.css">

</head>
<body class="corpo">
    <header>
        <nav>
            <div class="topnav">
                <a href="/produtos" id="nomenav"> <img id="logoicon" src="{{ asset('logo/logo.png') }}" alt="Logo Rancho da Serra">Rancho da Serra</a>
                <a href="/produtos" class="navlink">Início</a>
                <a href="/login" target="_blank" class="navlink">Painel de Controle</a>
                    <!--Filtro de Pesquisa e barra de busca -->
                <form action="{{ route('produtos') }}" method="get" class="formulario">
                <!-- Barra de Busca -->
                    <input type="text" name="nome" id="busca" value="{{ $nome }}" placeholder="Buscar Produto..."/>
                    <button type="submit" class="botao"><i class="fa fa-search"></i></button>
                    <!-- Filtro -->
                        <select name="categoria_id"  class="caixafiltro" onchange="this.form.submit()">
                            <option value="">Filtrar por Categoria</option>
                            @foreach ($categorias as $categoria)
                            <option value="{{$categoria->id}}" {{ $categoria->id == $categoria_id ? 'selected': ''}}>{{ $categoria->categoria }}</option>
                            @endforeach
                        </select>
                </form>
            </div>
            <!--Fim do Filtro de Pesquisa e barra de busca -->
        </nav>
    </header>
    <main>
        @yield('produtos')
    </main>
    <footer class="footer">
        <div class="rodape">
            <span class="textofooter">Feito com <i class="material-icons">favorite</i> por Adapti Soluções Web</span>
            <a href="https://www.facebook.com/AdaptiEmpresaJr" target="_blank" class="iconesredes">
                <i class="fa-brands fa-facebook-f"></i>
            </a>
            <a href="https://www.instagram.com/adaptiempresajr/" target="_blank" class="iconesredes">
                <i class="fa-brands fa-instagram"></i>
            </a>
            <a href="https://www.linkedin.com/company/adaptiempresajr/" target="_blank" class="iconesredes">
                <i class="fa-brands fa-linkedin-in"></i>
            </a>
        </div>
    </footer>
</body>
</html>
