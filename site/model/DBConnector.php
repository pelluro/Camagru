<?php
require_once "Entity.php";
require_once "User.php";
require_once "Picture.php";
require_once "Like.php";
require_once "Comment.php";
require_once "ParamUser.php";

class DBConnector
{
    private $dbConnection;

    function __construct($dbConnection)
    {
        $this->dbConnection = $dbConnection;
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
            foreach ($data as $key => $value) {
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
        $data = $this->execQuerySelect("SELECT * FROM users");
        if ($data == null)
            return null;
        $users = array();
        foreach ($data as $row) {
            $user = new User($row);
            $users[] = $user;
        }
        return $users;
    }

    function getUserByID($user_id)
    {
        $req = "SELECT * FROM users WHERE ID=$user_id";
        $row = $this->execQuerySelect($req);
        if ($row == null)
            return null;
        return new User($row[0]);
    }

    function getUser($login, $password)
    {
        $password = hash('whirlpool', $password);
        $req = "SELECT * FROM users WHERE login='$login' AND passwd='$password'";
        $row = $this->execQuerySelect($req);
        if ($row == null)
            return null;
        return new User($row[0]);
    }

    function getUserByEmail($email)
    {
        $req = "SELECT * FROM users WHERE email='$email'";
        $row = $this->execQuerySelect($req);
        if ($row == null)
            return null;
        return new User($row[0]);
    }

    function getUserByEmailAndLoginAndToken($email, $login, $token)
    {
        $req = "SELECT * FROM users WHERE email='$email' and login='$login' and token='$token'";
        $row = $this->execQuerySelect($req);
        if ($row == null)
            return null;
        return new User($row[0]);
    }

    function getUserByEmailOrLogin($email, $login)
    {
        $req = "SELECT * FROM users WHERE email='$email' OR login='$login'";
        $data = $this->execQuerySelect($req);
        if ($data == null)
            return null;
        $users = array();
        foreach ($data as $row) {
            $user = new User($row);
            $users[] = $user;
        }
        return $users;
    }

    function getUsersFromCommentsOfPicture($pic_id)
    {
        $req = "SELECT users.* FROM users JOIN comments ON users.id = comments.user_id WHERE comments.pic_id=$pic_id";
        $data = $this->execQuerySelect($req);
        if ($data == null)
            return null;
        $users = array();
        foreach ($data as $row) {
            $user = new User($row);
            $users[$user->getID()] = $user;
        }
        return $users;
    }
    function getUsersFromLikesOfPicture($pic_id)
    {
        $req = "SELECT users.* FROM users JOIN likes on users.id = likes.user_id WHERE likes.pic_id=$pic_id";
        $data = $this->execQuerySelect($req);
        if ($data == null)
            return null;
        $users = array();
        foreach ($data as $row) {
            $user = new User($row);
            $users[$user->getID()] = $user;
        }
        return $users;
    }

    function saveUser($user)
    {
        $id = $user->getID();
        if ($id == 0) {
            $passwd = $user->getPassword();
            $token = $user->getToken();
            $req = "INSERT INTO users (email, login, passwd, token, verified) VALUES ('{$user->email}','{$user->login}','$passwd','$token',0)";
        } else {
            $passwd = $user->getPassword();
            $token = $user->getToken();
            $req = "UPDATE users SET login='{$user->login}',email='{$user->email}', passwd='$passwd', token='$token', verified ={$user->verified} WHERE id=$id";
        }
        return $this->execQuery($req);
    }

    function getCommentsByPicture($pic_id)
    {
        $req = "SELECT * FROM comments WHERE pic_id=$pic_id ORDER BY date";
        $data = $this->execQuerySelect($req);
        if ($data == null)
            return null;
        $comments = array();
        foreach ($data as $row) {
            $comment = new Comment($row);
            $comments[] = $comment;
        }
        return $comments;
    }

    function getCommentsById($comment_id)
    {
        $req = "SELECT * FROM comments WHERE id=$comment_id";
        $data = $this->execQuerySelect($req);
        if ($data == null)
            return null;
        return $data[0];
    }

    function saveComment($comment)
    {
        $id = $comment->getID();
        if ($id == 0) {
            $req = "INSERT INTO comments (content, user_id, pic_id, date) VALUES ('{$comment->content}',{$comment->user_id},{$comment->pic_id},'{$comment->date}')";
        } else {
            $req = "UPDATE comments SET content='{$comment->content}' WHERE id=$id ";
        }
        return $this->execQuery($req);
    }

    function deleteComment($comment_id)
    {
        $req = "DELETE FROM comments WHERE id = $comment_id";
        return $this->execQuery($req);
    }

    function saveLike($like)
    {
        $id = $like->getID();
        if ($id == 0) {
            $req = "INSERT INTO likes (user_id, pic_id) VALUES ('{$like->user_id}','{$like->pic_id}')";
            return $this->execQuery($req);
        }
        return null;
    }

    function deleteLike($pic_id,$user_id)
    {
        $req = "DELETE FROM likes WHERE pic_id = $pic_id AND user_id = $user_id";
        return $this->execQuery($req);
    }

    function hasLiked($pic_id,$user_id)
    {
        $req = "SELECT * FROM likes WHERE pic_id=$pic_id AND user_id = $user_id";
        $data = $this->execQuerySelect($req);
        if ($data == null)
            return FALSE;
        return TRUE;
    }

    function getLikesFromPictureId($pic_id)
    {
        $req = "SELECT * FROM likes WHERE pic_id=$pic_id";
        $data = $this->execQuerySelect($req);
        if ($data == null)
            return null;
        $likes = array();
        foreach ($data as $row) {
            $like = new Like($row);
            $likes[] = $like;
        }
        return $likes;
    }

    function getPictures()
    {
        $data = $this->execQuerySelect("SELECT * FROM pictures ORDER BY filedate");
        if ($data == null)
            return null;
        $pictures = array();
        foreach ($data as $row) {
            $picture = new Picture($row);
            $pictures[] = $picture;
        }
        return $pictures;
    }

    function getPicturesByUser($user_id)
    {
        $data = $this->execQuerySelect("SELECT * FROM pictures WHERE user_id=$user_id ORDER BY filedate");
        if ($data == null)
            return null;
        $pictures = array();
        foreach ($data as $row) {
            $picture = new Picture($row);
            $pictures[] = $picture;
        }
        return $pictures;
    }

    function getPicture($id)
    {
        $req = "SELECT * FROM pictures WHERE id=$id";
        $row = $this->execQuerySelect($req);
        if ($row == null)
            return null;
        return new Picture($row[0]);
    }

    function savePicture($picture)
    {
        $id = $picture->getID();
        if ($id == 0) {
            $req = "INSERT INTO pictures (filename, filedate, user_id) VALUES ('{$picture->filename}','{$picture->filedate}','{ $picture->user_id}')";
        } else {
            $req = "UPDATE pictures SET filename='{$picture->filename}', filedate='{$picture->filedate}', user_id='{$picture->user_id}' WHERE id=$id";
        }
        return $this->execQuery($req);
    }

    function getParamUser($user_id, $param_name)
    {
        $req = "SELECT * FROM paramusers WHERE user_id=$user_id AND param_name='$param_name'";
        $data = $this->execQuerySelect($req);
        if ($data == null)
            return null;
        else
            return new ParamUser($data[0]);
    }

    function saveParamUser($paramUser)
    {
        $paramUser2 = $this->getParamUser($paramUser->user_id, $paramUser->param_name);
        if ($paramUser2 == null) {
            $req = "INSERT INTO paramusers (user_id, param_name, param_value) VALUES ({$paramUser->user_id},'{$paramUser->param_name}','{$paramUser->param_value}')";
        } else {
            $req = "UPDATE paramusers SET param_value='{$paramUser->param_value}' WHERE user_id={$paramUser->user_id} AND param_name='{$paramUser->param_name}'";
        }
        return $this->execQuery($req);
    }
}