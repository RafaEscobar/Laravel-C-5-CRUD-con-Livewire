<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class Posts extends Component
{
    public $search, $element = 'id', $ord = 'asc';

    public function render()
    {
        $posts = Post::where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('tag', 'like', '%' . $this->search . '%')
                        ->orderBy($this->element, $this->ord)
                        ->get();
        return view('livewire.posts', compact('posts'));
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
}
