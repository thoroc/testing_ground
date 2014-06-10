<?php

include( 'SMTPconfig.php' );
include( 'SMTPClass.php' );

if( $_SERVER["REQUEST_METHOD"] == "POST" )
{
    $to = $_POST['to'];
    $from = $_POST['from'];
    $subject = $_POST['sub'];
    $body = $_POST['message'];
    $SMTPMail = new SMTPClient( $SmtpServer, $SmtpPort, $SmtpUser, $SmtpPass, $from, $to, $subject, $body );
    $SMTPChat = $SMTPMail->SendMail();
}

?>
<form method="post" action="">
    To:<input type="text" name="to" />
    From :<input type='text' name="from" />
    Subject :<input type='text' name="sub" />
    Message :<textarea name="message"></textarea>
    <input type="submit" value=" Send " />
</form>