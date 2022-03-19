<x-app-layout>
    <x-slot name="header">
        <h2 class="flex font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Generación de reportes') }}
            <div class="flex justify-end">
                <form method="POST" action="{{ route('descarga_bd') }}">
                    @csrf
                    <x-button name="boton" class="ml-4">
                        {{ __('Descarga masiva') }}
                    </x-button>
                </form>
            </div>
            
        </h2>
    </x-slot>

    <x-auth-card>
        <x-slot name="logo">            
        </x-slot>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('generar_reporte') }}">
                @csrf

                <!-- Fecha de inicio -->
                <div>
                    <x-label for="fecha_inicio" :value="__('Fecha de inicio')" />
                    <x-input id="fecha_inicio" class="block mt-1 w-full" type="date" name="fecha_inicio"
                        :value="old('fecha_inicio')" required autofocus />
                </div>

                <!-- Fecha de fin -->
                <div class="mt-4">
                    <x-label for="fecha_fin" :value="__('Fecha de fin')" />
                    <x-input id="fecha_fin" class="block mt-1 w-full" type="date" name="fecha_fin"
                        :value="old('fecha_fin')" required autofocus />
                </div>                

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-4">
                        {{ __('Descarga por fechas') }}
                    </x-button>
                </div>

            </form>               
    </x-auth-card>
</x-app-layout>
