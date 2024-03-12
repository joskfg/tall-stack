<?php

namespace App\Livewire;

use App\Models\TodoItem;
use Livewire\Attributes\Validate;
use Livewire\Component;

class TodoList extends Component
{
    public \App\Models\TodoList $todoList;

    #[Validate(['required', 'string', 'min:10', 'max:255'])]
    public string $newTask = '';

    public function toggleComplete($todoItemId): void
    {
        $todoItem = TodoItem::find($todoItemId);
        $todoItem->completed = !$todoItem->completed;
        $todoItem->save();
    }

    public function addTask()
    {
        $this->validate();
        $this->todoList->todoItems()->create([
            'title' => $this->newTask,
        ]);

        $this->reset('newTask');
    }

    public function delete($todoItemId)
    {
        $todoItem = TodoItem::find($todoItemId);
        $this->authorize('delete', $todoItem);
        $todoItem->delete();
    }

    public function render()
    {
        $this->authorize('view', $this->todoList);

        return view('livewire.todo-list');
    }
}
