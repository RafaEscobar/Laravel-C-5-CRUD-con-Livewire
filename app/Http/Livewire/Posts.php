<?php

namespace App\Http\Livewire;

use App\Models\Post;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $search;
    public $element;
    public $ord;
    protected $posts;
    public $post_links;
    public $post;
    public $openModalEdit;
    public $resetInputFile;
    public $image;

    protected $listeners = ['mount'];

    public function mount()
    {
        $this->element = 'id';
        $this->ord = 'desc';
        $this->openModalEdit = false;
        $this->resetInputFile = rand();
    }
    
    public function updatedSearch()
    {
        $this->generateContent();
    }

    public function generateContent(){
        $this->posts = Post::where('title', 'like', "%$this->search%")->orWhere('tag', 'like', "%$this->search%")->orderBy($this->element, $this->ord)->paginate(10);
    }

    public function render()
    {
        $this->generateContent();
        return view('livewire.posts', [
            'posts' => $this->posts,
        ]);
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
        $this->generateContent();
    }

    protected $rules = [ 
        'post.title' => 'required|max:30',
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

    public function openEdit(Post $post)
    {
        $this->post = $post;
        $this->openModalEdit = true; 
    }

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
