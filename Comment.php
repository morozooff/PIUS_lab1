<?php
include_once './User.php';

class Comment
{
    public function __construct(User $user, string $text)
    {
        $this->user = $user;
        $this->text = $text;
    }

    public function getUser() : User
    {
        return $this->user;
    }

    public function getText() : string
    {
        return $this->text;
    }
}