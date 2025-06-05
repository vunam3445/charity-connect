<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $except = [
        //
        'api/*', // bỏ CSRF cho toàn bộ route bắt đầu bằng /api
        'login/', // hoặc 'auth/login' nếu đúng route
        'register/', // hoặc 'auth/register' nếu đúng route
        'registerOrganization/', // hoặc 'auth/registerOrganization' nếu đúng route
        'logout/', // hoặc 'auth/logout' nếu đúng route
    ];
}
