<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => config('marketing.admin-route-prefix'),
    'middleware' => ['auth:web'],

], function() {

});
