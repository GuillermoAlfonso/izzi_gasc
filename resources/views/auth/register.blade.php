<x-guest-layout>
    @include('auth.navguest')    
    <x-auth-card>

        <x-slot name="logo">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Registrar usuario') }}
            </h2>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="nombre" :value="__('Nombre')" />

                <x-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre')" autofocus />
            </div>

            <!-- Apellido Paterno -->
            <div class="mt-4">
                <x-label for="apellido_paterno" :value="__('Apellido Paterno')" />

                <x-input id="apellido_paterno" class="block mt-1 w-full" type="text" name="apellido_paterno" :value="old('apellido_paterno')" autofocus />
            </div>

            <!-- Apellido Materno -->
            <div class="mt-4">
                <x-label for="apellido_materno" :value="__('Apellido Materno')" />

                <x-input id="apellido_materno" class="block mt-1 w-full" type="text" name="apellido_materno" :value="old('apellido_materno')" autofocus />
            </div>

            <!-- Nombre Usuario -->
            <div class="mt-4">
                <x-label for="nombre_usuario" :value="__('Nombre de Usuario')" />

                <x-input id="nombre_usuario" class="block mt-1 w-full" type="text" name="nombre_usuario" :value="old('nombre_usuario')" required max="12" />
            </div>

            <!-- Contraseña -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" min="10" max="15" />
            </div>

            <!-- Estado -->
            <div class="mt-4">
                <x-label for="comentarios" :value="__('Perfil')" />
                <div>
                    <div class="form-check">
                        <input
                            class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                            type="radio" name="radio" id="capturista" value="1">
                        <label class="form-check-label inline-block text-gray-800" for="capturista">
                            Capturista
                        </label>
                    </div>
                    <div class="form-check">
                        <input
                            class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                            type="radio" name="radio" id="gestor" value="2" >
                        <label class="form-check-label inline-block text-gray-800" for="gestor">
                            Gestor
                        </label>
                    </div>
                    <div class="form-check">
                        <input
                            class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                            type="radio" name="radio" id="administrador" value="3">
                        <label class="form-check-label inline-block text-gray-800" for="administrador">
                            Administrador
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center justify-end mt-4">
                
                <x-button class="ml-4">
                    {{ __('Registrar') }}
                </x-button>
            </div>
        </form>        
    </x-auth-card>
</x-guest-layout>

