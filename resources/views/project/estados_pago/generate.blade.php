<!-- This example requires Tailwind CSS v2.0+ -->

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
                    <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-jet-nav-link class="underline" href="{{ route('project.home', ['id'=>$project,'dirname' => $project->nombre]) }}" :active="request()->routeIs('home')">
                            {{ __('Directorio') }}
                        </x-jet-nav-link>
                        <x-jet-nav-link href="{{ route('project.show', ['id' => $project]) }}" :active="request()->routeIs('project.show')">
                            {{ __('Información') }}
                        </x-jet-nav-link>
                        <x-jet-nav-link href="{{ route('project.estados_pago', ['id' => $project]) }}" :active="request()->routeIs('project.estados_pago')">
                            {{ __('Estados Pago') }}
                        </x-jet-nav-link>
                        <x-jet-nav-link href="{{ route('project.boletas', ['id' => $project]) }}" :active="request()->routeIs('project.boletas')">
                            {{ __('Boletas') }}
                        </x-jet-nav-link>
                    </div>
                    
                    <!-- --------------------------- -->

                    <!-- ## 
                    <div class="mx-auto flex flex-row justify-between items-center overflow-hidden shadow-xl sm: rounded-3xl">
                        <div class="">
                            <ul class="flex flex-row">
                                <li class="p-2 m-2  cursor-pointer text-gray-500 transition-all hover:text-blue-600">
                                    <a class="flex flex-col justify-center items-center openModal" type="button"  data-toggle="modal" data-target="#addEstadoPagoModal">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path>
                                        </svg>
                                        <p class="text-xs">Generar</p>
                                    </a>
                                    _@include('project.partials.add_modal')
                                </li>
                            </ul>
                        </div>
                    </div> -->

                    <!-- tabla con estados pago -->
                    <div class="py-2">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                            <div class="fixed z-10 inset-0 overflow-y-auto">
                                <form action="{{ route('project.estados_pago.generate_store', ['id' => $project, 'num_meses' => $num_meses]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" aria-labelledby="modal-title" aria-modal="true" id="generateModal">
                                        <div class="flex items-end justify-center pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
                                                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                        <div class="sm:flex sm:items-start">
                                                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-black sm:mx-0 sm:h-10 sm:w-10">
                                                                <svg @click="toggleModal" class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                                    <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>    
                                                                </svg>
                                                            </div>
                                                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                                Generar Estados de pago
                                                                </h3>
                                                        </div>
                                                    </div>
                                                    <div class="py-2">
                                                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                                            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                                                                <table class="table-auto w-full">
                                                                    <thead class="text-left bg-gray-100">
                                                                        <th>Mes</th>
                                                                        <th>Avance Parcial Programado</th>
                                                                    </thead>
                                                                    <tbody id="table_rows">
                                                                        @for ($i = 0; $i < $num_meses; $i++)
                                                                        <tr class="border-b">
                                                                            <td>
                                                                                <span>Mes {{$i+1}}</span>
                                                                            </td>
                                                                            <td>
                                                                                <input required type="number" name="avance_programado{{$i}}" id="avance_programado{{$i}}" value="{{ old('avance_programado'.$i, 1) }}" class="flex text-sm text-gray-500">
                                                                            </td>
                                                                        </tr>
                                                                        @endfor
                                                                      </tbody>
                                                                </table>
                                                                <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                                    <button type="submit" id="acceptAddBtn" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                                        Aceptar
                                                                    </button>
                                                                    <a href="{{ route('project.estados_pago', ['id' => $project->id]) }}" id="cancelAddBtn" class="hover:cursor-pointer mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                                        Cancelar
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>