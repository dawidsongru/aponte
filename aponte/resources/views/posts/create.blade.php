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
            
        
            <form id="categoriaForm">
                @csrf
                <fieldset class="border-2 rounded p-6 ">
                    <legend>Cadastre sua Reclamação</legend>
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

</div>
</div>
</x-app-layout>
