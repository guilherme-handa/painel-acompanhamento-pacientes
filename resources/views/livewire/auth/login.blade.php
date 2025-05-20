<div class="flex flex-col gap-6 border p-5 rounded-sm">
    <img src="{{ asset('img/logo_clinica.png') }}" alt="Logo da Clínica" class="h-32">
    <p class="!font-light !text-sm">Informe seu endereço de e-mail e senha para acessar</p>


    <form wire:submit="login" class="flex flex-col gap-6">
        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('E-Mail')"
            type="email"
            required
            autofocus
            autocomplete="email"
            placeholder="E-Mail"
        />

        <!-- Password -->
        <div class="relative">
            <flux:input
                wire:model="password"
                :label="__('Senha')"
                type="password"
                required
                autocomplete="current-password"
                :placeholder="__('Senha')"
                viewable
            />

        </div>

        <!-- Remember Me -->
        <!-- <flux:checkbox wire:model="remember" :label="__('Remember me')" /> -->

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full !bg-blue-600 cursor-pointer">{{ __('Entrar') }}</flux:button>
        </div>
    </form>

</div>
