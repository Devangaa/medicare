@props([
    'type' => 'text',
    'name',
    'label',
    'placeholder' => '',
    'value' => ''
])

<div class="form-group mb-4">
    @if(isset($label))
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
    @endif
    
    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $name }}" 
        placeholder="{{ $placeholder }}"
        value="{{ $type !== 'password' ? old($name, $value) : '' }}"
        {{ $attributes->merge(['class' => 'w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 ' . ($errors->has($name) ? 'border-red-500' : 'border-gray-300')]) }}
    >

    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>