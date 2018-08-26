<?php

class User extends Entity
{
    public $login;
    public $email;
    private $passwd;
    private $token;
    public $verified;

    public function __construct($row)
    {
        parent::__construct($row);
        if($row !=null) {
            $this->login = $row["login"];
            $this->email = $row["email"];
            $this->passwd = $row["passwd"];
            $this->token = $row["token"];
            $this->verified = $row["verified"];
        }
        else
        {
            $this->token = getGUID();
            $this->verified = 0;
        }
    }

    public function __toString(){
        return "{$this->login}";
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