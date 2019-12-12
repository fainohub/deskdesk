<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Contracts\PasswordServiceInterface;
use Illuminate\Support\Facades\Hash;

class PasswordHashService implements PasswordServiceInterface
{

    public function encrypt(string $password): string
    {
        return Hash::make($password);
    }
}
