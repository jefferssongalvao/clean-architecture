<?php

namespace CleanArchitecture\Academic\Domain\Student;

use CleanArchitecture\Shared\Domain\CPF\CPF;

interface StudentRepositoryInterface
{
    public function add(Student $aluno): void;
    public function searchByCPF(CPF $cpf): Student;
    /** @return Student[] */
    public function searchAll(): array;
}
