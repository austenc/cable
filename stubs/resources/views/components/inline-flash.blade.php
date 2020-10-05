@props([
    'prop' => 'saved',
    'duration' => 2500,
    'class' => null
])

<div x-data="{ show: @entangle($prop).defer }" 
    x-init="$watch('show', value => {setTimeout(() => {value && ($wire.{{ $prop }} = false)}, {{ $duration }})})" 
    x-cloak
>
    <div x-show.transition="show" class="{{ $class ?? 'font-medium text-primary-500' }}">
        @if($slot->isEmpty())
            Saved!
        @else
           {{ $slot }}
        @endif
    </div>
</div>