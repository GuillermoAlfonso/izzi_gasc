<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="usuario" :value="__('Usuario')" />

                <x-input id="usuario" class="block mt-1 w-full" type="text" name="usuario" :value="old('usuario')" max="12" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="contrasena" :value="__('Contraseña')" />

                <x-input id="contrasena" class="block mt-1 w-full"
                                type="password"
                                name="contrasena"
                                required autocomplete="current-password"
                                max="15" min="10" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Recuérdame ') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">                
                <x-button class="ml-3">
                    {{ __('Acceder') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
