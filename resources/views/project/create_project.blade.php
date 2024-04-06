<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar Proyecto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <!-- Utilities -->
                <div class="flex flex-row justify-center gap-3 items-center p-4 sm:-my-px sm:ml-10">
                    <form class="bg-gray-50 p-12 rounded-md border-black border-2 flex justify-between flex-col" action="{{ route('project.adding') }}" method="POST">
                        @csrf
                        <div class="flex p-2 justify-between">
                            <label class="mr-10">Nombre</label>
                            <input class="w-96" type="text" name="name" value="{{ old('name') }}">                        
                        </div>
                        <div class="flex p-2 justify-between">
                            <label class="mr-10">Costo total</label>
                            <input class="w-96" type="text" name="cost" value="{{ old('cost') }}">                        
                        </div>
                        <div class="flex p-2 justify-between">
                            <label>Fecha inicio</label>
                            <input type="date" name="startdate" value="{{ old('startdate',now()->format('Y-m-d')) }}">
                        </div>
                        <div class="flex p-2 justify-between">
                            <label>Fecha término</label>
                            <input type="date" name="enddate" value="{{ old('enddate',now()->format('Y-m-d')) }}">                        
                        </div>
                        <div class="flex p-2 justify-between">
                            <label>Plazo de ejecución</label>
                            <input type="number" name="plazo_de_ejecucion" value="{{ old('plazo_de_ejecucion') }}">                        
                        </div>
                        <div class="flex p-2 justify-between">
                            <label>Decreto de adjudicación</label>
                            <input type="text" name="decreto_adjudicacion" placeholder="N°" value="{{ old('decreto_adjudicacion') }}">                        
                        </div>
                        <div class="flex p-2 justify-between">
                            <label>Decreto de aprobación</label>
                            <input type="text" name="decreto_aprobacion" placeholder="N°" value="{{ old('decreto_aprobacion') }}">                        
                        </div>
                        <div class="flex p-2 justify-between">
                            <label>Empresa constructora</label>
                            <input type="text" name="empresa_constructora" placeholder="Nombre de constructora" value="{{ old('empresa_constructora') }}">                        
                        </div>
                        <div class="flex p-2 justify-between">
                            <label>Empresa contratista</label>
                            <input type="text" name="empresa_contratista" placeholder="Nombre de contratista" value="{{ old('empresa_contratista') }}">                        
                        </div>
                        <div class="flex p-2 justify-between">
                            <label>Contrato del Proyecto</label>
                            <input type="file" name="projectfile">
                        </div>
                        <input class="cursor-pointer border-gray-500 border-2 rounded hover:bg-gray-200 p-2" type="submit" value="Crear Proyecto">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
