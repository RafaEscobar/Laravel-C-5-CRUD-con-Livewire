<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class EditPost extends Component
{

    public $post;
    public $openModal;

    public function mount(Post $post){
        $this->post = $post;
        $this->openModal = false;
    }

    public function render()
    {
        return view('livewire.edit-post');
    }
}
