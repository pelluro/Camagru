<?php

class DBConnector
{
    private $dbConnection;

    function __construct($dbConnection)
    {
        $this->dbConnection=$dbConnection;
    }

    function execQuerySelect($req)
    {
        $query = $this->dbConnection->prepare($req);
        $query->execute();
        if ($query->rowCount() == 0)
            return null;
        $result = array();
        while ($data = $query->fetch()) {
            $newrow = array();
            foreach($data as $key => $value)
            {
                $newrow[$key] = $value;
            }
            $result[] = $newrow;
        }
        $query->closeCursor();
        return $result;
    }

    function execQuery($req)
    {
        $query = $this->dbConnection->prepare($req);
        return $query->execute();
    }

    function getUsers()
    {
        $data = $this->execQuerySelect($this->dbConnection,"SELECT * FROM users");
        $users = array();
        foreach ($data as $row)
        {
            $user = new User($row);
            $users[]=$user;
        }
        return $users;
    }

    function getUser($login,$password)
    {
        $password = hash('whirlpool', $password);
        $req = "SELECT * FROM users WHERE login='$login' AND passwd='$password'";
        $row = $this->execQuerySelect($req);
        if($row == null)
            return null;
        return new User($row);
    }

    function getUserByEmail($email)
    {
        $req = "SELECT * FROM users WHERE email='$email'";
        $row = $this->execQuerySelect($req);
        if($row == null)
            return null;
        return new User($row);
    }

    function getUserByEmailAndLoginAndToken($email,$login,$token)
    {
        $req = "SELECT * FROM users WHERE email='$email' and login='$login' and token='$token'";
        $row = $this->execQuerySelect($req);
        if($row == null)
            return null;
        return new User($row);
    }

    function getUserByEmailOrLogin($email,$login)
    {
        $req = "SELECT * FROM users WHERE email='$email' OR login='$login'";
        $data = $this->execQuerySelect($req);
        $users = array();
        foreach ($data as $row)
        {
            $user = new User($row);
            $users[]=$user;
        }
        return $users;
    }

    function saveUser($user)
    {
        if($user->id == 0)
        {
            $passwd = $user->getPassword();
            $token = $user->getToken();
            $req = "INSERT INTO users (email, login, passwd, token, verified) VALUES ('{$user->email}','{$user->login}','$passwd','$token',0)";
        }
        else
        {
            $passwd = $user->getPassword();
            $token = $user->getToken();
            $req = "UPDATE users SET email='{$user->email}', passwd='$passwd', token='$token', verified ={$user->verified}";
        }
        return $this->execQuery($req);
    }

}
