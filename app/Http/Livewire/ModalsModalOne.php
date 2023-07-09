<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class ModalsModalOne extends Component
{

    public $despedida, $saludo, $name;

    public function mount($posdata = '')
    {
        $this->despedida = $posdata;
    }

    public function render()
    {
        $posts = Post::all();
        return view('livewire.modals-modal-one', compact('posts'));
    }
}
