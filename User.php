<?php
include_once './vendor/autoload.php';

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\PositiveOrZero;
use Symfony\Component\Validator\Constraints\Length;

class User {

    //getters
    public function getId() : int{
        return $this->id;
    }
   
    public function getName() : string{
        return $this->name;
    }
   
    public function getEmail() : string{
        return $this->email;
    }
   
    public function getPassword() : string{
        return $this->password;
    }
   
    public function getTimeOfCreate() : string{
        return $this->timeOfCreate;
    }
    
    // validation && errors
    private function printErrors(ConstraintViolationListInterface $violations, string $comment) : void
    {
        if (count($violations) <= 0)
        {
            return;
        }

        echo "$comment: ";
        foreach ($violations as $violation)
        {
            echo $violation->getMessage();
        }
        echo "<br>";
    }

    private function verifyId(int $id) : ConstraintViolationListInterface
    {
        $validator = Validation::createValidator();
        return $validator->validate($id, [
            new PositiveOrZero()
        ]);
    }

    private function verifyName(string $name) : ConstraintViolationListInterface
    {
        $validator = Validation::createValidator();
        return $validator->validate($name, [
            new NotBlank(),
            new Regex(['pattern' => '/[A-ZА-Я]{1}[a-zа-я]/'])
        ]);
    }

    private function verifyEmail(string $email) : ConstraintViolationListInterface
    {
        $validator = Validation::createValidator();
        return $validator->validate($email, [
            new NotBlank(),
            new Regex(['pattern' => '/\w+\d*@\w+\d*\.\w+\d*/'])
        ]);
    }

    private function verifyPassword(string $password) : ConstraintViolationListInterface
    {
        $validator = Validation::createValidator();
        return $validator->validate($password, [
            new NotBlank(),
            new Regex(['pattern' => '/(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{6,}/'])
        ]);
    }

    public function __construct(int $id, string $name, string $email, string $password)
    {        
        $this->timeOfCreate = date("m/d/Y h:i:s A");

        $violations = $this->verifyId($id);
        $this->printErrors($violations, 'Invalid ID, please try again');

        $violations = $this->verifyName($name);
        $this->printErrors($violations, 'Invalid name, please try again');

        $violations = $this->verifyEmail($email);
        $this->printErrors($violations, 'Invalid email, please try again');

        $violations = $this->verifyPassword($password);
        $this->printErrors($violations, 'Invalid password, please try again');

        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }
}