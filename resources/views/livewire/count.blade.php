<div class="flex flex-col items-center" x-data="{count: @entangle('count') }">
    <div class="flex mb-8 gap-8">
        <div>
            <span>Contador Livewire: {{$count}}</span>
        </div>
        <div>
            <span>Contador AlpineJS: <span x-text="count"></span> </span>
        </div>
    </div>
    <div class="flex gap-8">
        <div>
            <a wire:click="countIncrement" class="bg-blue-500 text-white p-2 rounded-xl cursor-pointer">Livewire +</a>
        </div>
        <div>
            <a @click="count++" class="bg-blue-500 text-white p-2 rounded-xl cursor-pointer">Contador AlpineJS:</a>
        </div>
    </div>
</div>
