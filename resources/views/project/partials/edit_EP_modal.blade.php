<form action="{{ route('project.estados_pago.update', ['project_id' => $project->id, 'id' => $estado_pago->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div data-modal-backdrop="static" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full" aria-labelledby="modal-title"  aria-modal="true" id="editEPModal{{ $estado_pago->id }}">
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
                                Estado pago
                                </h3>
                        </div>
                    </div>
                    <div class="mt-2 flex flex-col justify-center items-center mx-auto">
                        <!-- Fecha -->
                        <span class="text-gray-800">Fecha estado pago</span>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                            </div>
                            <input datepicker datepicker-autohide datepicker-format="yyyy-mm-dd" value="{{ $estado_pago->fecha }}" type="text" name="fecha" id="fecha" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-4" placeholder="Fecha">
                        </div>
                        <!-- Avance programado 
                        <span class="text-gray-800">Avance programado</span>
                        <input type="number" name="avance_programado" id="avance_programado" value={{$estado_pago->avance_programado}} class="flex text-sm text-gray-500 mb-4">
                        -->
                        <!-- Avance actual -->
                        <span class="text-gray-800">Avance actual</span>
                        <input type="number" name="avance_actual" id="avance_actual" value={{$estado_pago->avance_actual}} class="flex text-sm text-gray-500 mb-4">
                        <!-- Archivo adjunto -->
                        <input type="hidden" name="old_archivo" id="old_archivo" class="invisible" value={{$estado_pago->pathfile}}>
                        <input type="file" name="archivo" id="archivo" class="flex text-sm text-gray-500">
                    </div>
                </div>
                <!-- alerta -->
                <div id="alertErrorEdit" class="invisible flex p-4 mb-4 text-yellow-700 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
                    <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Info</span>
                    <div class="ml-3 text-sm font-medium">
                    Los campos de avance solo pueden contener numeros!
                    </div>
                    
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button data-modal-hide="editEPModal{{ $estado_pago->id }}" type="submit" id="acceptEditBtn{{ $estado_pago->id }}" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Aceptar
                    </button>
                    <button data-modal-hide="editEPModal{{ $estado_pago->id }}" type="button" id="cancelEditBtn{{ $estado_pago->id }}" class="closeeditEPModal{{ $estado_pago->id }} mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>