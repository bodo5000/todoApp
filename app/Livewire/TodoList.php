<?php

namespace App\Livewire;

use App\Models\Todo;
use Exception;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;

    #[Rule('required|min:3|max:50')]
    public string $name;

    public string $search = '';

    public $editingTodoId;
    #[Rule('required|min:3|max:50')]

    public string $editingTodoName;

    public function create()
    {

        $formData = $this->validateOnly('name');

        Todo::create($formData);

        $this->reset('name');

        session()->flash('message', 'Todo Has been Created');
        $this->resetPage();
    }

    public function delete($todoId)
    {
        try {
            Todo::findOrFail($todoId)->delete();
        } catch (Exception $e) {
            session()->flash('error', 'some thing miss reload page');
            return;
        }

        session()->flash('todoDeleted', 'todo Has been Deleted');
    }

    public function toggle(Todo $todo)
    {
        $todo->completed = !$todo->completed;
        $todo->save();
    }

    public function edit(Todo $todo)
    {
        $this->editingTodoId = $todo->id;
        $this->editingTodoName = $todo->name;
    }

    public function update()
    {
        $this->validateOnly('editingTodoName');

        Todo::find($this->editingTodoId)->update(['name' => $this->editingTodoName]);

        $this->cancelEdit();

        session()->flash('todoUpdated', 'todo has been Updated');
    }

    public function cancelEdit()
    {
        $this->reset('editingTodoId', 'editingTodoName');
    }

    public function render()
    {
        $todos = Todo::latest()->where('name', 'like', "%{$this->search}%")->paginate(4);
        $this->resetPage();
        return view('livewire.todo-list', ['todos' => $todos]);
    }
}
