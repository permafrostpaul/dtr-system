<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex justify-center items-center px-6 py-2 sm:px-12 sm:py-3 bg-custom-orange text-white border border-transparent rounded-md font-semibold text-sm sm:text-xs uppercase tracking-widest hover:bg-custom-blue focus:bg-orange-600 active:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition ease-in-out duration-150 w-full sm:w-auto text-center'
]) }}>
    {{ $slot }}
</button>
