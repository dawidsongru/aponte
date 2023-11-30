<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edição de Usuário') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4">Editando nível de acesso do usuário <strong>{{ $user->name }}</strong></p>
                    <p class="mb-4">Nível de acesso atual: <strong>{{ $user->level }}</strong></p>
                </div>

                <div class="p-6 text-gray-900">
                    <form action="{{ route('users.update', $user->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <label for="level">Selecione o nível</label><br>
                        <select name="level" required id="" class="py-1 px-8 rounded">
                            <option value="" selected disabled>Selecione uma opção</option>
                            <option value="user">Usuário comun</option>
                            <option value="admin">Administrador</option>
                        </select>
                        <button type="submit" class="py-2 px-4 rounded bg-blue-500 text-white">
                           <i class="fa-regular fa-floppy-disk mr-2"></i> Salvar Alterações
                        </button>
                    </form>
                </div>

            </div>
        

</div>
</div>
</x-app-layout>
