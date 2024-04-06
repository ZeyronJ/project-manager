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
                    <form class="flex flex-col w-2/3 gap-y-2 items-center" action={{ route('admin.user_adding') }} method="POST">
                        @csrf
                        
                        <div class="flex justify-between w-1/2">
                            <label for="name">Nombre:</label>
                            <input type="text" name="name" id="name" placeholder="Nombre del Usuario" value= {{ old('name') }}>
                        </div>
                        @error('name')
                            <ul class="text-red-500 block">{{ $message }}</ul>
                        @enderror
                        
                        <div class="flex justify-between w-1/2">
                            <label for="email">Correo:</label>
                            <input type="text" name="email" id="email" placeholder="Correo del Usuario" value= {{ old('email') }}>
                        </div>
                        @error('email')
                            <ul class="text-red-500 block">{{ $message }}</ul>              
                        @enderror
    
                        <div class="flex justify-between w-1/2">
                            <label for="password">Password:</label>
                            <input type="password" name="password" id="password" placeholder="Contraseña del Usuario" value= {{ old('password') }}>
                        </div>
                        @error('password')
                            <ul class="text-red-500 block">{{ $message }}</ul>              
                        @enderror
    
                        <div class="flex flex-col items-center border w-1/3 p-2">
                            @foreach ($roles as $role)
                            <div class="flex justify-between w-full">
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <input class="p-2" type="checkbox" name='cb{{ $role->id }}' value={{ $role->id }}>
                                    </td>
            
                                </tr>
                            </div>
                            @endforeach
                        </div>
                                                
                        <input type="submit" value="Crear Usuario" class="p-2 bg-gray-200 border-black border-2 rounded hover:bg-gray-300 cursor-pointer">                        
    
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
