<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Update Password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <flux:input type="password" :label="__('Current Password')" id="current_password" wire:model="state.current_password" autocomplete="current-password"/>
            <x-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <flux:input type="password" :label="__('New Password')" id="password" wire:model="state.password" autocomplete="new-password"/>
            <x-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <flux:input type="password" :label="__('Confirm New Password')" id="password_confirmation" wire:model="state.password_confirmation" autocomplete="new-password"/>
            <x-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <flux:button type="submit" variant="primary">
            {{ __('Save') }}
        </flux:button>
    </x-slot>
</x-form-section>
