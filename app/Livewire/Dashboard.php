<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;

class Dashboard extends Component
{
    public $todoLists;

    #[Validate(['required', 'string', 'min:3', 'max:255'])]
    public string $newList = '';

    public function mount(): void
    {
        $this->todoLists = auth()->user()->todoLists;
    }

    public function delete($todoListId)
    {
        $todoList = $this->todoLists->where('id', $todoListId)->first();
        $this->authorize('delete', $todoList);

        $todoList->delete();
        $this->todoLists = $this->todoLists->reject(fn($todoList) => $todoList->id === $todoListId);
    }

    public function addList()
    {
        $this->validate();

        $this->todoLists->push(auth()->user()->todoLists()->create(['name' => $this->newList]));
        $this->reset('newList');
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
