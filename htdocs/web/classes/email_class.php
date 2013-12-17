<?php
class email_emn {
    //class vars Email
    public $email_to = '';
    public $headers_from = '';
    public $headers_from_name = '';
    public $headers_cc = '';
    public $subject = '';
    public $message = '';
    //class vars Other
    public $company = '';

    //Do the actual sending
    private function send($subject, $message, $additional_headers) {
        mail($this -> email_to, $subject, $message, $additional_headers);
    }

    function send_email_html() {
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: ' . $this -> headers_from . "\r\n";
        $headers .= 'Cc: ' . $this -> headers_cc . "\r\n";
        $this -> send($this->subject, $this->message, $headers);
    }

    //Class constructor
    function __construct() {
        //TODO
    }

    //class destructor
    function __destruct() {
        //TODO
    }

}
?>