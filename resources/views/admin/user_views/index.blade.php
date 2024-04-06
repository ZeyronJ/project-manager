<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <x-alert type="success" inputmsg="{{ session('success') }}"/>
            @endif
            @if(session('danger'))
                <x-alert type="danger" inputmsg="{{ session('danger') }}"/>
            @endif
            @if(session('warning'))
                <x-alert type="warning" inputmsg="{{ session('warning') }}"/>
            @endif
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                
                <x-admin-nav-links />
                <!-- Utilities -->
                <div class="flex flex-row justify-between gap-3 items-center p-4 sm:-my-px sm:ml-10">
                    <form action="{{ route('admin.user_add') }}">                        
                        <input class="cursor-pointer border-gray-500 border-2 rounded hover:bg-gray-200 p-2" type="submit" value="Nuevo Usuario">
                    </form>

                    {{--
                        <form action="">
                            <input class="focus:border-black" type="search" name="search" placeholder="Nombre de Usuario">
                            <input class="cursor-pointer border-gray-500 border-2 rounded hover:bg-gray-200 p-2" type="submit" value="Buscar">
                        </form>
                    --}}
                </div>

                <table class="table-fixed w-full">
                    <thead class="text-left">
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Acción</th>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td class="flex gap-5">
                            <a href={{ route('admin.user_edit', $user->id )}} class="text-center w-16 bg-gray-300 p-2 hover:bg-gray-400 rounded">Editar</a>
                        
                            <form action={{ route("admin.user_delete", $user->id) }} method="GET">
                                @csrf
                                <button onclick="return confirm('¿Está seguro de ELIMINAR el usuario {{ $user->name }} ?')" type="submit" class="text-center w-20 bg-red-300 p-2 hover:bg-red-400 rounded">Eliminar</button>
                            </form>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
