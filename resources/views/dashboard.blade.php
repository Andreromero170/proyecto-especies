<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.5rem; color: #168535; text-align: center;">
            {{ __('NarancoBioExplorer') }}
        </h2>
    </x-slot>

    @if (Route::has('login'))
    <div style="position: fixed; top: 0; right: 0; padding: 1.5rem; text-align: right; z-index: 10;">
        @auth
            <a href="{{ url('/') }}" style="font-weight: 600; color: #4A5568; text-decoration: none;">
                Inicio
            </a>
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" style="margin-left: 1rem; font-weight: 600; color: #4A5568; background: none; border: none;">
                    {{ __('Log Out') }}
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" style="font-weight: 600; color: #4A5568; text-decoration: none;">
                Login
            </a>
        @endauth
    </div>
@endif


    <div style="max-width: 1120px; margin: 0 auto; padding: 20px;">
        <div style="background-color: #10B981; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <div style="display: flex; justify-content: center; gap: 20px; margin-top: 20px;">
                <a href="{{ route('crear-token') }}"
                    style="display: flex; align-items: center; background-color:rgb(241, 241, 241); color: black; font-weight: bold; padding: 10px 20px; border-radius: 5px; text-decoration: none; transition: background 0.3s;">
                    🔑 Generar Token
                </a>
                <a href="{{ route('token.view') }}"
                   style="display: flex; align-items: center; background-color: #047857; color: white; font-weight: bold; padding: 10px 20px; border-radius: 5px; text-decoration: none; transition: background 0.3s;">
                    🔑 Ir a botón Crear token
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
