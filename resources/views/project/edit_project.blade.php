<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Editar Proyecto' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <!-- Utilities -->
                <div class="flex flex-row justify-center gap-3 items-center p-4 sm:-my-px sm:ml-10">
                    <form class="bg-gray-50 p-12 rounded-md border-black border-2 flex justify-between flex-col" action="{{ route('project.editting',$project) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="flex p-2 justify-between">
                            <label class="mr-10">Nombre</label>
                            <input class="w-96 bg-gray-200" type="text" name="name" value="{{ old('name',$project->nombre) }}" readonly>                        
                        </div>
                        <div class="flex p-2 justify-between">
                            <label class="mr-10">Costo total</label>
                            <input class="w-96 bg-gray-200" type="text" name="cost" value="{{ $project->costo_total }}" readonly>                        
                        </div>
                        <div class="flex p-2 justify-between">
                            <label>Fecha inicio</label>
                            <input class="bg-gray-200" type="date" name="startdate" value="{{ $project->fecha_inicio }}" readonly>
                        </div>
                        <div class="flex p-2 justify-between">
                            <label>Fecha término</label>
                            <input class="bg-gray-200" type="date" name="enddate" value="{{ $project->fecha_termino }}" readonly>                        
                        </div>
                        <div class="flex p-2 justify-between">
                            <label>Plazo de ejecución</label>
                            <input type="number" name="plazo_de_ejecucion" value="{{ old('plazo_de_ejecucion',$project->plazo_de_ejecucion) }}" readonly>                        
                        </div>
                        <div class="flex p-2 justify-between">
                            <label>Decreto de adjudicación</label>
                            <input type="text" name="decreto_adjudicacion" placeholder="N°" value="{{ old('decreto_adjudicacion',$project->decreto_adjudicacion) }}" required>
                        </div>
                        <div class="flex p-2 justify-between">
                            <label>Decreto de aprobación</label>
                            <input type="text" name="decreto_aprobacion" placeholder="N°" value="{{ old('decreto_aprobacion',$project->decreto_aprobacion) }}" required>
                        </div>
                        <div class="flex p-2 justify-between">
                            <label>Empresa constructora</label>
                            <input type="text" name="empresa_constructora" placeholder="Nombre de constructora" value="{{ old('empresa_constructora',$project->empresa_constructora) }}" required> 
                        </div>
                        <div class="flex p-2 justify-between">
                            <label>Empresa contratista</label>
                            <input type="text" name="empresa_contratista" placeholder="Nombre de contratista" value="{{ old('empresa_contratista',$project->empresa_contratista) }}" required>
                        </div>
                        <input class="cursor-pointer border-gray-500 border-2 rounded hover:bg-gray-200 p-2" type="submit" value="Editar Proyecto">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
