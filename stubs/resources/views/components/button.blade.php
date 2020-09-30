@props([
    'class' => 'shadow-sm text-white bg-gradient-to-br from-primary-600 to-primary-400 hover:from-primary-500 hover:to-primary-700 hover:shadow'
])
<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'transition-all duration-250 rounded px-3 py-2 font-semibold ' . $class
]) }}>
    {{ $slot }} 
</button>