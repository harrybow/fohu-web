<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-brand-blue border border-brand-blue rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-brand-orange focus:outline-none focus:ring-2 focus:ring-brand-blue focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
