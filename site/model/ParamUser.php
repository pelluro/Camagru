<?php
class ParamUser
{
    public $user_id;
    public $param_name;
    public $param_value;

    public function __construct($row)
    {
        if($row != null)
        {
            $this->user_id=$row["user_id"];
            $this->param_name=$row['param_name'];
            $this->param_value=$row["param_value"];
        }
    }
}