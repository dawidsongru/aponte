<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Postagem') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4">Olá <strong>{{ Auth::user()->name }}</strong></p>
                </div>
            
        
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <fieldset class="border-2 rounded p-6 ">
                    <legend>Cadastre sua Reclamação</legend>

                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                  
                    <div class="bg-gray-100 p-4 rounded overflow-hidden mb-4">
                        <label for="titulo">Título</label>
                        <input type="text" name="titulo" id="titulo" placeholder="Digite o título" class="w-full rounded required autofocus">
                    </div>
                    

                    <div class="bg-gray-100 p-4 rounded overflow-hidden mb-4">
                        <label for="categoria_id">Categoria:</label>
                        <select name="categoria_id" id="categoria_id" class="w-full rounded required autofocus">
                            <option value="" disabled selected>Selecione uma categoria</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="bg-gray-100 p-4 rounded overflow-hidden mb-4">
                        <label for="name">Telefone</label>
                        <input placeholder="Digite seu telefone" maxlength="15" onkeyup="handlePhone(event)" type="text" name="telefone" id="titulo" class="w-full rounded required autofocus">
                    </div>

                    <div class="bg-gray-100 p-4 rounded overflow-hidden mb-4">
  <textarea rows="6" type="text" name="descricao" id="descricao" class="w-full rounded required autofocus">Descrição</textarea>
                    </div>

                    <div class="bg-gray-100 p-4 rounded overflow-hidden">
                        <input type="file" name="imagem" id="imagem" class="w-full rounded required autofocus">
                    </div>
                    

                    <div class="bg-gray-100 p-4 rounded overflow-hidden">
                       <input type="submit" value="Cadastrar" class="bg-green-600 text-white rounded p-2 cursor-pointer" style="background-color: rgb(79, 79, 163)">
                       <input type="reset" value="Limpar" class="bg-red-500 text-white rounded p-2 cursor-pointer">
                    </div>
                </fieldset>
            </form>

        </div>

</div>
</div>


<script>




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
