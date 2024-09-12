@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-custom-blue ']) }}>
    {{ $value ?? $slot }}
</label>
