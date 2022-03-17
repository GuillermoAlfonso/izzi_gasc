<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>

    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
        <div class="flex items-center">
            <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">Nuevos productos</div>
        </div>
    </div>

    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{route('registrar_producto')}}">
            @csrf

            <!-- Nombre del producto -->
            <div>
                <x-label for="nombre_producto" :value="__('Nombre del producto')" />

                <x-input id="nombre_producto" class="block mt-1 w-full" type="text" name="nombre_producto" :value="old('nombre_producto')" required
                    autofocus />
            </div>

            <!-- Descripción -->
            <div class="mt-4">
                <x-label for="descripcion" :value="__('Descripción')" />
                <x-input id="descripcion" class="block mt-1 w-full" type="text" name="descripcion"
                    :value="old('descripcion')" required autofocus />
            </div>
            

            <!-- Categoría -->
            <div class="mt-4">
                <x-label for="categoria" :value="__('Categoría')" />

                <select class="form-control" name="categoria_id">
                    @foreach ($categorias as $item)
                        <option value="{{ $item->id }}">{{ $item->nombre_categoria }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Sucursal -->
            <div class="mt-4">
                <x-label for="sucursal" :value="__('Sucursal')" />

                <select class="form-control" name="sucursal_id">
                    @foreach ($sucursales as $item)
                        <option value="{{ $item->id }}">{{ $item->nombre_sucursal }}</option>
                    @endforeach
                </select>

            </div>

            <!-- Precio -->
            <div class="mt-4">
                <x-label for="precio" :value="__('Precio')" />
                <x-input id="precio" class="block mt-1 w-full" type="number" name="precio" :value="old('precio')"
                    required autofocus />
            </div>

            <!-- Fecha de compra -->
            <div class="mt-4">
                <x-label for="fecha_compra" :value="__('Fecha de compra')" />
                <x-input id="fecha_compra" class="block mt-1 w-full" type="date" name="fecha_compra"
                    :value="old('fecha_compra')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Registrar') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>
