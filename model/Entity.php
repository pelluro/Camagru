<?php
/**
 * Created by PhpStorm.
 * User: pellu
 * Date: 8/26/2018
 * Time: 11:56 AM
 */

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