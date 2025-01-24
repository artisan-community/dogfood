<x-action-section>
    <x-slot name="title">
        {{ __('Delete Account') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Permanently delete your account.') }}
    </x-slot>

    <x-slot name="content">
        <flux:text>
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </flux:text>

        <div class="mt-5">
            <flux:modal.trigger name="confirm-deletion">
                <flux:button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                    {{ __('Delete Account') }}
                </flux:button>
            </flux:modal.trigger>
            <flux:modal name="confirm-deletion" class="space-y-6">
                <flux:heading class="!text-xl">{{ __('This Cannot Be Undone') }}</flux:heading>
                <flux:subheading>{{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}</flux:subheading>
                <flux:input type="password" class="mt-1 block w-3/4"
                         autocomplete="current-password"
                         placeholder="{{ __('Password') }}"
                         x-ref="password"
                         wire:model="password" />

                <x-input-error for="password"/>


                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)"></div>
                <div class="flex">
                    <div class="flex-grow"><flux:button x-on:click="$flux.modal('confirm-deletion').close()">{{ __('Cancel') }}</flux:button></div>
                    <div class="flex-shrink-0">
                        <flux:button variant="primary" wire:click="deleteUser" wire:loading.attr="disabled">
                            {{ __('Delete Account') }}
                        </flux:button>
                    </div>
                </div>
            </flux:modal>
        </div>
    </x-slot>
</x-action-section>
