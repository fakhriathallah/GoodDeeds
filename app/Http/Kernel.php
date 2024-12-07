<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'adminAuth' => \App\Http\Middleware\AdminAuth::class,
        'superAdminAuth' => \App\Http\Middleware\SuperAdminAuth::class,
        …
    ];
}