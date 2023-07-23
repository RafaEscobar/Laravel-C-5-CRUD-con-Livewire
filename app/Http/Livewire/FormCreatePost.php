<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class FormCreatePost extends Component
{

    public $openModal = false;
    public $title, $description, $tag, $ranking;

    protected $rules = [
        'title' => 'required|max:15',
        'description' => 'required|min:30',
        'tag' => 'required',
        'ranking' => 'required'
    ];

    protected $messages = [
        '*.required' => 'El campo es requerido',
        'title.max' => 'El titulo debe tener como maximo 10 caracteres',
        'description.min' => 'La descripción debe tener como minimo 30 caracteres',
    ];
    
    public function updated($property){
        $this->validateOnly($property);
    }

    public function render()
    {
        return view('livewire.form-create-post');
    }
    
    public function create() 
    {

        $this->validate();

        Post::create([
            'title' => $this->title,
            'description' => $this->description,
            'tag' => $this->tag,
            'ranking' => $this->ranking
        ]);
        
        $this->reset(['openModal', 'title', 'description', 'tag', 'ranking']);

        $this->emit('createPost');
        $this->emit('alert', 'Registro generado exitosamente!!!');
    }
}
