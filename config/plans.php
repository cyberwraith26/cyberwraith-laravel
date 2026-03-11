<?php

return [
    'free' => [
        'name'        => 'Freelancer',
        'price'       => 0,
        'description' => 'Perfect for getting started',
        'tools'       => 4,
        'features'    => [
            'Pick any 4 tools you want',
            'Up to 3 active sequences',
            'Up to 5 invoices/month',
            'Community support',
        ],
    ],
    'pro' => [
        'name'        => 'Pro',
        'price'       => 49,
        'description' => 'For serious freelancers',
        'tools'       => 20,
        'features'    => [
            'Everything in Freelancer',
            'Pick any 20 tools you want',
            'Unlimited sequences',
            'Unlimited invoices',
            'Priority support',
        ],
    ],
    'agency' => [
        'name'        => 'Agency',
        'price'       => 129,
        'description' => 'For teams and agencies',
        'tools'       => 200,
        'features'    => [
            'Everything in Pro',
            'Access to all 200 tools',
            'Team member seats',
            'White-label options',
            'Dedicated support',
            'Custom integrations',
        ],
    ],
];
