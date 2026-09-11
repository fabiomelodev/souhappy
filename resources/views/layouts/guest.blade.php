<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-white antialiased">
    <div class="grid min-h-screen lg:grid-cols-2">
        <div class="hidden flex-col justify-between bg-primary-600 p-12 text-white lg:flex">
            <div class="text-xl font-bold">{{ config('app.name') }}</div>

            <div class="flex justify-center">
                <x-building-illustration max-width="320px" />
            </div>

            <div>
                <p class="text-2xl font-semibold">Sua comunidade, mais conectada.</p>
                <p class="mt-2 text-primary-100">
                    Acompanhe e assine abaixo-assinados do seu condomínio direto pelo celular ou computador.
                </p>
            </div>
        </div>

        <div class="flex flex-col items-center justify-center px-4 py-12">
            <div class="mb-8 text-2xl font-bold text-slate-900 lg:hidden">{{ config('app.name') }}</div>

            <div class="w-full max-w-sm">
                {{ $slot }}
            </div>
        </div>
    </div>

    @livewireScripts
</body>
</html>
