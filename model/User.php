<?php

class User
{
    public $id;
    public $login;
    public $email;
    private $passwd;
    private $token;
    public $verified;
    public function __construct($row)
    {
        $this->id = $row["id"];
        $this->login = $row["login"];
        $this->email = $row["email"];
        $this->passwd = $row["passwd"];
        $this->token = $row["token"];
        $this->verified = $row["verified"];
    }

    public function resetToken()
    {
        $this->token = getGUID();
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setPassword($password)
    {
        $this->passwd = hash('whirlpool', $password);
    }

    public function getPassword()
    {
        return $this->passwd;
    }
}