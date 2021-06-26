<?php

namespace CleanArchitecture\Domain\Password;

use CleanArchitecture\Infrastructure\StringEncryptorDefault;

class Password
{
    private string $password;
    public function __construct(string $password)
    {
        $this->password = (new StringEncryptorDefault())->encrypt($password);
    }

    public function __toString()
    {
        $this->password;
    }
}