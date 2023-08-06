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
            <div class="my-4">
                <x-label value="Carga la portada de tu publicación" />
                <x-input type="file" class="w-full mt-2" id="{{$resetInputFile}}" max="10" min="0" wire:model="image" />
            </div>
            <x-input-error for="image" />
            <div class="my-4 flex justify-center" >
                @if ($image)                    
                    <img src="{{$image->temporaryUrl()}}">
                @endif
                <div class="flex" wire:loading wire:target="image">
                    <span class="text-lg font-medium">Cargando imagen...</span>
                    <div class="flex justify-center mt-4">
                        <span class="inline-block animate-spin" >
                            <svg xmlns="http://www.w3.org/2000/svg" height="4em" viewBox="0 0 512 512" fill="blue">
                              <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                              <path d="M222.7 32.1c5 16.9-4.6 34.8-21.5 39.8C121.8 95.6 64 169.1 64 256c0 106 86 192 192 192s192-86 192-192c0-86.9-57.8-160.4-137.1-184.1c-16.9-5-26.6-22.9-21.5-39.8s22.9-26.6 39.8-21.5C434.9 42.1 512 140 512 256c0 141.4-114.6 256-256 256S0 397.4 0 256C0 140 77.1 42.1 182.9 10.6c16.9-5 34.8 4.6 39.8 21.5z" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-button class="mr-4" wire:click="$set('openModal', false)">
                Cancelar
            </x-button>
            <x-secondary-button wire:click="create" wire:loading.attr="disabled" wire:target="create, image">
                Guardar
            </x-secondary-button>
            {{-- <div class="flex justify-center items-center">
                <span class="text-green-500 font-semibold ml-2" wire:loading wire:target="create">Cargando...</span>
            </div> --}}
        </x-slot>
    </x-dialog-modal>
</div>
