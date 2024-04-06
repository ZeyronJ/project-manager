<div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
    <x-jet-nav-link class="underline" href="{{ route('project.home', ['id'=>$project,'dirname' => $dirname]) }}" :active="request()->routeIs('home')">
        {{ __('Directorio') }}
    </x-jet-nav-link>
    <x-jet-nav-link href="{{ route('project.show', ['id' => $project]) }}" :active="request()->routeIs('project.show')">
        {{ __('Información') }}
        @if (session("notificaciones_proyecto_fecha_limite_".$project))
            <span class="flex w-2 h-2 bg-red-500 rounded-full mb-2">
        @endif
    </x-jet-nav-link>
    <x-jet-nav-link href="{{ route('project.estados_pago', ['id' => $project]) }}" :active="request()->routeIs('project.estados_pago')">
        {{ __('Estados Pago') }}
    </x-jet-nav-link>
    <x-jet-nav-link href="{{ route('project.boletas', ['id' => $project]) }}" :active="request()->routeIs('project.boletas')">
        {{ __('Boletas') }}
        @if (session("notificaciones_boletas_por_vencer_proyecto"))
            <span class="flex w-2 h-2 bg-red-500 rounded-full mb-2">
        @endif
    </x-jet-nav-link>
    <x-jet-nav-link href="{{ route('project.modificacion.index', ['id' => $project]) }}" :active="request()->routeIs('project.modificacion')">
        {{ __('Modificaciones') }}
        @if (session("notificaciones_modificacion_fecha_limite_".$project))
            <span class="flex w-2 h-2 bg-red-500 rounded-full mb-2">
        @endif
    </x-jet-nav-link>
</div>