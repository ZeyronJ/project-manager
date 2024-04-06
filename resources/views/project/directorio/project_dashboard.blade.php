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

                    <!-- Utilities -->
                    <div class="flex flex-row gap-3 items-center p-4 sm:-my-px sm:ml-10 justify-between">
                        @role('admin|inspector de obra')
                        <div>
                            <button data-modal-target="crear_archivoProyectoModal" data-modal-toggle="crear_archivoProyectoModal" class="cursor-pointer border-gray-500 border-2 rounded hover:bg-gray-200 p-2">                            
                                Subir archivo
                            </button>
                            <button id="deldir_btn" class="cursor-pointer border-gray-500 border-2 rounded hover:bg-gray-200 p-2">                            
                                Eliminar archivo
                            </button>
                            @if( $dirname == $project->nombre )
                            <button data-modal-target="crear_carpetaProyectoModal" data-modal-toggle="crear_carpetaProyectoModal" class="cursor-pointer border-gray-500 border-2 rounded hover:bg-gray-200 p-2">                            
                                Crear Carpeta
                            </button>
                            @endif
                        </div>
                        @endrole
                        <form action="">
                            <input class="focus:border-black" type="search" name="search" placeholder="Archivo o Carpeta">
                            <input class="cursor-pointer border-gray-500 border-2 rounded hover:bg-gray-200 p-2" type="submit" value="Buscar">
                        </form>
                    </div>
                    @include('project/directorio/partials/create_modal_file')
                    @include('project/directorio/partials/create_modal_folder')
                    <div class="bg-white overflow-hidden shadow-md border-gray-300 border-2 rounded sm:rounded-lg p-4">
                        <div class="grid grid-cols-5 justify-between gap-2">
                            @if (isset($folders))
                                @foreach ($folders as $folder)
                                    <div class="flex justify-center border border-gray-300 rounded-md">
                                        <a class="flex justify-center flex-col w-auto p-6 hover:bg-gray-200" href="{{ route('project.home', ['id'=>$project,'dirname' => $dirname.'_'.$folder]) }}">
                                            <img class="w-max" src="{{ Vite::asset('resources/images/icons/folder.png') }}" alt="folder">
                                            <p>{{ $folder }}</p>
                                        </a>
                                        
                                    </div>
                                @endforeach
                            @endif
                                    
                            @if (isset($files))
                                @foreach ($files as $file)
                                    <div class="flex justify-center border border-gray-300 rounded-md">
                                        <a class="flex flex-col w-36 p-6 hover:bg-gray-200" onclick="return confirm('¿Seguro de descargar el archivo {{ $file }} ?')" href="{{ route('project.directorio.download', ['id'=>$project,'name' => $file]) }}">
                                            <img class="w-max" src="{{ Vite::asset('resources/images/icons/file.png') }}" alt="folder">
                                            <p>{{ $file }}</p>
                                        </a>

                                        @role('admin|inspector de obra')
                                        <a class="deleteFile cursor-pointer border-gray-500 hover:bg-gray-200 p-1 h-8" onclick="return confirm('¿Seguro de eliminar el archivo {{ $file }} ?')"  href="{{ route('project.directorio.delete', ['id'=> $project->id, 'name' => $file, 'dirname' => $dirname])}}" hidden>
                                            X
                                        </a>   
                                        @endrole                                
                                    </div>                                
                                @endforeach
                            @endif
                        </div>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ Vite::asset('resources/js/directory_delete.js') }}"></script>
</x-app-layout>
