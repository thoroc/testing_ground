<?php

class SMTPClient
{
    function SMTPClient( $SmtpServer, $SmtpPort, $SmtpUser, $SmtpPass, $from, $to, $subject, $body )
    {
        $this->SmtpServer = $SmtpServer;
        $this->SmtpUser = base64_encode( $SmtpUser );
        $this->SmtpPass = base64_encode( $SmtpPass );
        $this->from = $from;
        $this->to = $to;
        $this->subject = $subject;
        $this->body = $body;

        if( $SmtpPort == "" )
        {
            $this->PortSMTP = 25;
        }
        else
        {
            $this->PortSMTP = $SmtpPort;
        }
    }

    function SendMail()
    {
        if( $smtpIn === fsockopen( $this->SmtpServer, $this->PortSMTP ) )
        {
            fputs( $smtpIn, "EHLO " . $HTTP_HOST . "\r\n" );
            $talk["hello"] = fgets( $smtpIn, 1024 );
            fputs( $smtpIn, "auth login\r\n" );
            $talk["res"] = fgets( $smtpIn, 1024 );
            fputs( $smtpIn, $this->SmtpUser . "\r\n" );
            $talk["user"] = fgets( $smtpIn, 1024 );
            fputs( $smtpIn, $this->SmtpPass . "\r\n" );
            $talk["pass"] = fgets( $smtpIn, 256 );
            fputs( $smtpIn, "MAIL FROM: <" . $this->from . ">\r\n" );
            $talk["From"] = fgets( $smtpIn, 1024 );
            fputs( $smtpIn, "RCPT TO: <" . $this->to . ">\r\n" );
            $talk["To"] = fgets( $smtpIn, 1024 );
            fputs( $smtpIn, "DATA\r\n" );
            $talk["data"] = fgets( $smtpIn, 1024 );
            fputs( $smtpIn, "To: <" . $this->to . ">\r\nFrom: <" . $this->from . ">\r\nSubject:" . $this->subject . "\r\n\r\n\r\n" . $this->body . "\r\n.\r\n" );
            $talk["send"] = fgets( $smtpIn, 256 );
//CLOSE CONNECTION AND EXIT ...
            fputs( $smtpIn, "QUIT\r\n" );
            fclose( $smtpIn );
//
        }
        return $talk;
    }
}