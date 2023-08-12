<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
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

    //* Mensajes de validación
    protected $messages = [
        'post.*.required' => 'El campo es requerido',
        'post.title.max' => 'El titulo debe tener como maximo 10 caracteres',
        'post.description.min' => 'La descripción debe tener como minimo 30 caracteres',
        'image.image' => 'El archivo cargado no es una imagen',
        'image.max' => 'El tamaño maximo de la imagen es de 2mb'
    ];

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function save()
    {
        //! Validamos todos los campos una ves se de click en guardar el registro
        $this->validate();

        //! Almacenamos la imagen en el disco publico en /posts
        if ( $this->image ) {
            Storage::delete(([$this->post->image]));
            $this->post->image = $this->image->store('public/posts');
        }

        //! Generamos el registro
        $this->post->save();
        
        //! Reseteamos el valor de las variables a su estado original
        $this->reset(['openModal', 'image']);
        $this->resetInputFile = rand();

        //! Emitimos el evento createPost
        $this->emit('createPost');

        //! Emitimos una alerta con un mensaje dado
        $this->emit('alert', 'Registro actualizado exitosamente!!!');
    }

    public function render()
    {
        return view('livewire.edit-post');
    }
}
