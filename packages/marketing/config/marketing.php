<?php

use ArtisanBuild\Marketing\Driver\LeaveMarketingLeadPending;
use ArtisanBuild\Marketing\Driver\TrustLaravelValidation;

return [
    'admin-route-prefix' => 'marketing',
    // Actions bouncd in the service provider, overridden by your chosen marketing platform driver
    'export_marketing_lead' => LeaveMarketingLeadPending::class,
    'validate_email_address' => TrustLaravelValidation::class,
];
