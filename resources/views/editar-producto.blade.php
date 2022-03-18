<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar producto: {{ $producto->nombre }}
        </h2>
    </x-slot>

    <x-auth-card>
        <x-slot name="logo">

        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('form-editar-producto') }}">
            @csrf

            <x-input id="id_producto" type="text" name="id_producto" value="{{ old('id', $producto->id) }}" hidden />

            <!-- Nombre del producto -->
            <div>
                <x-label for="nombre_producto" :value="__('Nombre del producto')" />

                <x-input class="block mt-1 w-full" type="text" name="nombre_producto"
                    value="{{ old('nombre_producto', $producto->nombre) }}" required autofocus disabled />
            </div>

            <!-- Descripción -->
            <div class="mt-4">
                <x-label for="descripcion" :value="__('Descripción')" />
                <x-input class="block mt-1 w-full" type="text" name="descripcion"
                    value="{{ old('descripcion', $producto->descripcion) }}" required autofocus disabled />
            </div>

            <!-- Categoría -->
            <div class="mt-4">
                <x-label for="categoria" :value="__('Categoría')" />
                <x-input class="block mt-1 w-full" type="text" name="categoria"
                    value="{{ old('categoria', $producto->getCategoria->nombre_categoria) }}" required autofocus
                    disabled />
            </div>

            <!-- Sucursal -->
            <div class="mt-4">
                <x-label for="sucursal" :value="__('Sucursal')" />
                <x-input class="block mt-1 w-full" type="text" name="sucursal"
                    value="{{ old('sucursal', $producto->getSucursal->nombre_sucursal) }}" required autofocus
                    disabled />
            </div>

            <!-- Precio -->
            <div class="mt-4">
                <x-label for="precio" :value="__('Precio')" />
                <x-input class="block mt-1 w-full" type="number" name="precio"
                    value="{{ old('precio', $producto->precio) }}" required autofocus disabled />
            </div>

            <!-- Fecha de compra -->
            <div class="mt-4">
                <x-label for="fecha_compra" :value="__('Fecha de compra')" />
                <x-input class="block mt-1 w-full" type="date" name="fecha_compra"
                    value="{{ $producto->fecha_compra->format('Y-m-d') }}" required autofocus disabled />
            </div>

            <!-- Comentarios -->
            <div class="mt-4">
                <x-label for="comentarios" :value="__('Comentarios')" />
                <x-input id="comentarios" class="block mt-1 w-full" type="text" name="comentarios"
                    value="{{ old('comentarios', $producto->comentarios) }}" required />
            </div>

            <!-- Estado -->
            <div class="mt-4">
                <x-label for="comentarios" :value="__('Estado')" />
                <div>
                    <div class="form-check">
                        <input required
                            class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                            type="radio" name="radio" id="abierto" value="1"
                            {{ $producto->estado == '1' ? 'checked' : '' }}>
                        <label class="form-check-label inline-block text-gray-800" for="abierto">
                            Abierto
                        </label>
                    </div>
                    <div class="form-check">
                        <input
                            class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                            type="radio" name="radio" id="cerrado" value="0"
                            {{ $producto->estado == '0' ? 'checked' : '' }}>
                        <label class="form-check-label inline-block text-gray-800" for="cerrado">
                            Cerrado
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Guardar') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
    <br>
</x-app-layout>
