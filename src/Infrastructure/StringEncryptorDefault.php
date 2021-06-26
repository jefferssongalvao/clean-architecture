<?php

namespace CleanArchitecture\Infrastructure;

use CleanArchitecture\Domain\StringEncryptorInterface;

class StringEncryptorDefault implements StringEncryptorInterface
{
    public function encrypt(string $text): string
    {
        return password_hash($text, PASSWORD_ARGON2I);
    }
    public function verify(string $text, string $encryptedText): bool
    {
        return password_verify($text, $encryptedText);
    }
}