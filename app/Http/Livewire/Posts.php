<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Posts extends Component
{
    use WithFileUploads;

    public $search;
    public $element;
    public $ord;
    public $posts;
    //!1
    public $post;
    public $openModalEdit;
    public $resetInputFile;
    public $image;

    //!2
    protected $listeners = ['mount'];

    //!3
    public function mount()
    {
        $this->element = 'id';
        $this->ord = 'desc';
        $this->openModalEdit = false;
        $this->resetInputFile = rand();
        $this->generateContent();
    }
    
    public function updatedSearch()
    {
        $this->generateContent();
    }

    //!4
    public function generateContent(){
        $this->posts = Post::where('title', 'like', "%$this->search%")->orWhere('tag', 'like', "%$this->search%")->orderBy($this->element, $this->ord)->get();
    }

    //!5
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
        //!6
        $this->generateContent();
    }

    //!7 Reglas, mensajes y validacion en tiempo real
    protected $rules = [ 
        'post.title' => 'required|max:15',
        'post.description' => 'required|min:30',
        'post.tag' => 'required',
        'post.ranking' => 'required',
    ];

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

    //!8
    public function openEdit(Post $post)
    {
        $this->post = $post;
        $this->openModalEdit = true; 
    }

    //! 9
    public function update()
    {
        $this->validate();

        if ( $this->image ) {
            Storage::delete(([$this->post->image]));
            $this->post->image = $this->image->store('public/posts');
        }

        $this->post->save();
        
        $this->reset(['openModalEdit', 'image']);
        $this->resetInputFile = rand();

        $this->emit('alert', 'Registro actualizado exitosamente!!!');

        $this->generateContent();
    }
}
