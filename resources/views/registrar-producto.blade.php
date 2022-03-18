<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registro de productos') }}
        </h2>
    </x-slot>

    <x-auth-card>
        <x-slot name="logo">

        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('registrar_producto') }}">
            @csrf

            <!-- Nombre del producto -->
            <div>
                <x-label for="nombre_producto" :value="__('Nombre del producto')" />

                <x-input id="nombre_producto" class="block mt-1 w-full" type="text" name="nombre_producto"
                    :value="old('nombre_producto')" required autofocus />
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
                <select
                    class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    aria-label="Default select example" name="categoria_id">
                    @foreach ($categorias as $item)
                        <option value="{{ $item->id }}">{{ $item->nombre_categoria }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Sucursal -->
            <div class="mt-4">
                <x-label for="sucursal" :value="__('Sucursal')" />
                <select
                    class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    aria-label="Default select example" name="sucursal_id">
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
