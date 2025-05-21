@php
$usuarioLogado = auth()->user();
@endphp
<div class="flex flex-col gap-6">
    @if (0 == 1)
    <x-auth-header :title="__('Criar novo usuário')" :description="__('Preencha as informações para criar um novo usuário.')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input
            wire:model="name"
            :label="__('Usuário')"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('Nome de usuário')" />

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('E-mail')"
            type="email"
            required
            autocomplete="email"
            placeholder="Endereço de e-mail" />

        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Senha')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Senha')"
            viewable />

        <!-- Confirm Password -->
        <flux:input
            wire:model="password_confirmation"
            :label="__('Confirmar senha')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Confirmar senha')"
            viewable />

        <x-select class="cursor-pointer" :label="__('Permissão')" :placeholder="__('Selecionar permissão')">
            
            <option value="1">
                teste
            </option>
            
        </x-select>

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Criar novo usuário') }}
            </flux:button>
        </div>
    </form>
    @else
        <div>
            <h2>Seu acesso não tem permissão para acessar essa página.</h2>
        </div>
    @endif
</div>