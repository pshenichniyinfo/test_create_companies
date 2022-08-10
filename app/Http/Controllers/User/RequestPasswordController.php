<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\Traits\SendsPasswordResetEmails;

class RequestPasswordController extends ApiController
{
    use SendsPasswordResetEmails;
    public function __construct()
    {
        $this->broker = 'users';
    }
}
