<?php

namespace CleanArchitecture\Academic\Infrastructure\StringEncryptor;

use CleanArchitecture\Academic\Domain\StringEncryptorInterface;

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
