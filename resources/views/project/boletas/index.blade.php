<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-4">
                <div class="flex flex-col">
                    <!-- Logo -->
    
                    <!-- Navigation Links -->
                    <x-nav-links project="{{ $project->id }}" dirname="{{ $project->pathfile }}" />

                    <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-4">
                        @if(session('success'))
                            <x-alert type="success" inputmsg="{{ session('success') }}"/>
                        @endif
                        @if(session('danger'))
                            <x-alert type="danger" inputmsg="{{ session('danger') }}"/>
                        @endif
                        @if(session('warning'))
                            <x-alert type="warning" inputmsg="{{ session('warning') }}"/>
                        @endif
                        @role('admin|inspector de obra')
                        <div class="flex mb-4 flex-col">
                            <div class="mx-auto">Agregar boleta</div>
                            <button class="mx-auto hover:text-blue-600" data-modal-target="crearBoletaModal" data-modal-toggle="crearBoletaModal" class="" type="button">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </button>
                        </div>
                        @include('project/boletas/partials/create_modal')
                        @endrole
                        <div class="flex">
                            <table class="table-auto text-center w-full">
                                <thead>
                                    <caption class="font-bold">BOLETAS</caption>
                                    <tr class="bg-gray-100">
                                        <th>N°</th>
                                        <th>Glosa</th>
                                        <th>Tipo</th>
                                        <th>Monto</th>
                                        <th>Vencimiento</th>
                                        @role('admin|inspector de obra')
                                        <th>Acciones</th>
                                        @endrole
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($boletas as $boleta)
                                    @php
                                        $path = explode("/", $boleta->pathfile);
                                        $boleta->boletas_estado($boleta->id, 0);
                                    @endphp
                                    <tr>
                                        <td>{{$boleta->numero}}</td>
                                        <td>{{$boleta->glosa}}</td>
                                        <td>{{$boleta->tipo}}</td>
                                        <td>{{$boleta->monto}}</td>
                                        <td>{{$boleta->fecha_termino}}</td>
                                        @role('admin|inspector de obra')
                                        <td>
                                            <div class="flex justify-between">
                                                @switch($boleta->estado)
                                                    @case(1)
                                                        <form action="{{route('project.boletas.disapprove', ['id' => $project, 'boleta_id'=>$boleta->id])}}" method="POST">
                                                            @csrf
                                                            <button class="flex flex-col hover:text-blue-600" type="submit" title="Desaprobar">
                                                                <svg class="w-5 h-5 mx-auto mt-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3"></path>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                        @break
                                                    @default
                                                        <form action="{{route('project.boletas.approve', ['id' => $project, 'boleta_id'=>$boleta->id])}}" method="POST">
                                                            @csrf
                                                            <button class="flex flex-col hover:text-blue-600" type="submit" title="Desactivar/Devolver boleta">
                                                                <svg class="w-5 h-5 mx-auto mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                @endswitch
                                                <button class="flex flex-col hover:text-blue-600" data-modal-target="editarBoletaModal{{$boleta->id}}" data-modal-toggle="editarBoletaModal{{$boleta->id}}" type="button" title="Editar">
                                                    <svg class="w-5 h-5 mx-auto mt-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
                                                    </svg>   
                                                    {{-- <p class="text-xs mx-auto">Editar</p>                                                        --}}
                                                </button>
                                                <button type="button" class="flex flex-col hover:text-blue-600" data-modal-target="deleteBoletaModal{{$boleta->id}}" title="Eliminar" data-modal-toggle="deleteBoletaModal{{$boleta->id}}">
                                                    <svg class="w-5 h-5 mx-auto mt-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                                    </svg>
                                                    {{-- <p class="text-xs mx-auto">Eliminar</p> --}}
                                                </button>
                                                <form action="{{ route('project.boletas.download', ['id' => $project, 'pathfile' => $boleta->pathfile]) }}" method="POST" enctype="multipart/form-data" title="Descargar">
                                                    @csrf
                                                    <button class="w-5 h-5 mx-auto mt-1" type="submit" id="archivoBtn" class="justify-start shadow-sm dark:text-white hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                        <svg fill="currentColor" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        @include('project/boletas/partials/delete_modal')
                                        @include('project/boletas/partials/edit_modal')
                                        @endrole
                                        <td>
                                            <div class="flex justify-center text-slate-500">
                                                @switch($boleta->estado)
                                                @case(1)
                                                    <div title="Desactivada/Devuelta">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 13.5l3 3m0 0l3-3m-3 3v-6m1.06-4.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z"></path>
                                                        </svg>
                                                    </div>
                                                    @break
                                                @case(2)
                                                    <div title="Por caducar">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5"></path>
                                                        </svg>
                                                    </div>
                                                    @break
                                                @case(3)
                                                    <div title="Caducada">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                          </svg>
                                                    </div>
                                                    @break
                                                @default
                                                    <div title="Correcto">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z"></path>
                                                        </svg>
                                                    </div>
                                                    @break
                                                @endswitch
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
