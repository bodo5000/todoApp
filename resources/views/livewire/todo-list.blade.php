<div>
    @if (session('error'))
        <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
            <p class="font-bold">Be Warned</p>
            <p>{{ session('error') }}</p>
        </div>
    @endif
    @include('livewire.includes.create-todo-box')
    @include('livewire.includes.serach-box')
    @if (session('todoDeleted'))
        <p class="text-green-500 mb-2">{{ session('todoDeleted') }}</p>
    @elseif (session('todoUpdated'))
        <p class="text-green-500 mb-2">{{ session('todoUpdated') }}</p>
    @endif
    @include('livewire.includes.todos')
</div>
