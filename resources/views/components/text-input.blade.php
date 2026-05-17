@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full rounded-2xl border-black/10 bg-white/80 px-4 py-3 text-gray-950 shadow-sm transition placeholder:text-gray-400 focus:border-red-500 focus:ring-red-500']) }}>
