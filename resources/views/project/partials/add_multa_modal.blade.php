<!-- <button type="button" class="focus:outline-none openModal text-white text-sm py-2.5 px-5 mt-5 mx-5  rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg">Open Modal</button> -->

<form action="{{ route('project.multas.store', ['id' => $project, 'estado_pago_id' => $estado_pago->id, 'tipo_multa_id' => $estado_pago->tipo_multa->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div data-modal-backdrop="static" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full" aria-labelledby="modal-title"  aria-modal="true" id="multaModal{{ $estado_pago->id }}">
        <div class="relative w-full h-full max-w-2xl md:h-auto">
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
                                Nueva multa
                                </h3>
                        </div>
                    </div>
                    <div class="mt-2 flex flex-col justify-center items-center mx-auto">
                        <span class="text-gray-800 mb-2">
                            Diferencia del <span class="font-bold">{{$estado_pago->dif}}%</span>.
                        </span>
                        <span class="text-gray-800 mb-2">
                            Corresponde multa del <span class="font-bold">{{$estado_pago->tipo_multa->porcentaje_multa}}%</span> del costo total del proyecto.
                        </span>
                        <span class="text-gray-800">Monto sugerido Multa</span>
                        <input type="number" value="{!! $estado_pago->monto_sugerido_multa !!}" name="monto_multa" id="monto_multa" value={{$estado_pago->avance_programado}} class="flex text-sm text-gray-500 mb-4">    
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button data-modal-hide="multaModal{{ $estado_pago->id }}" type="submit" id="acceptAddBtn" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Aceptar
                    </button>
                    <button data-modal-hide="multaModal{{ $estado_pago->id }}" type="button" id="cancelAddBtn" class="closeMultaModal{{ $estado_pago->id }} mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
                
            </div>
        </div>
    </div>
</form>
