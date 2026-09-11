@props(['label' => 'Senha', 'id' => 'password'])

<div>
    <label for="{{ $id }}" class="block text-sm font-medium text-slate-700">{{ $label }}</label>

    <div class="relative mt-1" x-data="{ show: false }">
        <input
            id="{{ $id }}"
            :type="show ? 'text' : 'password'"
            {{ $attributes->merge(['class' => 'block w-full rounded-lg border-2 border-slate-400/60 px-4 py-3 pr-12 text-base shadow-sm focus:border-primary-600 focus:ring-primary-600']) }}
        >

        <button
            type="button"
            tabindex="-1"
            @click="show = !show"
            class="absolute inset-y-0 right-0 flex items-center px-3 text-slate-400 hover:text-slate-600"
        >
            <svg x-cloak x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
            </svg>
            <svg x-cloak x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074L3.707 2.293zM12.454 16.697l-1.454-1.454a4.032 4.032 0 01-1.858-.51 4 4 0 01-3.375-3.375 4.032 4.032 0 01-.51-1.858L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" clip-rule="evenodd" />
                <path d="M11.297 9.176a2 2 0 01-2.121 2.121l2.121-2.121z" />
            </svg>
        </button>
    </div>
</div>
