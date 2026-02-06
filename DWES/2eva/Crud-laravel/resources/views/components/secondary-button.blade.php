<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-emerald-700 border border-emerald-700 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-emerald-600 hover:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150', 'style' => 'background-color:#047857;border-color:#047857;color:#ffffff;']) }}>
    {{ $slot }}
</button>
