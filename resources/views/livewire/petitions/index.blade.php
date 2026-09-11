<div class="space-y-4">
    <h1 class="text-xl font-semibold text-slate-900">Abaixo-assinados</h1>

    @if ($petitions->isEmpty())
        <p class="rounded-lg border border-dashed border-slate-300 bg-white p-6 text-center text-sm text-slate-500">
            Nenhum abaixo-assinado publicado até o momento.
        </p>
    @else
        <div class="space-y-3">
            @foreach ($petitions as $item)
                @php($petition = $item['petition'])
                <a
                    href="{{ route('resident.petitions.show', ['condominium' => $condominium->slug, 'petition' => $petition]) }}"
                    class="block rounded-lg bg-white p-5 shadow-sm ring-1 ring-slate-200 hover:ring-primary-400"
                >
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="font-medium text-slate-900">{{ $petition->title }}</p>
                            <p class="mt-1 text-sm text-slate-500">
                                {{ $petition->signatures_count }} {{ $petition->signatures_count === 1 ? 'assinatura' : 'assinaturas' }}
                            </p>
                            @if ($petition->deadline_at)
                                <p class="mt-0.5 text-xs text-slate-400">
                                    Prazo: {{ $petition->deadline_at->format('d/m/Y') }}
                                </p>
                            @endif
                        </div>

                        <div class="flex shrink-0 flex-col items-end gap-1">
                            <span @class([
                                'rounded-full px-2.5 py-0.5 text-xs font-medium',
                                'bg-green-100 text-green-700' => $petition->isOpen(),
                                'bg-amber-100 text-amber-700' => ! $petition->isOpen() && $petition->isPastDeadline() && $petition->status === 'open',
                                'bg-slate-200 text-slate-600' => ! $petition->isOpen() && ! ($petition->isPastDeadline() && $petition->status === 'open'),
                            ])>
                                {{ $petition->effectiveStatusLabel() }}
                            </span>

                            @if ($item['signed'])
                                <span class="rounded-full bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-700">
                                    Você assinou
                                </span>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>
