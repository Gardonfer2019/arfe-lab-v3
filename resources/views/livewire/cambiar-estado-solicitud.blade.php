<div>
    <form wire:submit.prevent="actualizarEstado">
        <label for="estado" class="block font-semibold text-gray-700 dark:text-gray-200">Cambiar Estado:</label>
        <select id="estado" wire:model="estado" class="form-select mt-1 block w-full border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200">
            <option value="pendiente">Pendiente</option>
            <option value="completado">Completado</option>
            <option value="cancelado">Cancelado</option>
        </select>

        <!-- Botón para actualizar el estado con nuevo color e ícono -->
        <button type="submit" class="mt-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            Actualizar Estado
        </button>

        <!-- Mensaje de éxito -->
        @if (session()->has('message'))
            <div class="mt-4 text-green-500">
                {{ session('message') }}
            </div>
        @endif
    </form>
</div>
