<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-slate-100 antialiased">
    <nav class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-3xl items-center justify-between px-4 py-4">
            <div>
                <p class="text-lg font-bold text-primary-600">{{ config('app.name') }}</p>
                <p class="text-sm text-slate-500">{{ auth()->user()->condominium->name }}</p>
            </div>

            <form method="POST" action="{{ route('resident.logout') }}">
                @csrf
                <button type="submit" class="text-sm font-medium text-slate-500 hover:text-slate-800">
                    Sair
                </button>
            </form>
        </div>
    </nav>

    <main class="mx-auto max-w-3xl px-4 py-8">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
