<?php

return [
    'exclude_ips' => array_filter(array_map('trim', explode(',', env('ANALYTICS_EXCLUDE_IPS', '')))),
];
