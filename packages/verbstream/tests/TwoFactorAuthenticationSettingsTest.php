<?php

use App\Models\User;
use ArtisanBuild\Verbstream\Http\Livewire\TwoFactorAuthenticationForm;
use Laravel\Fortify\Features;
use Livewire\Livewire;

test('two factor authentication can be enabled', function (): void {
    $this->actingAs($user = User::factory()->create()->fresh());

    $this->withSession(['auth.password_confirmed_at' => time()]);

    Livewire::test(TwoFactorAuthenticationForm::class)
        ->call('enableTwoFactorAuthentication');

    $user = $user->fresh();

    expect($user->two_factor_secret)->not->toBeNull();
    expect($user->recoveryCodes())->toHaveCount(8);
})->skip(fn () => ! Features::canManageTwoFactorAuthentication(), 'Two factor authentication is not enabled.');

test('recovery codes can be regenerated', function (): void {
    $this->actingAs($user = User::factory()->create()->fresh());

    $this->withSession(['auth.password_confirmed_at' => time()]);

    $component = Livewire::test(TwoFactorAuthenticationForm::class)
        ->call('enableTwoFactorAuthentication')
        ->call('regenerateRecoveryCodes');

    $user = $user->fresh();

    $component->call('regenerateRecoveryCodes');

    expect($user->recoveryCodes())->toHaveCount(8);
    expect(array_diff($user->recoveryCodes(), $user->fresh()->recoveryCodes()))->toHaveCount(8);
})->skip(fn () => ! Features::canManageTwoFactorAuthentication(), 'Two factor authentication is not enabled.');

test('two factor authentication can be disabled', function (): void {
    $this->actingAs($user = User::factory()->create()->fresh());

    $this->withSession(['auth.password_confirmed_at' => time()]);

    $component = Livewire::test(TwoFactorAuthenticationForm::class)
        ->call('enableTwoFactorAuthentication');

    $this->assertNotNull($user->fresh()->two_factor_secret);

    $component->call('disableTwoFactorAuthentication');

    expect($user->fresh()->two_factor_secret)->toBeNull();
})->skip(fn () => ! Features::canManageTwoFactorAuthentication(), 'Two factor authentication is not enabled.');
