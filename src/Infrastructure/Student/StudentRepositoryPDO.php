<?php

namespace CleanArchitecture\Infrastructure\Student;

use CleanArchitecture\Domain\Ordinary\CPF;
use CleanArchitecture\Domain\Ordinary\Phone;
use CleanArchitecture\Domain\Student\Exceptions\StudentNotFoundException;
use CleanArchitecture\Domain\Student\Student;
use CleanArchitecture\Domain\Student\StudentRepositoryInterface;

class StudentRepositoryPDO implements StudentRepositoryInterface
{
    private \PDO $connection;
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function add(Student $student): void
    {
        $sql = 'INSERT INTO students VALUES (:cpf, :name, :email);';
        $statement = $this->connection->prepare($sql);
        $statement->bindValue('cpf', $student->cpf());
        $statement->bindValue('name', $student->name());
        $statement->bindValue('email', $student->email());
        $statement->execute();

        $sql = 'INSERT INTO phones VALUES (:ddd, :number, :cpf_student)';
        $statement = $this->connection->prepare($sql);
        $statement->bindValue('cpf_student', $student->cpf());

        /** @var Phone $phone */
        foreach ($student->phones() as $phone) {
            $statement->bindValue('ddd', $phone->ddd());
            $statement->bindValue('number', $phone->number());
            $statement->execute();
        }
    }

    public function searchByCPF(CPF $cpf): Student
    {
        $sql = 'SELECT cpf, name, email, ddd, number FROM students
                    LEFT JOIN phones ON phones.cpf_student = students.cpf
                WHERE students.cpf = :cpf;';

        $statement = $this->connection->prepare($sql);
        $statement->bindValue("cpf", (string) $cpf);
        $statement->execute();

        $studentData = $statement->fetchAll(\PDO::FETCH_ASSOC);
        if (count($studentData) === 0) {
            throw new StudentNotFoundException();
        }

        return $this->toMapStudent($studentData);
    }

    /** @return Student[] */
    public function searchAll(): array
    {

        $sql = 'SELECT cpf, name, email, ddd, number FROM students
                    LEFT JOIN phones ON phones.cpf_student = students.cpf;';
        $statement = $this->connection->query($sql);

        $studentDataList = $statement->fetchAll(\PDO::FETCH_ASSOC);

        if (count($studentDataList) === 0) {
            throw new StudentNotFoundException();
        }

        /** @var Student[] $students */
        $students = [];
        foreach ($studentDataList as $studentData) {
            $cpf = $studentData['cpf'];
            if (!array_key_exists($cpf, $students)) {
                $students[$cpf] = Student::withCpfNameEmail(
                    $cpf,
                    $studentData['name'],
                    $studentData['email']
                );
            }

            $students[$cpf]->addPhone($studentData['ddd'], $studentData['number']);
        }

        return $students;
    }

    /** @param Student[] $studentData */
    private function toMapStudent(array $studentData): Student
    {
        /** @var Student $firstStudent */
        $firstStudent = $studentData[0];
        $student = Student::withCpfNameEmail($firstStudent['cpf'], $firstStudent['name'], $firstStudent['email']);
        $phones = array_filter($studentData, fn ($lineStudent) => $lineStudent['ddd'] !== null && $lineStudent['number'] !== null);
        foreach ($phones as $phone) {
            $student->addPhone($phone['ddd'], $phone['number']);
        }

        return $student;
    }
}
