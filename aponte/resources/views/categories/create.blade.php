<x-app-layout>

    <style>
        /* Adicione essas regras de estilo ou ajuste conforme necessário */
        #tabelaCategorias {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
    
        #tabelaCategorias th,
        #tabelaCategorias td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
    
        #tabelaCategorias th {
            background-color: #f2f2f2;
        }
    
        .excluirCategoria {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
        }
    
        .excluirCategoria:hover {
            background-color: #d32f2f;
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categorias') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4">Olá <strong>{{ Auth::user()->name }}</strong></p>
                </div>

                {{-- <div id="mensagem"></div> --}}

                {{-- <form action="{{ route('categories.store') }}" method="post"> --}}
                <form id="categoriaForm">
                    @csrf
                    <fieldset class="border-2 rounded p-6 ">
                        <legend>Cadastro de Categoria</legend>
                        <div class="bg-gray-100 p-4 rounded overflow-hidden">
                            <label for="name">Categoria</label>
                            <input type="text" name="name" id="name" class="w-full rounded required autofocus">
                        </div>

                        <div class="bg-gray-100 p-4 rounded overflow-hidden">
                           <input type="submit" value="Cadastrar" class="bg-green-600 text-white rounded p-2 cursor-pointer" style="background-color: rgb(79, 79, 163)">
                           <input type="reset" value="Limpar" class="bg-red-500 text-white rounded p-2 cursor-pointer">
                        </div>
                    </fieldset>
                </form>

            </div>

            <div id="mensagem"></div>

        <div class="relative overflow-x-auto">

            <table id="tabelaCategorias" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="text-base px-6 py-3 rounded-s-lg">Categoria</th>
                        <th scope="col" class="text-base px-6 py-3">Ações </th>
                    </tr>
                </thead>
                <tbody id="tbodyCategorias">
                    <!-- Aqui será adicionado dinamicamente o conteúdo da tabela -->
                </tbody>
            </table>

         
        </div>
        
    


</div>
</div>




<script>
    $(document).ready(function() {
        function carregarCategorias() {
            // Realiza uma requisição AJAX para obter as categorias atualizadas
            $.ajax({
                url: '{{ route("categories.index") }}',
                type: 'GET',
                success: function(response) {
                    // Limpa o conteúdo da tabela
                    $('#tbodyCategorias').empty();

                    // Adiciona dinamicamente as categorias à tabela
                    $.each(response.categorias, function(index, categoria) {
                        var row = '<tr>' +
                            '<td class="text-base">' + categoria.name + '</td>' +
                            '<td class="text-base">' +
                            '<button class="excluirCategoria" data-id="' + categoria.id + '">Excluir</button>' +
                            '</td>' +
                            '</tr>';
                        $('#tbodyCategorias').append(row);
                    });
                }
            });
        }

     

        // Cadastro de Categoria

        $('#categoriaForm').submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: '{{ route("categories.store") }}',
                type: 'POST',
                data: $('#categoriaForm').serialize(),
                success: function(response) {
                    $('#categoriaForm')[0].reset();
                    $('#mensagem').html('<p class="text-green-500">Categoria cadastrada com sucesso!</p>');
                    carregarCategorias();
                },
                error: function(error) {
                    var errors = error.responseJSON.errors;
                    var errorString = '<ul>';
                    $.each(errors, function(key, value) {
                        errorString += '<li class="text-red-500">' + value[0] + '</li>';
                    });
                    errorString += '</ul>';
                    $('#mensagem').html(errorString);
                }
            });
        });

        // Exclusão de Categoria
        $(document).on('click', '.excluirCategoria', function() {
            var categoriaId = $(this).data('id');

            $.ajax({
                url: '{{ url("categories") }}/' + categoriaId,
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    $('#mensagem').html('<p class="text-green-500">Categoria excluída com sucesso!</p>');
                    carregarCategorias();
                },
                error: function(error) {
                    // Trate os erros conforme necessário
                }
            });
        });

        // Carrega as categorias ao inicializar a página
        carregarCategorias();
    });
</script>




</x-app-layout>


