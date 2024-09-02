@props([
    'task',
])
<li class="list-group-item d-flex align-items-center border-0 mb-2 rounded"
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
</li>
