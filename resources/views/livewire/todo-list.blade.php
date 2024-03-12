<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('TodoList') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="flex flex-col p-6 text-gray-900 gap-5 items-center">
                <h1 class="text-xl font-bold text-center"><i class="fas fa-check"></i> {{ $todoList->name }}</h1>
                <div class="flex flex-col gap-3 w-1/2 cursor-pointer">
                    @foreach($todoList->todoItems as $task)
                        <div class="flex items-center w-full justify-between">
                            <div
                                @class([
                                    "flex justify-start items-center border border-gray-500 p-3 rounded-md hover:bg-green-100 shadow w-full",
                                    'bg-green-100' => $task->completed,
                                     ])
                                wire:click="toggleComplete({{ $task->id }})"
                            >
                                <i
                                    @class([
                                        'far mr-6',
                                        'fa-square' => !$task->completed,
                                        'fa-check-square' => $task->completed,
                                        ])
                                ></i><span @class(['line-through' => $task->completed])>{{ $task->title }}</span>
                            </div>
                            <div class="ml-4">
                                <i class="fas fa-trash text-red-500 hover:text-red-900" wire:click.prevent="delete({{ $task->id }})"></i>
                            </div>
                        </div>
                    @endforeach
                    <input type="text"
                           @class([
                                'w-full border p-3 rounded-md',
                                'border-red-500' => $errors->has('newTask'),
                                'border-gray-500' => $errors->missing('newTask'),
                            ])
                           placeholder="Type your new task..."
                           wire:model.live.debounce="newTask" wire:keydown.enter="addTask"
                    >
                    @error('newTask') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>
</div>

