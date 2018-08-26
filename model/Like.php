<?php
/**
 * Created by PhpStorm.
 * User: pellu
 * Date: 8/26/2018
 * Time: 12:04 PM
 */

class Like extends Entity
{
    public $user_id;
    public $pic_id;

    public function __construct($row)
    {
        parent::__construct($row);
        if($row != null)
        {
            $this->pic_id=$row["pic_id"];
            $this->user_id=$row["user_id"];
        }
    }
}