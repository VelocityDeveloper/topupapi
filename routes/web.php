<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Your IP Address: ' . $_SERVER['REMOTE_ADDR'] . '<br><small>Copyright © ' . date('Y') . ' Velocity Developer</small>';
});

require __DIR__ . '/auth.php';
