<?php
$titlePage = "Forgot Pass";
include('./views/header.php');
?>
<div class="panel panel-info">
    <div class="panel-heading">Did you forgot your pass?</div>
    <div class= "panel-body">
        <p>Please enter your email address below and we'll send you password reset instructions.</p>
        <form id="form" action="business/forgot.php" method="POST">
            <input type="email" name="email" placeholder="Email address" autofocus="autofocus" autocomplete="off"/>
            <input id="reset" type="submit" name="submit" value="Send me reset instructions">
        </form>
    </div>
</div>
<?php
include('./views/footer.php');
?>
