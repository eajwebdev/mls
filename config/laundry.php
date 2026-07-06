<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Machine Count
    |--------------------------------------------------------------------------
    |
    | Number of machines assigned to a branch when it is seeded without an
    | explicit machine count. Drives the cycle monitoring machine picker
    | and the Z-Reading machine counter grid.
    |
    */

    'default_machine_count' => (int) env('BRANCH_MACHINE_COUNT', 5),

];
