<?php
if(isset($_SESSION["firstlogin"]))
{
    unset($_SESSION["firstlogin"]);
    ?>
    <div class="alert alert-success">
        Connection successful.
    </div>
    <?php
}

?>