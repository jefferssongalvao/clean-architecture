<?php

namespace CleanArchitecture\Infrastructure\StringEncryptor;

use CleanArchitecture\Domain\StringEncryptorInterface;

class StringEncryptorMd5 implements StringEncryptorInterface
{
    public function encrypt(string $text): string
    {
        return md5($text);
    }
    public function verify(string $text, string $encryptedText): bool
    {
        return md5($text) === $encryptedText;
    }
}