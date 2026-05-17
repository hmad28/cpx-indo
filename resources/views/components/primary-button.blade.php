<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center rounded-full border border-transparent bg-red-600 px-5 py-3 text-xs font-black uppercase tracking-widest text-white shadow-lg shadow-red-600/20 transition hover:-translate-y-0.5 hover:bg-red-700 focus:bg-red-700 focus:outline-hidden focus:ring-2 focus:ring-red-500 focus:ring-offset-2 active:bg-gray-950']) }}>
    {{ $slot }}
</button>
