<?php

namespace CleanArchitecture\Domain\Student;

use CleanArchitecture\Domain\CPF;
use CleanArchitecture\Domain\Email;
use CleanArchitecture\Domain\Phone;

class Student
{
    private CPF $cpf;
    private string $name;
    private Email $email;
    /** @var Phone[] */
    private array $phones;

    private function __construct(CPF $cpf, string $name, Email $email)
    {
        $this->cpf = $cpf;
        $this->name = $name;
        $this->email = $email;
        $this->phones = [];
    }

    public static function withCpfNameEmail(string $cpf, string $name, string $email): self
    {
        return new Student(new CPF($cpf), $name, new Email($email));
    }

    public function addPhone(string $ddd, string $number): self
    {
        $this->phones[] = new Phone($ddd, $number);
        return $this;
    }

    public function cpf(): CPF
    {
        return $this->cpf;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): Email
    {
        return $this->email;
    }

    /**
     * @return Phone[]
     */
    public function phones(): array
    {
        return $this->phones;
    }

    public function student(): self
    {
        return $this;
    }
}