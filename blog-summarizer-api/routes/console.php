<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('app:test', function () {
    $this->comment('test');
});
