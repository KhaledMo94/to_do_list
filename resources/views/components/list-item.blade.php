@props([
    'task',
])
<li class="list-group-item d-flex align-items-center border-0 mb-2 rounded position-relative"
style="background-color: #f4f6f7;">
<input 
    class="form-check-input me-2" 
    wire:click="checkDone({{ $task->id }})"
    type="checkbox" 
    value=""
    aria-label="..." 
    @if ($task->done)
        checked
    @endif
    />

<s
@if ($task->done)
    style="text-decoration:line-through"
@else
    style="text-decoration:none"
@endif
>{{ $task->name }}</s>
<a 
    class="position-absolute" 
    style="right:10px;color:red;transition:0.3s" 
    wire:confirm='Are You Sure To Delete This Task ?!'
    wire:click="deleteTask({{ $task->id }})">
    <i class="fa fa-trash " aria-hidden="true"></i>
</a>
</li>
