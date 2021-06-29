<?php

namespace CleanArchitecture\Shared\Domain\CPF;

class CPF
{
    private string $cpf;
    public function __construct(string $cpf)
    {
        $this->setCPF($cpf);
    }

    private function setCPF(string $cpf): void
    {
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        if ($this->validateCPF($cpf) === false)
            throw new \InvalidArgumentException("CPF Invalid!");

        $this->cpf = $cpf;
    }

    private function validateCPF($cpf): bool
    {
        if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }

    public function __toString(): string
    {
        $cpf = $this->cpf;
        return substr($cpf, 0, 3) . "." . substr($cpf, 3, 3) . "." . substr($cpf, 6, 3) . "-" . substr($cpf, 9, 2);
    }
}