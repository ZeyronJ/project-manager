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
                    <form class="bg-gray-50 p-12 rounded-md border-black border-2 flex justify-between flex-col" action="{{ route('project.modificacion.request', ['id' => $project]) }}" method="POST">
                        @csrf
                        {{-- 1 solo plazo, 2 plazo y costo, 3 solo costo  --}}

                        <div class="flex p-2 w-96 justify-between">
                            <div>
                                <label class="mr-10">Tipos:</label>
                            </div>
                            <div>
                                <label>Costo</label>
                                <input class="w-26 bg-gray-200" type="checkbox" name="costo" id="costo">
                                <label>Plazo</label>
                                <input class="w-26 bg-gray-200" type="checkbox" name="plazo" id="plazo">
                            </div>
                        </div>
                        <div class="flex p-2 justify-between">
                            <label>Decreto</label>
                            <input type="text" name="decreto" required>                        
                        </div>  

                        <div class="flex p-2 justify-between" id="costo_input">

                        </div>
                        <div id="plazo_input">

                        </div>
                        <input class="cursor-pointer border-gray-500 border-2 rounded hover:bg-gray-200 p-2" type="submit" value="Solicitar modificación">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ Vite::asset('resources/js/modificationform.js') }}"></script>
</x-app-layout>
