<?php

class Entity
{
    protected $id;

    protected function __construct($row)
    {
        if($row != null)
            $this->id= $row["id"];
        else
            $this->id = 0;
    }

    public function getID()
    {
        return $this->id;
    }
}