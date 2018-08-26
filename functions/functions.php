<?php
require_once("functions_login.php");

function is_in_array($value, $array)
{
	foreach($array as $row)
	{
		if($row == $value)
			return TRUE;
	}
	return FALSE;
}

function print_array($array)
{
    foreach ($array as $key => $value)
    {
        if(is_array($value))
        {
            echo "$key => {<br/>";
            print_array($value);
            echo "}";
        }
        else
            echo "$key => $value<br/>";
    }
}

function isLoggedIn()
{
    if(isset($_SESSION["currentUser"]))
        return TRUE;
    return FALSE;
}

function registerMessageHeader($message,$category)
{
	$_SESSION['uniquemessage'] = $message;
	$_SESSION['uniquemessagecat'] = $category;
}

function printMessageHeader()
{
	if(isset($_SESSION['uniquemessage']) && isset($_SESSION['uniquemessagecat']))
	{
		$message = $_SESSION['uniquemessage'];
		$category = $_SESSION['uniquemessagecat'];
		echo "<div class='alert alert-$category'>$message</div>";
		unset($_SESSION['uniquemessage']);
		unset($_SESSION['uniquemessagecat']);
	}
}

function getGUID(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = chr(123)// "{"
            .substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12)
            .chr(125);// "}"
        return $uuid;
    }
}

?>

