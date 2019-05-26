<?php
session_start();
if(isset($_SESSION['answer']))
{
    $answer_of_check = $_SESSION['answer'];
    echo "<script>alert('$answer_of_check');</script>";
    unset($_SESSION['answer']);

}
?>
<form action="actions/Check.php" method="post" class="ui-form">
    <h3>Register on site</h3>
    <div class="form-row">
        <input type="email" id="email" name="Email" required autocomplete="off"><label for="email">Email</label>
    </div>
    <div class="form-row">
        <input type="text" id="name" name="Name" required autocomplete="off"><label for="name">Name</label>
    </div>
    <div class="form-row">
        <input type="password" id="password" name="Password" required autocomplete="off"><label for="password">Password</label>
    </div>
    <div class="form-row">
        <input type="password" id="password" name="conf_Password" required autocomplete="off"><label for="password">Confirm password</label>
    </div>
    <div class="g-recaptcha" data-sitekey="6LdgYp8UAAAAAL48txNTEXSjUeJrr2DDBFtCWrGv"></div>
    <p><input type="submit" name="Register" value="Register"></p>
