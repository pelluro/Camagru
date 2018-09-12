<?php

class Comment extends Entity
{
    public $content;
    public $user_id;
    public $pic_id;
    public $date;

    public function __construct($row)
    {
        parent::__construct($row);
        if($row != null)
        {
            $this->content=$row['content'];
            $this->pic_id=$row["pic_id"];
            $this->user_id=$row["user_id"];
            $this->date=$row["date"];
        }
    }
}