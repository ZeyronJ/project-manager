<!-- Main modal -->
<div id="editarBoletaModal{{$boleta->id}}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div class="relative h-full max-w-2xl md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Editar boleta
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="editarBoletaModal{{$boleta->id}}">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6">
                <form class="" id="editarBoleta{{$boleta->id}}" method="POST" enctype="multipart/form-data" action="{{route("project.boletas.update",['id' => $project, 'boleta_id'=>$boleta->id])}}">
                    @csrf @method("PATCH")
                    <label class="block my-1">Glosa</label>
                    <select name="glosa" required>
                        <option value="Flel cumplimiento de contrato" {{ $boleta->glosa == "Flel cumplimiento de contrato" ? "selected" : "" }}>Flel cumplimiento de contrato</option>
                        <option value="Correcta ejecucion de obra" {{ $boleta->glosa == "Correcta ejecucion de obra" ? "selected" : "" }}>Correcta ejecucion de obra</option>
                        <option value="Anticipo" {{ $boleta->glosa == "Anticipo" ? "selected" : "" }}>Anticipo</option>
                    </select>
                    <label class="block my-1">Tipo</label>
                    <select name="type" required>
                        <option value="Boleta de Garantia" {{ $boleta->tipo == "Boleta de Garantia" ? "selected" : "" }}>Boleta de Garantia</option>
                        <option value="Poliza de Seguro" {{ $boleta->tipo == "Poliza de Seguro" ? "selected" : "" }}>Poliza de Seguro</option>
                        <option value="Certificado de Fianza" {{ $boleta->tipo == "Certificado de Fianza" ? "selected" : "" }}>Certificado de Fianza</option>
                    </select>
                    <label class="block my-1">N°<br>
                        <input type="text" name="number" value="{{$boleta->numero}}" required>
                    </label>
                    <label class="block my-1">Monto <br>
                        <input type="number" name="monto" value="{{$boleta->monto}}" required>
                    </label>
                    <label class="inline-block my-1">Fecha inicio <br>
                        <input type="date" name="fecha_inicio" value="{{$boleta->fecha_inicio}}" required>
                    </label>
                    <label class="inline-block my-1">Fecha vencimiento <br>
                        <input type="date" name="fecha_fin" value="{{$boleta->fecha_termino}}" required>
                    </label><br>
                    <label class="block my-1">Documento <p class="inline-block my-1 font-bold">&#40; por defecto:{{end($path)}} &#41;</p><br>
                        <input type="file" name="file">
                    </label>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button form="editarBoleta{{$boleta->id}}" data-modal-hide="editarBoletaModal{{$boleta->id}}" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>
                <button data-modal-hide="editarBoletaModal{{$boleta->id}}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
            </div>
        </div>
    </div>
</div>