@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-brand-blue bg-brand-dark text-white focus:border-brand-blue focus:ring-brand-blue rounded-md shadow-sm']) }}>
