<x-app-layout>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Minhas Postagens') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4">Olá <strong>{{ Auth::user()->name }}</strong></p>
                    @if($posts->isEmpty())
                    <p>Não há posts criados.</p>
                    @else

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('sucesso'))
                    <div class="alert alert-success">
                        {{ session('sucesso') }}
                    </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Categoria</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->titulo }}</td>
                                <td>{{ $post->category->name }}</td>
                                <td>{{ $post->status }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-primary" onclick="verPost({{ json_encode($post) }})">Ver</button>
                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning" style="margin-left: 5px">Editar</a>
                                        <form method="POST" action="{{ route('posts.destroy', $post->id) }}" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" style="margin-left: 5px;">Excluir</button>
                                        </form>
                                        <form method="POST" action="{{ route('mudar.status', ['postId' => $post->id]) }}" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="Aguardando">
                                            <button type="submit" class="btn btn-success" style="margin-left: 5px;">Mudar Status</button>
                                        </form>
                                        
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para exibir detalhes do post -->
    <div class="modal fade" id="verPostModal" tabindex="-1" role="dialog" aria-labelledby="verPostModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verPostModalLabel">Detalhes do Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Aqui você pode exibir os detalhes do post -->
                    <p>ID: <span id="post_id"></span></p>
                    <p>Título: <span id="post_titulo"></span></p>
                    <p>Categoria: <span id="post_categoria"></span></p>
                    <p>Status: <span id="post_status"></span></p>
                    <p>Imagem: <img id="post_imagem" src="" alt="Imagem do Post"></p>
                    <p>Descrição: <span id="post_descricao"></span></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    


   


    <script>
        function verPost(post) {
            // Preencher os dados no modal
            document.getElementById('post_id').innerText = post.id;
            document.getElementById('post_titulo').innerText = post.titulo;
            document.getElementById('post_categoria').innerText = post.category.name;
            document.getElementById('post_status').innerText = post.status;
            document.getElementById('post_imagem').src = "{{ asset('storage') }}/" + post.imagem;
            document.getElementById('post_descricao').innerText = post.descricao;

            // Mostrar o modal
            $('#verPostModal').modal('show');
        }

        function mudarStatus(postId, currentStatus) {
        // Implemente a lógica para mudar o status (por exemplo, fazer uma requisição AJAX)

        // Exemplo: Você pode usar o jQuery para fazer uma requisição AJAX
        $.ajax({
            url: '/mudar-status/' + postId, // Substitua pela rota real em sua aplicação
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                current_status: currentStatus,
            },
            success: function (response) {
                // Atualize a interface ou faça outras ações conforme necessário
                alert('Status do post alterado com sucesso!');
                // Recarregue a página ou atualize dinamicamente a tabela, se necessário
                location.reload();
            },
            error: function (error) {
                alert('Erro ao mudar o status do post.');
                console.error(error);
            },
        });
    }

      
    </script>
    @endif
</x-app-layout>