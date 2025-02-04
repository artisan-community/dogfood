<?php

namespace App\Plans;

use ArtisanBuild\Till\Enums\PaymentProcessors;

class TeamPlan
{
    public PaymentProcessors $processor = PaymentProcessors::Stripe;
    public array $price = [
        'month' => 10,
        'year' => 100,
        'life' => null,
    ];

    public string $heading = 'Startup';
    public string $subheading = 'A great value for your growing team';

}
