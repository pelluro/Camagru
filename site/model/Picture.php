<?php
class Picture extends Entity
{
    public $filename;
    public $filedate;
    public $user_id;
    public $superposable;

    public function __construct($row)
    {
        parent::__construct($row);
        if($row !=null) {
            $this->filename = $row["filename"];
            $this->filedate = $row["filedate"];
            $this->user_id = $row["user_id"];
            $this->superposable = $row["superposable"];
        }
    }
}