<?php

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