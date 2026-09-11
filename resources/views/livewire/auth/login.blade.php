<div>
    <h1 class="mb-1 text-2xl font-semibold text-slate-900">Bem-vindo(a)</h1>
    <p class="mb-6 text-sm text-slate-500">Entre para ver os abaixo-assinados do seu condomínio.</p>

    <form wire:submit="authenticate" class="space-y-4">
        <div>
            <label for="email" class="block text-sm font-medium text-slate-700">E-mail</label>
            <input
                wire:model="email"
                type="email"
                id="email"
                required
                autofocus
                class="mt-1 block w-full rounded-lg border-2 border-slate-400/60 px-4 py-3 text-base shadow-sm focus:border-primary-600 focus:ring-primary-600"
            >
            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <x-password-input wire:model="password" id="password" label="Senha" required />
            @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <button
            type="submit"
            class="w-full rounded-lg bg-primary-600 px-4 py-3 text-base font-semibold text-white shadow-sm hover:bg-primary-700"
        >
            <span wire:loading.remove wire:target="authenticate">Entrar</span>
            <span wire:loading wire:target="authenticate">Entrando...</span>
        </button>

        <p class="text-center text-sm text-slate-500">
            Ainda não tem conta? Peça o link de cadastro ao síndico ou conselheiro do seu condomínio.
        </p>

        <p class="text-center text-xs text-slate-400">
            Sou conselheiro, <a href="{{ url('/admin/register') }}" class="font-medium text-slate-500 hover:text-primary-600">quero criar minha conta</a>.
        </p>
    </form>
</div>
