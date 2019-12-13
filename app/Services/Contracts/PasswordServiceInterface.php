<?php

declare(strict_types=1);

namespace App\Services\Contracts;

interface PasswordServiceInterface
{
    public function encrypt(string $password): string;
}
