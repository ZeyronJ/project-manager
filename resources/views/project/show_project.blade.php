<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <!-- Navigation Links -->
                <x-nav-links project="{{ $project->id }}" dirname="{{ $project->pathfile }}" />
                    
                <!-- Utilities -->
                <div class="flex flex-row justify-center gap-3 items-center p-4 sm:-my-px sm:ml-10">
                    <div class="bg-gray-50 p-10 rounded-md border-black border-2 flex justify-between flex-col">
                        
                        <div class="flex p-2 justify-between">
                            <label class="mr-10">Nombre</label>
                            <label>{{ $project->nombre }}</label>
                        </div>
                        <div class="flex p-2 justify-between">
                            <label class="mr-10">Costo</label>
                            <label>{{ $project->costo_total }}</label>
                        </div>
                        <div class="flex p-2 justify-between">
                            <label>Fecha inicio</label>
                            <label>{{ $project->fecha_inicio }}</label>
                        </div>
                        <div class="flex p-2 justify-between">
                            <label>Fecha termino</label>
                            <label>{{ $project->fecha_termino }}</label>
                        </div>                        
                        <div class="flex p-2 justify-between">
                            <label class="mr-40">Plazo de Ejecución</label>
                            <label>{{ $project->plazo_de_ejecucion }}</label>
                        </div>
                        <div class="flex p-2 justify-between">
                            <label>Decreto de adjudicación</label>
                            <label>{{ $project->decreto_adjudicacion }}</label>
                        </div>
                        <div class="flex p-2 justify-between">
                            <label>Decreto de aprobación</label>
                            <label>{{ $project->decreto_aprobacion }}</label>
                        </div>
                        <div class="flex p-2 justify-between">
                            <label>Empresa constructora</label>
                            <label>{{ $project->empresa_constructora }}</label>
                        </div>
                        <div class="flex p-2 justify-between">
                            <label>Empresa contratista</label>
                            <label>{{ $project->empresa_contratista }}</label>
                        </div>                
                        <div class="flex p-2 justify-between">
                            <label class="mr-40">Contrato del Proyecto</label>
                            <label>{{ $project->pathfile }}</label>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
