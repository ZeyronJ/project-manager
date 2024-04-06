
<div data-modal-backdrop="static" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full" aria-labelledby="modal-title"  aria-modal="true" id="regenerateModal">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <form action="{{ route('project.estados_pago.regenerate', ['id' => $project]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
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
                                            Modificar estados de pago
                                            </h3>
                                    </div>
                                </div>
                                <div class="py-2">
                                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                        <div class="flex flex-col bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                                            <!--
                                            <div class="flex flex-row py-4 align-middle items-center">
                                                <span class="">Mantener hasta el mes:</span>
                                                <input class="max-w-min" type="number" step="1" min="1" max="{{ floor(count($estados_pago)) }}" name="meses_bloqueados" id="meses_bloqueados" value="{{ floor(count($estados_pago) / 2) }}">
                                            </div>
                                            -->
                                            <input class="invisible" type="number" name="num_meses" id="num_meses" value="{{ $num_meses }}">
                                            <table class="table-auto w-full">
                                                <thead class="text-left bg-gray-100">
                                                    <th>Mes</th>
                                                    <th>Avance Parcial Programado</th>
                                                </thead>
                                                <tbody id="table_rows">
                                                    @foreach($estados_pago as $estado_pago)
                                                    <tr class="border-b" id="avance_programado_tr{{$loop->index}}">
                                                        <td>
                                                            <span>Mes {{$loop->index+1}}</span>
                                                        </td>
                                                        <td>
                                                            <input class="" required type="number" min="1" name="avance_programado{{$loop->index}}" id="avance_programado{{$loop->index}}" value="{{ $estado_pago->avance_programado }}" class="flex text-sm text-gray-500">
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    </tbody>
                                            </table>
                                            <div>
                                                <button type="button" id="removeMonth" class=" text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm text-center inline-flex items-center mr-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                      </svg>
                                                    <span class="sr-only">Quitar mes</span>
                                                </button>
                                                <button type="button" id="addMonth" class=" text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-full text-sm text-center inline-flex items-center mr-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <span class="sr-only">Añadir mes</span>
                                                </button>
                                            </div>
                                            <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                <button data-modal-hide="regenerateModal" type="submit" id="acceptRegenerateBtn" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                    Aceptar
                                                </button>
                                                <button data-modal-hide="regenerateModal" type="button" id="cancelRegenerateBtn" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                    Cancelar
                                                </button>
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

<script type="module">
    const mb = $('#meses_bloqueados');
    const addb = $('#addMonth');
    const removeb = $('#removeMonth');
    const tabla = $('#table_rows');
    const num_meses = $('#num_meses');

    var meses_bloqueados;
    $(document).ready(function(){
        meses_bloqueados = parseInt(mb.val(), 10);
    })

    removeb.on('click', function(){
        const value = parseInt($("#num_meses").val(), 10) - 1;
        $("#num_meses").val(value);
        $(`#avance_programado_tr${value}`).remove();
    });

    addb.on('click', function(){
        const value = parseInt($("#num_meses").val(), 10) + 1;
        $("#num_meses").val(value);
        tabla.append(`
            <tr class="border-b" id="avance_programado_tr${value-1}">
                <td>
                    <span>Mes ${value}</span>
                </td>
                <td>
                    <input class="" required type="number" min="1" name="avance_programado${value-1}" id="avance_programado${value-1}" value="1" class="flex text-sm text-gray-500">
                </td>
            </tr>
        `);
    });

    /*
    mb.on('change', function(){
        //alert($(this).val());
        var val = parseInt(mb.val(), 10);
        var diff = val - meses_bloqueados;
        
        if(diff == 0) return;

        if(diff < 0){
            for(var i = 0; i < (-diff); i++){
                const id = (meses_bloqueados - 1 - i);
                $('#avance_programado' + id)
                    .prop('disabled', false)
                    .removeClass('border-none');
            }
        } else {
            for(var i = 0; i < diff; i++){
                const id = (meses_bloqueados + i);
                $('#avance_programado' + id)
                    .prop('disabled', true)
                    .addClass('border-none');
            }
        }

        meses_bloqueados = val;
    });
    */
</script>