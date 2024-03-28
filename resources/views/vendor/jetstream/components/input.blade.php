@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-next-300 focus:ring focus:ring-next-200 focus:ring-opacity-50 rounded-md shadow-sm']) !!}>
