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

    public function mount(Post $post){
        $this->post = $post;
        $this->openModal = false;
    }

    protected $rules = [
        'post.title' => 'required',
        'post.description' => 'required',
        'post.tag' => 'required',
        'post.ranking' => 'required',
    ];


    public function render()
    {
        return view('livewire.edit-post');
    }
}
