<div class="w-full bg-slate-400" wire:init="loadContent" >
    <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
        <header class="px-5 py-4 border-b border-gray-100 flex">
            <div class="flex flex-col w-64">
                <h2 class="font-semibold text-gray-800 mb-2">Cantidad de registros:</h2>
                {{Form::select('filters', $filters, 'ten', ['class' => 'rounded-2xl border-gray-400', 'wire:model' => 'filter'])}}
            </div>
            <div class="w-full flex justify-end items-center">
                <x-input type="text" placeholder="Ingrese un nombre de post" wire:model="search" class="mr-4" />
                @livewire('form-create-post')
            </div>
        </header>
        @if (!empty($message))
            <div>
                <p class="ml-4 text-green-600 font-semibold">{{$message}}</p>
            </div>
        @endif
        <div class="p-3">
            <div class="">
                @if ( count($posts) )
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                            <tr class="">
                                <th class="p-2">
                                    <div class="flex cursor-pointer" wire:click="order('title')">
                                        <div class=" font-semibold text-left">Titulo</div>
                                        <x-icon-filter colum="title" :element="$element" :ord="$ord" />
                                    </div>
                                </th>
                                <th class="p-2">
                                    <div class="flex cursor-pointer" wire:click="order('description')">
                                        <div class=" font-semibold text-left">Descripción</div>
                                        <x-icon-filter colum="description" :element="$element" :ord="$ord" />
                                    </div>
                                </th>
                                <th class="p-2">
                                    <div class="flex cursor-pointer" wire:click="order('tag')">
                                        <div class="font-semibold text-left">Genero</div>
                                        <x-icon-filter colum="tag" :element="$element" :ord="$ord" />
                                    </div>
                                </th>
                                <th class="p-2">
                                    <div class="flex cursor-pointer" wire:click="order('ranking')">
                                        <div class="font-semibold text-cente">Valoración</div>
                                        <x-icon-filter colum="ranking" :element="$element" :ord="$ord" />
                                    </div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold text-cente">Opciones</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @foreach ($posts as $item)
                                <tr>
                                    <td class="p-2">
                                        <div class="text-left">{{ $item->title }}</div>
                                    </td>
                                    <td class="p-2">
                                        <div class="text-left">{{ Str::limit($item->description, 50) }}</div>
                                    </td>
                                    <td class="p-2">
                                        <div class="text-left font-medium text-green-500">{{ $item->tag }}</div>
                                    </td>
                                    <td class="p-2">
                                        <div class="text-lg text-center">{{ $item->ranking }}</div>
                                    </td>
                                    <td class="p- flex gap-4">
                                        <span wire:click="openEdit({{$item}})">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 icon-edit">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                            </svg>          
                                        </span>
                                        <span wire:click="$emit('deletePost', {{ $item->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 icon-red">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                              </svg>                                              
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ( $posts->hasPages() )    
                        <div class="mt-4">
                            <p>{{$posts->links()}}</p>
                        </div>
                    @endif
                @else
                    @if ($readyToLoad)
                        <div>
                            <p class="text-md font-light text-red-700">No se encontraron coincidencias.</p>
                        </div>
                    @endif                 
                @endif
                <div class="w-full " wire:loading wire:target="loadContent">
                    <div class="w-full flex justify-center">
                        <div class="flex flex-col items-center justify-center">
                            <label class="text-2xl mb-4">Cargando contenido...</label>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 animate-spin">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>                          
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
    <x-dialog-modal wire:model="openModalEdit">
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
                {{--! 12  --}}
                @if ($post)
                    @if ($image)
                        <img src="{{$image->temporaryUrl()}}">
                    @else 
                        <img src="{{Storage::url($post->image)}}" >
                    @endif
                @endif
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-button class="mr-4" wire:click="$set('openModalEdit', false)">
                Cancelar
            </x-button>
            {{--! 13 --}}
            <x-secondary-button wire:click="update" wire:loading.attr="disabled" wire:target="save, image">
                Actualizar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>
