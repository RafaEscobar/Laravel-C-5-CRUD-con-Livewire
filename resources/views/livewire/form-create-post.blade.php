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
                <x-input type="text" class="w-full mt-2" wire:model.defer="title"/>
            </div>
            <div class="my-4">
                <x-label value="Ingresa el tcontenido del post" />
                <x-text-area class="mt-2" wire:model.defer="description"/>
            </div>
            <div class="my-4">
                <x-label value="Ingresa la categoria del post" />
                <x-input type="text" class="w-full mt-2" wire:model.defer="tag"/>
            </div>
            <div class="my-4">
                <x-label value="Ingresa la puntuación dada" />
                <x-input type="number" class="w-full mt-2" max="10" min="0" wire:model.defer="ranking" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-button class="mr-4" wire:click="$set('openModal', false)">
                Cancelar
            </x-button>
            <x-secondary-button wire:click="create">
                Guardar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

</div>
