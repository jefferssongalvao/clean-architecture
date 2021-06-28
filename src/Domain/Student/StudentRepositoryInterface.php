<?php

namespace CleanArchitecture\Domain\Student;

use CleanArchitecture\Domain\Ordinary\CPF;

interface StudentRepositoryInterface
{
    public function add(Student $aluno): void;
    public function searchByCPF(CPF $cpf): Student;
    /** @return Student[] */
    public function searchAll(): array;
}
