<?php
$titlePage = "Forgot Pass";
include('./header.php');
?>
<div class="alert alert-info">

    <h1>Did you forgot your pass?</h1>
    <div class= "alert alert-success">
        <p>Please Enter your email address below and we'll send you password reset instructions.</p>

        <form id="form" action="forgot.php" method="POST">
            <input type="email" name="email" value placeholder="Email address"/>
            <br />
            <input id="reset" type="submit" name="submit" value="Send me reset instructions">
        </form>
    </div>
</div>
<?php
include('./footer.php');
?>
