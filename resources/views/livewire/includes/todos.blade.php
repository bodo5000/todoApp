<div id="todos-list">

    @forelse ($todos as $todo)
        @include('livewire.includes.todo-card')
    @empty
        <p>there is no todos yet</p>
    @endforelse
    <div class="my-2">
        {{ $todos->links() }}
    </div>
</div>
