<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class Posts extends Component
{
    public $search;
    public $element;
    public $ord;
    public $posts;
    //!1
    public $post;
    public $openModalEdit;
    public $resetInputFile;
    public $image;

    protected $listeners = ['createPost' => 'render'];

    
    public function mount()
    {
        $this->element = 'id';
        $this->ord = 'desc';
        $this->openModalEdit = false;
        $this->resetInputFile = rand();
        $this->image = new Post();
        $this->posts = Post::where('title', 'like', '%' . $this->search . '%')->orWhere('tag', 'like', '%' . $this->search . '%')->orderBy($this->element, $this->ord)->get();
    }
    
    public function render()
    {
        return view('livewire.posts');
    }


    public function order($element)
    {
        if ($this->element == $element) {
            if ($this->ord == 'desc') {
                $this->ord = 'asc';
            } else {
                $this->ord = 'desc';
            }
        } else {
            $this->element = $element;
            $this->ord = 'asc';
        }
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

    //!2
    public function edit(Post $post)
    {
        $this->post = $post;
        // $this->openModalEdit = true; 
    }

}
