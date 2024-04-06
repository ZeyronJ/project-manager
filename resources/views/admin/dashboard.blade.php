<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Proyectos') }}
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
                    <form action="">
                        <input class="focus:border-black" type="search" name="search" placeholder="Nombre de Proyecto">
                        <input class="cursor-pointer border-gray-500 border-2 rounded hover:bg-gray-200 p-2" type="submit" value="Buscar">
                    </form>
                </div>

                <table class="table-fixed w-full">
                    <thead class="text-left">
                        <th>Proyecto</th>
                        <th>Estado</th>
                        <th>A cargo</th>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                        <tr>
                          <td>{{ $project->nombre }}</td>
                          <td>{{ $project->estado }}</td>
                            <td class="flex py-2 gap-2">
                                <form action="{{ route('admin.assign_user', ['id' => $project->id])}}" method="GET">
                                    @csrf

                                    <select name="user_assigned">
                                        <option value="" disabled selected hidden>{{ $project->get_name($project->user_id) }}</option>
                                        @foreach ($users as $user)
                                          <option value= {{ $user->id }} >{{ $user->name }}</option>
                                        @endforeach
                                        <option value="Todos">Todos</option>
                                    </select>

                                    <input class="p-2 bg-gray-200 border-black border-2 rounded hover:bg-gray-300 cursor-pointer" type="submit" value="Asignar">
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
