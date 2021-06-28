<?php

namespace CleanArchitecture\Domain\Student;

use CleanArchitecture\Domain\Ordinary\CPF;
use CleanArchitecture\Domain\Ordinary\Email;
use CleanArchitecture\Domain\Password\Password;
use CleanArchitecture\Domain\Ordinary\Phone;

class Student
{
    private CPF $cpf;
    private string $name;
    private Email $email;
    /** @var Phone[] */
    private array $phones;
    private Password $password;

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

    public function withPassword(string $password): self
    {
        $this->password = new Password($password);
        return $this;
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

    public function password(): string
    {
        return $this->password;
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