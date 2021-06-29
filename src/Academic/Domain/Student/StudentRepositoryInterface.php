<?php

namespace CleanArchitecture\Academic\Domain\Student;

use CleanArchitecture\Academic\Domain\Ordinary\CPF;

interface StudentRepositoryInterface
{
    public function add(Student $aluno): void;
    public function searchByCPF(CPF $cpf): Student;
    /** @return Student[] */
    public function searchAll(): array;
}
