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


                <div class="flex justify-center">
                    <form class="flex flex-col w-2/3 gap-y-2 items-center" action={{ route('admin.role_adding') }} method="POST">
                        @csrf
                        
                        <div class="flex justify-between w-1/2">
                            <label for="name">Nombre:</label>
                            <input type="text" name="name" id="name" placeholder="Nombre del Rol" value= {{ old('name') }}>
                        </div>
                        @error('name')
                            <ul class="text-red-500 block">{{ $message }}</ul>
                        @enderror
    
                        <div class="flex flex-col items-center border w-1/3 p-2">
                            <h2 class="font-bold text-lg">Lista de Permisos</h2>
                            @foreach ($permissions as $permission)
                            <div class="flex justify-between w-full">
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->description }}</td>
                                    <td>
                                        <input class="p-2" type="checkbox" name='cb{{ $permission->id }}' value={{ $permission->id }}>
                                    </td>
                                </tr>
                            </div>
                            @endforeach
                        </div>

                        <input type="submit" value="Crear Rol" class="p-2 bg-gray-200 border-black border-2 rounded hover:bg-gray-300 cursor-pointer">
                    </form>
                </div>                
            </div>
        </div>
    </div>
</x-app-layout>
