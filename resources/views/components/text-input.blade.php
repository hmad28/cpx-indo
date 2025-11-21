@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-zinc-800 border-zinc-700 focus:border-red-500 focus:ring-red-500 rounded-md shadow-xs text-gray-300']) }}>
