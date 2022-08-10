<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\Traits\ResetsPasswords;

class ResetPasswordController extends ApiController
{
    use ResetsPasswords;
}
