<div class="">
    <x-danger-button wire:click="$set('openModal', true)">
        Crear nuevo post
    </x-danger-button>
    <x-dialog-modal wire:model="openModal">
        <x-slot name="title">
            Crear un nuevo post
        </x-slot>
        <x-slot name="content">
            <div class="my-4">
                <x-label value="Ingresa el titulo del post" />
                <x-input type="text" class="w-full mt-2" wire:model="title"/>
            </div>
            <x-input-error for="title" />
            <div class="my-4">
                <x-label value="Ingresa el contenido del post" />
                <x-text-area class="mt-2" wire:model="description"/>
            </div>
            <x-input-error for="description" />
            <div class="my-4">
                <x-label value="Ingresa la categoria del post" />
                <x-input type="text" class="w-full mt-2" wire:model="tag"/>
            </div>
            <x-input-error for="tag" />
            <div class="my-4">
                <x-label value="Ingresa la puntuación dada" />
                <x-input type="number" class="w-full mt-2" max="10" min="0" wire:model="ranking" />
            </div>
            <x-input-error for="ranking" />
        </x-slot>
        <x-slot name="footer">
            <x-button class="mr-4" wire:click="$set('openModal', false)">
                Cancelar
            </x-button>
            <x-secondary-button wire:click="create" wire:loading.remove wire:target="create">
                Guardar
            </x-secondary-button>
            <div class="flex justify-center items-center">
                <span class="text-green-500 font-semibold ml-2" wire:loading wire:target="create">Cargando...</span>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
