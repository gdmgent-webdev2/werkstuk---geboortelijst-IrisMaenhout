@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm focus:ring focus:border-yellow-500 focus:ring-yellow-500 focus:opacity-40 input-field']) !!}>
