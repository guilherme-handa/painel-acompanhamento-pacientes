<section class="w-full">
    @include('partials.settings-heading')
    @if (0 == 1)
    <x-settings.layout :heading="__('Conta')" :subheading="__('Atualize seu usuário e seu endereço de e-mail.')">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            <flux:input wire:model="name" :label="__('Usuário')" type="text" required autofocus autocomplete="name" />

            <div>
                <flux:input wire:model="email" :label="__('E-mail')" type="email" required autocomplete="email" />
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Salvar') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Alteração salva.') }}
                </x-action-message>
            </div>
        </form>

        
    </x-settings.layout>
    @endif
</section>
