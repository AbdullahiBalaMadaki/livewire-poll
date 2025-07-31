<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Poll;

class CreatePoll extends Component
{
    public $title;
    public $options = ['First'];
    public function render()
    {
        return view('livewire.create-poll');
    }

    public function addOption()
    {
        $this->options[] = '';
    }

     public function removeOption($index)
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }

    public function createPoll()
    {
        Poll::create([
            'title' => $this->title
       ])->options()->createMany(
        collect($this->options)
            ->map(fn($option) => ['name' => $option])
            ->all()
    );

        $this->reset(['title', 'options']);
    }

// public function mount()
// {

// }
}
