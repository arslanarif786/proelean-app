<?php

return [
    'stripe_secret' => env('STRIPE_SECRET'),
    'webhook_signature' => env('STRIPE_WEBHOOK_ENDPOINT_SECRET', 'whsec_ZLtbDp4KyxRloQSOGrJm09YVdanlRV1V'),
    'connect_webhook_signature' => env('STRIPE_WEBHOOK_CONNECT_ENDPOINT_SECRET','whsec_eo8keS7Sq8aJWfGGKWvRPd45iczYfJJz'),
];
