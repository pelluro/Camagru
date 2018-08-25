<?php

class User
{
    private $id;
    public $login;
    public $email;
    private $passwd;
    private $token;
    public $verified;

    public function __construct($row)
    {
        if($row !=null) {
            $this->id = $row["id"];
            $this->login = $row["login"];
            $this->email = $row["email"];
            $this->passwd = $row["passwd"];
            $this->token = $row["token"];
            $this->verified = $row["verified"];
        }
        else
        {
            $this->token = getGUID();
            $this->id = 0;
            $this->verified = 0;
        }
    }

    function __toString(){
        return "{$this->login}";
    }

    public function getID()
    {
        return $this->id;
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