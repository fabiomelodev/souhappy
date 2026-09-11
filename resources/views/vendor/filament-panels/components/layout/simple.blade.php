@props([
    'after' => null,
    'heading' => null,
    'subheading' => null,
])

@php
    use Filament\Livewire\SimpleUserMenu;
    use Filament\Support\Enums\Width;
    use Filament\Support\Facades\FilamentView;
    use Filament\View\PanelsRenderHook;

    $livewire ??= null;

    $renderHookScopes = $livewire?->getRenderHookScopes();
    $maxContentWidth ??= (filament()->getSimplePageMaxContentWidth() ?? Width::Large);

    if (is_string($maxContentWidth)) {
        $maxContentWidth = Width::tryFrom($maxContentWidth) ?? $maxContentWidth;
    }

    $isGuest = ! filament()->auth()->check();
@endphp

<x-filament-panels::layout.base :livewire="$livewire">
    <div class="fi-simple-layout">
        @if (($hasTopbar ?? true) && filament()->auth()->check())
            <a href="#fi-main-content" class="fi-skip-link fi-sr-only">
                {{ __('filament-panels::layout.skip_to_content.label') }}
            </a>
        @endif

        {{ FilamentView::renderHook(PanelsRenderHook::SIMPLE_LAYOUT_START, scopes: $renderHookScopes) }}

        @if (($hasTopbar ?? true) && filament()->auth()->check())
            <div class="fi-simple-layout-header">
                @if (filament()->hasDatabaseNotifications())
                    @livewire(filament()->getDatabaseNotificationsLivewireComponent(), [
                        'lazy' => filament()->hasLazyLoadedDatabaseNotifications(),
                        'position' => \Filament\Enums\DatabaseNotificationsPosition::Topbar,
                    ])
                @endif

                @if (filament()->hasUserMenu())
                    @livewire(SimpleUserMenu::class)
                @endif
            </div>
        @endif

        @if ($isGuest)
            <style>
                .souhappy-auth-split { display: flex; min-height: 100vh; width: 100%; flex: 1 1 auto; }
                .souhappy-auth-aside { display: none; }
                .souhappy-auth-form-ctn { flex: 1; display: flex; align-items: center; justify-content: center; }
                @media (min-width: 1024px) {
                    .souhappy-auth-aside {
                        display: flex;
                        flex-direction: column;
                        justify-content: space-between;
                        width: 40%;
                        padding: 3rem;
                        background-color: #C6242A;
                        color: #fff;
                        box-sizing: border-box;
                    }
                }
                .souhappy-auth-aside-brand { font-size: 1.25rem; font-weight: 700; }
                .souhappy-auth-aside-art { display: flex; justify-content: center; }
                .souhappy-auth-aside-title { font-size: 1.5rem; font-weight: 600; margin: 0; line-height: 1.3; }
                .souhappy-auth-aside-subtitle { margin-top: 0.5rem; color: rgba(255, 255, 255, 0.85); line-height: 1.5; }
            </style>

            <div class="souhappy-auth-split">
                <div class="souhappy-auth-aside">
                    <div class="souhappy-auth-aside-brand">{{ filament()->getBrandName() }}</div>

                    <div class="souhappy-auth-aside-art">
                        <x-building-illustration max-width="300px" />
                    </div>

                    <div>
                        <p class="souhappy-auth-aside-title">Gestão do seu condomínio em um só lugar.</p>
                        <p class="souhappy-auth-aside-subtitle">
                            Abaixo-assinados, moradores e muito mais, em um painel simples de usar.
                        </p>
                    </div>
                </div>

                <div class="fi-simple-main-ctn souhappy-auth-form-ctn">
                    <main
                        id="fi-main-content"
                        tabindex="-1"
                        @class([
                            'fi-simple-main',
                            ($maxContentWidth instanceof Width) ? "fi-width-{$maxContentWidth->value}" : $maxContentWidth,
                        ])
                    >
                        {{ $slot }}
                    </main>
                </div>
            </div>
        @else
            <div class="fi-simple-main-ctn">
                <main
                    id="fi-main-content"
                    tabindex="-1"
                    @class([
                        'fi-simple-main',
                        ($maxContentWidth instanceof Width) ? "fi-width-{$maxContentWidth->value}" : $maxContentWidth,
                    ])
                >
                    {{ $slot }}
                </main>
            </div>
        @endif

        {{ FilamentView::renderHook(PanelsRenderHook::FOOTER, scopes: $renderHookScopes) }}

        {{ FilamentView::renderHook(PanelsRenderHook::SIMPLE_LAYOUT_END, scopes: $renderHookScopes) }}
    </div>
</x-filament-panels::layout.base>
