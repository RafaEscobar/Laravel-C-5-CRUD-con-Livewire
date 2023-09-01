<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormCreatePost extends Component
{
    //* Usos 
    use WithFileUploads;

    //* Variables generales
    public $openModal = false;
    //* Campos del formulario
    public $title;
    public $description;
    public $tag;
    public $ranking;
    public $image;
    public $resetInputFile;

    public function mount()
    {
        $this->resetInputFile = rand();
    }

    public function render()
    {
        return view('livewire.form-create-post');
    }

    //* Reglas de validación
    protected $rules = [
        'title' => 'required|max:30',
        'description' => 'required|min:30',
        'tag' => 'required',
        'ranking' => 'required',
        'image' => 'required|image|max:2048'
    ];

    //* Mensajes de validación
    protected $messages = [
        '*.required' => 'El campo es requerido',
        'title.max' => 'El titulo debe tener como maximo 10 caracteres',
        'description.min' => 'La descripción debe tener como minimo 30 caracteres',
        'image.image' => 'El archivo cargado no es una imagen',
        'image.max' => 'El tamaño maximo de la imagen es de 2mb'
    ];
    
    //? Funciona como el updatedNomVariable - pero para cualquier variable
    //* Valida cualquier variable-campo que haya sufra un cambio
    public function updated($field)
    {
        //! El campo en cuestion se pasa por parametro
        $this->validateOnly($field);
    }
    
    //* Generamos el registro en base de datos
    public function create() 
    {
        //! Validamos todos los campos una ves se de click en guardar el registro
        $this->validate();

        //! Almacenamos la imagen en el disco publico en /posts
        $image = $this->image->store('public/posts');

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
        $this->emit('mount');

        //! Emitimos una alerta con un mensaje dado
        $this->emit('alert', 'Registro generado exitosamente!!!');
    }

    public function updatedOpenModal()
    {
        $this->reset(['title', 'description', 'tag', 'ranking', 'image']);
        $this->resetInputFile = rand();
    }
}
