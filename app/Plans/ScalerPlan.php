<?php

namespace App\Plans;

use ArtisanBuild\Till\Enums\PaymentProcessors;

class ScalerPlan
{
    public PaymentProcessors $processor = PaymentProcessors::Stripe;

    public array $price = [
        'month' => 50,
        'year' => 500,
        'life' => null,
    ];

    public string $heading = 'Scaler';
    public string $subheading = 'Everything you need to run your business';
}
