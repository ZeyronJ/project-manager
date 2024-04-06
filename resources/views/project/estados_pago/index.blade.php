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
                    
                    <!-- Notificaciones -->

                    @if(!empty($alerts))
                        <div class="pt-4">
                        @foreach ($alerts as $key => $text)
                            @switch($key)
                                @case('success')
                                    <div id="alert-3" class="flex p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                                        <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                        <span class="sr-only">Info</span>
                                        <div class="ml-3 text-sm font-medium">
                                            {{ $text }}   
                                        </div>
                                        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
                                            <span class="sr-only">Close</span>
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </button>
                                    </div>
                                    @break
                                @case('error')
                                    <div id="alert-2" class="flex p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                                        <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                        <span class="sr-only">Info</span>
                                        <div class="ml-3 text-sm font-medium">
                                            {{ $text }}
                                        </div>
                                        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
                                            <span class="sr-only">Close</span>
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </button>
                                    </div>
                                    @break
                                @default
                                    
                            @endswitch
                        @endforeach
                        </div>
                    @endif

                    <!-- --------------------------- -->
                    @if(!$estados_pago->isEmpty())
                    @role('admin|inspector de obra')
                    <div class="flex w-full align-middle pt-1">
                        <div class="mx-auto rounded-md bg-gray-50 text-gray-500 transition-all hover:text-blue-600 dark:text-white hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <a data-modal-target="regenerateModal" data-modal-toggle="regenerateModal" class="flex flex-col p-2 justify-center items-center cursor-pointer" type="button" >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"></path>
                                </svg>
                                <p class="text-xs">Modificación</p>
                            </a>
                        </div>
                        @include('project.partials.regenerate', ['estados_pago' => $estados_pago])
                    </div>
                    @endrole
                    <div class="">
                        <div class="max-w-7xl mx-auto">
                            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                                <table class="table-auto w-full">
                                    <thead class="text-center bg-gray-100">
                                        <th class="px-2">Mes</th>
                                        <th class="px-2">Fecha</th>
                                        <th class="px-2">Avance Programado Parcial</th>
                                        <th class="px-2">Avance Programado Acumulado</th>
                                        <th class="px-2">Avance Real Parcial</th>
                                        <th class="px-2">Avance Real Acumulado</th>
                                        <th class="px-2">Diferencia</th>
                                        <th class="px-2">Archivo</th>
                                        <th class="px-2">Multa</th>
                                        <th class="px-2" colspan="2"></th>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($estados_pago as $estado_pago)
                                        <tr class="border-b">
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td class=" w-24">{{ $estado_pago->fecha }}</td>
                                            <td>{{ $estado_pago->avance_programado }}</td>
                                            <td>{{ $estado_pago->avance_programado_acc }}</td>
                                            <td>{{ $estado_pago->avance_actual }}</td>
                                            <td>{{ $estado_pago->avance_actual_acc }}</td>
                                            @if($estado_pago->monto_sugerido_multa > 0)
                                            <td class="text-red-600">{{ $estado_pago->dif }}%</td>
                                            @else
                                            <td>{{ $estado_pago->dif }}%</td>
                                            @endif
                                            <td class="">
                                                @if($estado_pago->pathfile !== '')
                                                    <form action="{{ route('project.estados_pago.download', ['id' => $project, 'pathfile' => $estado_pago->pathfile]) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <button type="submit" id="archivoBtn" class="justify-start shadow-sm dark:text-white hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                            <svg class="w-4 h-4 m-2" fill="currentColor" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="justify-center text-center">-</span>
                                                @endif
                                            </td>
                                            @role('admin|inspector de obra')
                                            <td>
                                                @if(isset($estado_pago->multa_id))
                                                <div class="">
                                                    <a data-modal-target="editMultaModal{{$estado_pago->id}}" data-modal-toggle="editMultaModal{{$estado_pago->id}}" class="justify-center items-center rounded-md text-gray-500 transition-all hover:text-blue-600 cursor-pointer hover:bg-gray-200" type="button">
                                                        <svg class="w-4 h-4 mx-auto" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                          </svg>
                                                        <p class="text-xs mx-auto">Editar</p>
                                                    </a>
                                                    @include('project.partials.edit_multa_modal', ['estado_pago' => $estado_pago])
                                                </div>
                                                @include('project.partials.edit_multa_modal', ['estado_pago' => $estado_pago])
                                                @elseif(isset($estado_pago->tipo_multa))
                                                <div class="">
                                                    <a data-modal-target="multaModal{{$estado_pago->id}}" data-modal-toggle="multaModal{{$estado_pago->id}}" class="justify-center items-center rounded-md text-gray-500 transition-all hover:text-blue-600 cursor-pointer hover:bg-gray-200" type="button">
                                                        <svg class="w-4 h-4 mx-auto" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                          </svg>
                                                        <p class="text-xs mx-auto">Multar</p>
                                                    </a>
                                                    @include('project.partials.add_multa_modal', ['estado_pago' => $estado_pago])
                                                </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="rounded-md text-gray-500 transition-all hover:text-blue-600 dark:text-white hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                    <a data-modal-target="editEPModal{{$estado_pago->id}}" data-modal-toggle="editEPModal{{$estado_pago->id}}" class="flex flex-col justify-center items-center cursor-pointer" type="button" >
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
                                                          </svg>
                                                        <p class="text-xs">Editar</p>
                                                    </a>
                                                </div>
                                                @include('project.partials.edit_EP_modal', ['estado_pago' => $estado_pago])
                                            </td>
                                            @endrole
                                            <td>
                                                <div class="rounded-md text-gray-500 transition-all hover:text-blue-600 dark:text-white hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                    <a href="{{ route('project.estados_pago.historial', ['id' => $project, 'estado_pago_id' => $estado_pago->id]) }}" class="flex flex-col justify-center items-center cursor-pointer" type="button" >
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"></path>
                                                          </svg>
                                                        <p class="text-xs">Historial</p>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                      </tbody>
                                </table>

                                <div class="flex flex-col justify-center text-center my-8">
                                    <canvas id="estadosPagoChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="py-4 text-center">
                        <span class="text-red-500">Se debe generar los estados de pago</span>
                        <form action="{{ route('project.estados_pago.generate', ['id' => $project->id]) }}" method="GET" enctype="multipart/form-data">
                            @csrf
                            <span>Numero de meses</span>
                            <input type="text" name="num_meses" id="num_meses" value="{{$num_meses}}" class=" w-24">
                            <button type="submit" id="modNumMesesBtn" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Generar
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
<!-- <script src="{ Vite::asset('resources/js/chart.js') }"></script> -->
<script type="module">
    const ctx = document.getElementById('estadosPagoChart');

    new Chart(ctx, {
      type: 'line',
      data: {
        labels: @js($chart_labels),
        datasets: [{
          label: 'Avance Programado',
          data: @js($chart_data1),
          borderWidth: 1
        },
        {
          label: 'Avance Real',
          data: @js($chart_data2),
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
</script>

