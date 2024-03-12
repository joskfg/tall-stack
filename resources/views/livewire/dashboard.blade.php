<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="flex flex-col p-6 text-gray-900 gap-5 items-center">
                <h1 class="text-xl font-bold text-center"><i class="fas fa-list"></i> Todo Lists</h1>
                <div class="flex flex-col gap-3 w-1/2 cursor-pointer">
                    @foreach($todoLists as $todoList)
                        <div class="flex items-center justify-between w-full">
                            <a href="{{ route('todo-list', ['todoList' => $todoList->id]) }}" wire:navigate.hover
                               class="flex justify-start border border-gray-500 p-3 rounded-md hover:bg-green-100 items-center w-full">
                                <i class="fas fa-list mr-6"></i><span>{{ $todoList->name }}</span>
                            </a>
                            <i class="fas fa-trash text-red-500 hover:text-red-900 h-full ml-4" wire:click="delete({{ $todoList->id }})" wire:confirm="Are you sure you want to delete it?"></i>
                        </div>
                    @endforeach
                    <input
                        type="text"
                        @class([
                            "w-full border p-3 rounded-md",
                            'border-red-500'  => $errors->has('newList'),
                            'border-gray-500' => $errors->missing('newList'),
                             ])
                        placeholder="Type your new todo list..."
                        wire:model.live.debounce="newList"
                        wire:keydown.enter="addList"
                    >
                    @error ('newList') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>
</div>
