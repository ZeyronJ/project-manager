<div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
    <x-jet-nav-link class="underline" href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
        {{ __('Dashboard') }}
    </x-jet-nav-link>
    <x-jet-nav-link class="underline" href="{{ route('admin.users') }}" :active="request()->routeIs('admin.users')">
        {{ __('Usuarios') }}
    </x-jet-nav-link>
    <x-jet-nav-link href="{{ route('admin.roles') }}" :active="request()->routeIs('admin.roles')">
        {{ __('Roles') }}
    </x-jet-nav-link>
</div>