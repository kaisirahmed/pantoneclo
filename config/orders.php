<?php 

return [
    'insertStatus' => [
        'pending' => 1,
        'failed' => 2,
        'paid' => 3,
        'processing' => 4,
        'completed' => 5,
        'onHold' => 6,
        'canceled' => 7,
        'refunded' => 8,
        'authenticationRequired' => 9,
        'awaitingDelivery' => 10
    ],
    'getStatus' => [
        1 => [
            'label' => 'Pending',
            'color' => 'primary',
        ],
        2 =>  [
            'label' => 'Failed',
            'color' => 'secondary',
        ],
        3 =>  [
            'label' => 'Paid',
            'color' => 'secondary',
        ],
        4 =>  [
            'label' => 'Processing',
            'color' => 'info',
        ],
        5 =>  [
            'label' => 'Completed',
            'color' => 'success',
        ],
        6 =>  [
            'label' => 'On Hold',
            'color' => 'warning',
        ],
        7 =>  [
            'label' => 'Canceled',
            'color' => 'danger',
        ],
        8 =>  [
            'label' => 'Refunded',
            'color' => 'info',
        ],
        9 =>  [
            'label' => 'Authentication Required',
            'color' => 'dark',
        ],
        10 =>  [
            'label' => 'Awaiting Delivery',
            'color' => 'info',
        ],
    ]
];