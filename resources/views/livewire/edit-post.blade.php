<div>
    <span wire:click="$set('openModal', true)">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 icon-edit">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
        </svg>          
    </span>
    <x-dialog-modal wire:model="openModal">
        <x-slot name="title">
            <span>Editar post</span>
        </x-slot>
        <x-slot name="content">
            <div class="my-4">
                <x-label value="Ingresa el titulo del post" />
                <x-input type="text" class="w-full mt-2" wire:model="post.title"/>
                <x-input-error for="post.title" />
            </div>
            <div class="my-4">
                <x-label value="Ingresa el contenido del post" />
                <x-text-area class="mt-2" wire:model="post.description"/>
                <x-input-error for="post.description" />
            </div>
            <div class="my-4">
                <x-label value="Ingresa la categoria del post" />
                <x-input type="text" class="w-full mt-2" wire:model="post.tag"/>
                <x-input-error for="post.tag" />
            </div>
            <div class="my-4">
                <x-label value="Ingresa la puntuación dada" />
                <x-input type="number" class="w-full mt-2" max="10" min="0" wire:model="post.ranking" />
                <x-input-error for="post.ranking" />
            </div>
            <div class="my-4">
                <x-label value="Carga la portada de tu publicación" />
                <x-input type="file" class="w-full mt-2" id="{{$resetInputFile}}" wire:model="image" />
                <x-input-error for="image" />
            </div>
            <div class="my-4 flex flex-col justify-center">
                <div class="mb-4" wire:loading wire:target="image">
                    <div class="text-center">
                        <span class="text-lg font-medium">Cargando nueva imagen...</span>
                    </div>
                    <div class="flex justify-center mt-4">
                        <span class="inline-block animate-spin" >
                            <svg xmlns="http://www.w3.org/2000/svg" height="4em" viewBox="0 0 512 512" fill="blue">
                              <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                              <path d="M222.7 32.1c5 16.9-4.6 34.8-21.5 39.8C121.8 95.6 64 169.1 64 256c0 106 86 192 192 192s192-86 192-192c0-86.9-57.8-160.4-137.1-184.1c-16.9-5-26.6-22.9-21.5-39.8s22.9-26.6 39.8-21.5C434.9 42.1 512 140 512 256c0 141.4-114.6 256-256 256S0 397.4 0 256C0 140 77.1 42.1 182.9 10.6c16.9-5 34.8 4.6 39.8 21.5z" />
                            </svg>
                        </span>
                    </div>
                </div>
                @if ($image)
                    <img src="{{$image->temporaryUrl()}}">
                @else 
                    <img src="{{Storage::url($post->image)}}" >
                @endif
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-button class="mr-4" wire:click="$set('openModal', false)">
                Cancelar
            </x-button>
            <x-secondary-button wire:click="save" wire:loading.attr="disabled" wire:target="save, image">
                Guardar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>
