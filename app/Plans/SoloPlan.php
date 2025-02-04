<?php

namespace App\Plans;

use ArtisanBuild\Till\Enums\PaymentProcessors;

class SoloPlan
{
    public PaymentProcessors $processor = PaymentProcessors::Stripe;

    public array $price = [
        'month' => 0,
        'year' => 0,
        'life' => 0,
    ];

    public string $heading = 'Solo';
    public string $subheading = 'Everything the indie hacker needs';

}
