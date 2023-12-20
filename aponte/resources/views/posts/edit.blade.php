<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Postagem') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4">Olá <strong>{{ Auth::user()->name }}</strong></p>
                </div>


            
                @if(session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                </div>
                @endif
            
            
        
                <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Adicione esta linha para indicar que é um método de atualização -->
                
                    <fieldset class="border-2 rounded p-6">
                        <legend>Atualizar Postagem</legend>
                
                        <!-- Campos do formulário -->
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                
                        <div class="bg-gray-100 p-4 rounded overflow-hidden mb-4">
                            <label for="titulo">Título</label>
                            <input type="text" name="titulo" id="titulo" value="{{ $post->titulo }}" class="w-full rounded required autofocus">
                        </div>
                
                        <div class="bg-gray-100 p-4 rounded overflow-hidden mb-4">
                            <label for="categoria_id">Categoria:</label>
                            <select name="categoria_id" id="categoria_id" class="w-full rounded required autofocus">
                                <option value="" disabled>Selecione uma categoria</option>
                                @foreach($category as $categoria)
                                    <option value="{{ $categoria->id }}" @if($categoria->id == $post->categoria_id) selected @endif>{{ $categoria->name }}</option>
                                @endforeach
                            </select>
                        </div>
                
                        <div class="bg-gray-100 p-4 rounded overflow-hidden mb-4">
                            <label for="telefone">Telefone</label>
                            <input placeholder="Digite seu telefone" maxlength="15" onkeyup="handlePhone(event)" type="text" name="telefone" id="telefone" value="{{ $post->telefone }}" class="w-full rounded required autofocus">
                        </div>
                
                        <div class="bg-gray-100 p-4 rounded overflow-hidden mb-4">
                            <label for="endereco">Endereço</label>
                            <input placeholder="Digite o endereço" type="text" name="endereco" id="endereco" value="{{ $post->endereco }}" class="w-full rounded required autofocus">
                        </div>
                
                        <div class="bg-gray-100 p-4 rounded overflow-hidden mb-4">
                            <label for="descricao">Descrição</label>
                            <textarea rows="6" type="text" name="descricao" id="descricao" class="w-full rounded required autofocus">{{ $post->descricao }}</textarea>
                        </div>
                
                        <div class="bg-gray-100 p-4 rounded overflow-hidden">
                            <label for="imagem">Imagem</label>
                            <input type="file" name="imagem" id="imagem" class="w-full rounded required autofocus">
                        </div>
                
                        <div class="bg-gray-100 p-4 rounded overflow-hidden">
                            <button type="submit" class="bg-green-600 text-white rounded p-2 cursor-pointer" style="background-color: rgb(79, 79, 163)">Atualizar</button>
                        </div>
                    </fieldset>
                </form>

                       

        </div>

</div>
</div>


<script>

   function() {
       $('#submit').click(function() {
          let data ={
            const data = {
                // Preencha os campos com os valores dos respectivos inputs do formulário
                titulo: $('#titulo').val(),
                categoria_id: $('#categoria_id').val(),
                telefone: $('#telefone').val(),
                endereco: $('#endereco').val(),
                descricao: $('#descricao').val(),
                imagem: $('#imagem')[0].files[0], // Cuidado! Verifique se existe algum arquivo selecionado antes de acessar o primeiro elemento do array
                user_id: '{{ Auth::user()->id }}', // Substitua pelo valor real do ID do usuário autenticado
                };
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                $.ajax({
                    type: 'POST',
                    url: '{{ route('posts.store') }}',
                    data: data,
                    enctype: 'multipart/form-data',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                },
                success: function(response) {
                // Se a requisição for bem-sucedida
                    if (response.success) {
                        // Exibir uma mensagem de sucesso
                        $('#success-message').text('Usuário criado com sucesso!').show();
                    } else {
                        // Se a requisição falhar
                        // Exibir os erros
                        alert(response.errors);
                    }
                },
                error: function(error) {
                    // Se a requisição falhar
                    // Exibir um erro no console
                    console.error(error);
                }
       });
    }


 // Mascara para telefone
    const handlePhone = (event) => {
    let input = event.target
    input.value = phoneMask(input.value)
    }

  const phoneMask = (value) => {
    if (!value) return ""
    value = value.replace(/\D/g,'')
    value = value.replace(/(\d{2})(\d)/,"($1) $2")
    value = value.replace(/(\d)(\d{4})$/,"$1-$2")
    return value
    }
</script>

</x-app-layout>
