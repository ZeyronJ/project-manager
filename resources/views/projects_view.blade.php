<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Proyectos') }}
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
                
                
                <!-- Utilities -->

                <div class="flex flex-row justify-between gap-3 items-center p-4 sm:-my-px sm:ml-10">
                    @role('admin|inspector de obra')
                    <form action="{{ route('project.add') }}">                        
                        <input class="cursor-pointer border-gray-500 border-2 rounded hover:bg-gray-200 p-2" type="submit" value="Nuevo Proyecto">
                    </form>
                    @endrole
                    <form action="">
                        <input class="focus:border-black" type="search" name="search" placeholder="Nombre de Proyecto">
                        <input class="cursor-pointer border-gray-500 border-2 rounded hover:bg-gray-200 p-2" type="submit" value="Buscar">
                    </form>
                </div>

                <table class="table-fixed w-full">
                    <thead class="text-left">
                        <th>Proyecto</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                        <tr>
                          <td>{{ $project->nombre }}</td>
                          <td>{{ $project->estado }}</td>
                            <td class="flex py-2 gap-2">
                                @role('admin|inspector de obra')
                                @if ( $project->estado == 'En curso')
                                    <a class="bg-red-300 hover:bg-red-400 p-2 w-10 text-center border-2 border-black" href="{{ route('project.switch', ['id'=>$project]) }}" title="Desactivar proyecto">•</a>
                                @else
                                    <a class="bg-red-300 hover:bg-red-400 p-2 w-10 text-center border-2 border-black" onclick="return confirm('¿Seguro de eliminar el proyecto {{ $project->nombre }}')" href="{{ route('project.delete', ['id'=>$project]) }}" title="Eliminar proyecto">X</a>
                                    <a class="bg-green-200 hover:bg-red-400 p-2 w-10 text-center border-2 border-black" href="{{ route('project.switch', ['id'=>$project]) }}" title="Activar proyecto">•</a>
                                @endif                                                                
                                <a class="bg-gray-300 hover:bg-gray-400 p-2 border-2 border-black" href="{{ route('project.edit', ['id'=>$project,'dirname' => $project->nombre]) }}"><img class="w-5" src="{{ Vite::asset('resources/images/icons/edit.png') }}" title="Editar informacion"></a>
                                @endrole
                                <a class="bg-gray-300 hover:bg-gray-400 p-2 w-10 text-center border-2 border-black" href="{{ route('project.home', ['id'=>$project,'dirname' => $project->nombre]) }}" title="Entrar a proyecto">></a>
                                <button id="dropdownMenuIconButton{{$project->id}}" data-dropdown-toggle="dropdownDots{{$project->id}}" data-dropdown-placement="right" class="bg-gray-300 hover:bg-gray-400 p-2 w-10 text-center border-2 border-black" type="button"> 
                                    @if (session()->has('notificaciones_boletas_por_vencer_'.$project->id) || session()->has('notificaciones_multas_sin_cursar_'.$project->id) || (session()->has('notificaciones_proyecto_fecha_limite_'.strval($project->id))))
                                        <svg class="w-[22px] h-[22px] text-yellow-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5"></path>
                                        </svg>
                                    @else
                                        <svg class="w-[22px] h-[22px]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"></path>
                                        </svg>
                                    @endif
                                </button>
                                  
                                <!-- Dropdown menu -->
                                <div id="dropdownDots{{$project->id}}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg w-[250px] shadow-md">
                                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownMenuIconButton{{$project->id}}">
                                        @if (session()->has('notificaciones_boletas_por_vencer_'.$project->id))
                                            <li>
                                                <div class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                    Tiene {{session("notificaciones_boletas_por_vencer_".$project->id)}} boleta(s) por vencer!
                                                </div>
                                            </li>
                                        @else
                                            <li>
                                                <div class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                    No hay notificaciones de boletas
                                                </div>
                                            </li>
                                        @endif
                                        @if (session()->has('notificaciones_multas_sin_cursar_'.$project->id))
                                            <li>
                                                <div class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                    Tiene {{session("notificaciones_multas_sin_cursar_".$project->id)}} multas(s) sin cursar!
                                                </div>
                                            </li>
                                        @else
                                            <li>
                                                <div class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                    No hay notificaciones de estados de pago
                                                </div>
                                            </li>
                                        @endif
                                        @if (session()->has('notificaciones_proyecto_fecha_limite_'.$project->id))
                                            <li>
                                                <div class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                    Fecha límite del proyecto por terminar!
                                                </div>
                                            </li>
                                        @else
                                            <li>
                                                <div class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                    Sin problemas con la fecha límite
                                                </div>
                                            </li>
                                        @endif
                                    </ul>                                  
                                </div>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
