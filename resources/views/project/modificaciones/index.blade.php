<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modificaciones') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <!-- Navigation Links -->
                <x-nav-links project="{{ $project->id }}" dirname="{{ $project->pathfile }}" />
                 
                <!-- Utilities -->
                <div class="flex flex-row justify-between gap-3 items-center p-4 sm:-my-px sm:ml-10">
                    @role('admin|inspector de obra')
                    <form action="{{ route('project.modificacion.create', ['id' => $project]) }}">
                        <input class="cursor-pointer border-gray-500 border-2 rounded hover:bg-gray-200 p-2" type="submit" value="Nueva Modificación">
                    </form>
                    @endrole
                    <form action="">
                        <input class="focus:border-black" type="search" name="search" placeholder="Decreto">
                        <input class="cursor-pointer border-gray-500 border-2 rounded hover:bg-gray-200 p-2" type="submit" value="Buscar">
                    </form>
                </div>

                <table class="table-fixed w-full">
                    <thead class="text-left">
                        <th>Modificación</th>
                        <th>Tipo</th>
                        <th>Fecha de modificación</th>
                        <th>Monto</th>
                        <th>Dias</th>
                        <th>Decreto</th>
                        <th>Acción</th>
                    </thead>
                    <tbody">
                        @foreach ($modificaciones as $modificacion)
                        <tr>
                            <td>{{ $modificacion->id }}</td>                            
                            <td>{{ $modificacion->tipo }}
                                @switch($modificacion->tipo)
                                    @case(1)
                                        Plazo
                                        @break
                                    @case(2)
                                        Costo y plazo
                                        @break
                                    @default
                                        Costo
                                @endswitch
                            </td>
                            <td>{{ $modificacion->fecha_modificacion }}</td>
                            <td>{{ $modificacion->monto }}</td>
                            <td>{{ $modificacion->dias }}</td>
                            <td>{{ $modificacion->decreto_aprobacion }}</td>
                            <td class="py-2">
                                @role('admin|inspector de obra')

                                    ---

                                @endrole
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
