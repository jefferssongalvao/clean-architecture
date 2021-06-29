<?php

namespace CleanArchitecture\Academic\Domain\StringEncryptor;

interface StringEncryptorInterface
{
    public function encrypt(string $text): string;
    public function verify(string $text, string $encryptedText): bool;
}