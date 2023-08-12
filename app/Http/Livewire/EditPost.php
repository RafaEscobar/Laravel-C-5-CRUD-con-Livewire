<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditPost extends Component
{
    use WithFileUploads;
    public $post;
    public $openModal;
    public $image;
    public $resetInputFile;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->openModal = false;
        $this->resetInputFile = rand();
    }

    protected $rules = [
        'post.title' => 'required|max:15',
        'post.description' => 'required|min:30',
        'post.tag' => 'required',
        'post.ranking' => 'required',
    ];

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function save()
    {
        $this->validate();

        $image = $this->image->store('posts/');

        //! Generamos el registro
        Post::create([
            'title' => $this->title,
            'description' => $this->description,
            'tag' => $this->tag,
            'ranking' => $this->ranking,
            'image' => $image
        ]);
        
        //! Reseteamos el valor de las variables a su estado original
        $this->reset(['openModal', 'title', 'description', 'tag', 'ranking', 'image']);
        $this->resetInputFile = rand();

        //! Emitimos el evento createPost
        $this->emit('createPost');

        //! Emitimos una alerta con un mensaje dado
        $this->emit('alert', 'Registro generado exitosamente!!!');

    }


    public function render()
    {
        return view('livewire.edit-post');
    }
}
