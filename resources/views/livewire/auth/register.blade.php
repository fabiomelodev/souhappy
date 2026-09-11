<div>
    <h1 class="mb-1 text-2xl font-semibold text-slate-900">Criar conta</h1>
    <p class="mb-6 text-sm text-slate-500">
        Cadastro de morador do <span class="font-medium text-slate-700">{{ $condominium->name }}</span>.
    </p>

    <form wire:submit="register" class="space-y-4">
        <div>
            <label for="name" class="block text-sm font-medium text-slate-700">Nome completo</label>
            <input
                wire:model="name"
                type="text"
                id="name"
                required
                autofocus
                class="mt-1 block w-full rounded-lg border-2 border-slate-400/60 px-4 py-3 text-base shadow-sm focus:border-primary-600 focus:ring-primary-600"
            >
            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700">E-mail</label>
            <input
                wire:model="email"
                type="email"
                id="email"
                required
                class="mt-1 block w-full rounded-lg border-2 border-slate-400/60 px-4 py-3 text-base shadow-sm focus:border-primary-600 focus:ring-primary-600"
            >
            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="tower" class="block text-sm font-medium text-slate-700">Torre</label>
                <input
                    wire:model="tower"
                    type="text"
                    id="tower"
                    required
                    class="mt-1 block w-full rounded-lg border-2 border-slate-400/60 px-4 py-3 text-base shadow-sm focus:border-primary-600 focus:ring-primary-600"
                >
                @error('tower') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="apartmentNumber" class="block text-sm font-medium text-slate-700">Apartamento</label>
                <input
                    wire:model="apartmentNumber"
                    type="text"
                    id="apartmentNumber"
                    required
                    class="mt-1 block w-full rounded-lg border-2 border-slate-400/60 px-4 py-3 text-base shadow-sm focus:border-primary-600 focus:ring-primary-600"
                >
                @error('apartmentNumber') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <x-password-input wire:model="password" id="password" label="Senha" required />
            @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <x-password-input wire:model="passwordConfirmation" id="passwordConfirmation" label="Confirmar senha" required />
        </div>

        <button
            type="submit"
            class="w-full rounded-lg bg-primary-600 px-4 py-3 text-base font-semibold text-white shadow-sm hover:bg-primary-700"
        >
            <span wire:loading.remove wire:target="register">Criar conta</span>
            <span wire:loading wire:target="register">Criando conta...</span>
        </button>

        <p class="text-center text-sm text-slate-500">
            Já tem conta?
            <a href="{{ route('resident.login') }}" class="font-medium text-primary-600 hover:text-primary-700">Entrar</a>
        </p>
    </form>
</div>
