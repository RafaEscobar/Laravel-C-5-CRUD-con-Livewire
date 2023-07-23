<div class="w-full bg-slate-400">
    <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
        <header class="px-5 py-4 border-b border-gray-100 flex">
            <h2 class="font-semibold text-gray-800">Posts</h2>
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
            <div class="overflow-x-auto">
                @if ($posts->count())
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
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @foreach ($posts as $post)
                                <tr>
                                    <td class="p-2">
                                        <div class="text-left">{{ $post->title }}</div>
                                    </td>
                                    <td class="p-2">
                                        <div class="text-left">{{ Str::limit($post->description, 50) }}</div>
                                    </td>
                                    <td class="p-2">
                                        <div class="text-left font-medium text-green-500">{{ $post->tag }}</div>
                                    </td>
                                    <td class="p-2">
                                        <div class="text-lg text-center">{{ $post->ranking }}</div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div>
                        <p class="text-md font-light text-red-700">No se encontraron coincidencias.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
