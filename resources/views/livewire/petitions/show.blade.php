<div class="space-y-6">
    <a href="{{ route('resident.dashboard', ['condominium' => $condominium->slug]) }}" class="text-sm text-slate-500 hover:text-slate-800">
        &larr; Voltar
    </a>

    <div class="rounded-lg bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <div class="flex items-start justify-between gap-4">
            <h1 class="text-xl font-semibold text-slate-900">{{ $petition->title }}</h1>
            <span @class([
                'shrink-0 rounded-full px-2.5 py-0.5 text-xs font-medium',
                'bg-green-100 text-green-700' => $petition->isOpen(),
                'bg-amber-100 text-amber-700' => ! $petition->isOpen() && $petition->isPastDeadline() && $petition->status === 'open',
                'bg-slate-200 text-slate-600' => ! $petition->isOpen() && ! ($petition->isPastDeadline() && $petition->status === 'open'),
            ])>
                {{ $petition->effectiveStatusLabel() }}
            </span>
        </div>

        <p class="mt-1 text-sm text-slate-500">
            {{ $signatures->count() }} {{ $signatures->count() === 1 ? 'assinatura' : 'assinaturas' }}
            @if ($petition->deadline_at)
                &middot; Prazo para assinar: {{ $petition->deadline_at->format('d/m/Y \à\s H:i') }}
            @endif
        </p>

        <div class="mt-4 border-t border-slate-100 pt-4">
            @if ($petition->type === 'pdf')
                <embed
                    src="{{ $pdfUrl }}"
                    type="application/pdf"
                    class="h-[32rem] w-full rounded border border-slate-200"
                >
            @else
                <div class="prose prose-sm max-w-none">
                    {!! $petition->content !!}
                </div>
            @endif
        </div>
    </div>

    <div class="rounded-lg bg-white p-6 shadow-sm ring-1 ring-slate-200">
        @if ($signed)
            <p class="flex items-center gap-2 text-sm font-medium text-green-700">
                <span>&#10003;</span> Você já assinou este abaixo-assinado.
            </p>
        @elseif (! $petition->isOpen())
            <p class="text-sm text-slate-500">
                @if ($petition->status === 'open' && $petition->isPastDeadline())
                    O prazo para assinar este abaixo-assinado terminou em {{ $petition->deadline_at->format('d/m/Y \à\s H:i') }}.
                @else
                    Este abaixo-assinado está encerrado e não aceita mais assinaturas.
                @endif
            </p>
        @else
            <h2 class="mb-4 font-medium text-slate-900">Assinar</h2>

            <div class="grid gap-4 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-slate-700">Nome completo</label>
                    <input wire:model="fullName" type="text" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-600 focus:ring-primary-600 sm:text-sm">
                    @error('fullName') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700">Torre</label>
                    <input wire:model="tower" type="text" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-600 focus:ring-primary-600 sm:text-sm">
                    @error('tower') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700">Apartamento</label>
                    <input wire:model="apartmentNumber" type="text" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-600 focus:ring-primary-600 sm:text-sm">
                    @error('apartmentNumber') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-4" x-data="signaturePad()" x-init="init()">
                <label class="block text-sm font-medium text-slate-700">Assinatura</label>
                <canvas x-ref="canvas" class="mt-1 h-48 w-full touch-none rounded-lg border border-slate-300 bg-white"></canvas>

                <div class="mt-2 flex items-center justify-between">
                    <button type="button" @click="clear()" class="text-sm font-medium text-slate-500 hover:text-slate-800">
                        Limpar
                    </button>

                    <button
                        type="button"
                        @click="confirm()"
                        wire:loading.attr="disabled"
                        wire:target="sign"
                        class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-700 disabled:opacity-50"
                    >
                        <span wire:loading.remove wire:target="sign">Confirmar assinatura</span>
                        <span wire:loading wire:target="sign">Enviando...</span>
                    </button>
                </div>

                <p x-show="isEmpty" x-cloak class="mt-1 text-sm text-slate-400">Desenhe sua assinatura na área acima.</p>
                @error('signature') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        @endif
    </div>

    @if ($signatures->isNotEmpty())
        <div class="rounded-lg bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <h2 class="mb-4 font-medium text-slate-900">Assinantes</h2>

            <ul class="divide-y divide-slate-100">
                @foreach ($signatures as $signature)
                    <li class="flex items-center justify-between gap-4 py-2 text-sm">
                        <div>
                            <p class="font-medium text-slate-800">{{ $signature->full_name }}</p>
                            <p class="text-slate-500">Torre {{ $signature->tower }}, apto {{ $signature->apartment_number }}</p>
                        </div>
                        <span class="shrink-0 text-slate-400">{{ $signature->signed_at->format('d/m/Y') }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
