<?php

namespace CleanArchitecture;

use InvalidArgumentException;

class Email
{
    private string $email;
    public function __construct(string $email)
    {
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false)
            throw new InvalidArgumentException("E-mail is invalid");
        $this->email = $email;
    }

    public function __toString(): string
    {
        return $this->email;
    }
}