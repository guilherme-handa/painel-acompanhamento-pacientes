<section class="w-full">
    @include('partials.settings-heading')
    @if (0 == 1)
    <x-settings.layout :heading="__('Alterar senha')" :subheading="__('')">
        <form wire:submit="updatePassword" class="mt-6 space-y-6">
            <flux:input
                wire:model="current_password"
                :label="__('Senha Atual')"
                type="password"
                required
                autocomplete="current-password"
            />
            <flux:input
                wire:model="password"
                :label="__('Nova Senha')"
                type="password"
                required
                autocomplete="new-password"
            />
            <flux:input
                wire:model="password_confirmation"
                :label="__('Confirmar Nova Senha')"
                type="password"
                required
                autocomplete="new-password"
            />

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Alterar') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="password-updated">
                    {{ __('Senha alterada.') }}
                </x-action-message>
            </div>
        </form>
    </x-settings.layout>
    @endif
</section>
