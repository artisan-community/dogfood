<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (ArtisanBuild\Verbstream\Verbstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" id="photo" class="hidden"
                       wire:model.live="photo"
                       x-ref="photo"
                       x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            "/>

                <x-label for="photo" value="{{ __('Photo') }}"/>

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                         class="rounded-full size-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full size-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <flux:button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </flux:button>

                @if ($this->user->profile_photo_path)
                    <flux:button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </flux:button>
                @endif

                <x-input-error for="photo" class="mt-2"/>
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <flux:input id="name" type="text" :label="__('Name')" wire:model="state.name"  required autocomplete="name"/>
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <flux:input id="email" type="email" label="Email" wire:model="state.email" required autocomplete="username"/>

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <flux:text class="mt-4">
                    {{ __('Your email address is unverified.') }}

                    <flux:button size="sm" class="mt-4"
                            wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </flux:button>
                </flux:text>

                @if ($this->verificationLinkSent)
                    <flux:text>
                        {{ __('A new verification link has been sent to your email address.') }}
                    </flux:text>
                @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <flux:button type="submit" variant="primary" wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </flux:button>
    </x-slot>
</x-form-section>
