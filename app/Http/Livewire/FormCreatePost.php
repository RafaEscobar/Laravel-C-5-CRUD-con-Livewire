<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class FormCreatePost extends Component
{

    public $openModal = false;
    public $title, $description, $tag, $ranking;

    public function render()
    {
        return view('livewire.form-create-post');
    }
    
    public function create() 
    {
        Post::create([
            'title' => $this->title,
            'description' => $this->description,
            'tag' => $this->tag,
            'ranking' => $this->ranking
        ]);
        
        $this->reset(['openModal', 'title', 'description', 'tag', 'ranking']);

        $this->emit('createPost');
    }
}
