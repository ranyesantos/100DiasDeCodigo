<?php

declare(strict_types=1);

return [
    'admins' => explode(',', (string) env('HE4RT_ADMINS', 'danielhe4rt,gvieira18')),
];
