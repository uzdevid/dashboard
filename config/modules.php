<?php

return [
    'system' => [
        'class' => uzdevid\dashboard\modules\system\Module::class,
        'modules' => [
            'api' => uzdevid\dashboard\modules\system\modules\api\Module::class,
        ]
    ]
];