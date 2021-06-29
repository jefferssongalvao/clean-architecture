<?php

namespace CleanArchitecture\Academic\Domain\Password;

use CleanArchitecture\Academic\Infrastructure\StringEncryptor\StringEncryptorDefault;

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