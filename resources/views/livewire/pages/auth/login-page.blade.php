<div>
    <x-modal wire:model="successModal" persistent class="backdrop-blur">
        <div>Autenticado com sucesso, redirecionando...</div>
    </x-modal>
    <form wire:submit="login">
        <div class="block">
            <x-input :label="__('Usuário ou Email')" wire:model="form.login" inline required autofocus
                     autocomplete="username"
                     type="text" name="login" icon="o-user"/>
        </div>

        <div class="block mt-4">
            <x-input :label="__('Senha')" wire:model="form.password" icon="o-eye" inline required type="password"
                     autocomplete="password"/>
        </div>

        <div class="flex items-center justify-between mt-4">
            <div class="flex">
                <x-checkbox :label="__('Lembrar-me')" wire:model="form.remember"/>
            </div>

            @if (Route::has('auth.password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                   href="{{ route('auth.password.request') }}" wire:navigate>
                    {{ __('Esqueceu a senha?') }}
                </a>
            @endif

            <x-button :label="__('Entrar')" type="submit" class="btn-primary" spinner="login"/>
        </div>
    </form>
</div>
