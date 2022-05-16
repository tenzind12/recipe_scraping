<?php
include_once __DIR__.'/../helpers/Format.class.php';

class EmailForm {
    private $format;

    public function __construct() {
        $this->format = new Format();
    }

    // VALIDATE THE USER INPUTS
    public function validateInputs($name, $email, $message) {
        $name = $this->format->validation($name);
        $email = $this->format->validation($email);
        $message = $this->format->validation($message);

        if(empty($name) || empty($email) || empty($message)) {
            $errorMessage = 'Please all fields are compulsory';
            return $errorMessage;
        }

        // regex name only words
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            $errorMessage = "Name can only be letters and white space";
            return $errorMessage;
        }

        // email validation
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMessage = "Invalid email format";
            return $errorMessage;
        }
    }

    // SEND ME EMAIL
    public function sendEmail($name, $email, $message) {
        $to = 'tenzsona66@gmail.com';
        $subject = 'Mail from '.$name;
        $headers = 'From: '.$email;
        if(mail($to, $subject, $message, $headers)) {
            $sendMessage = 'Thank you for your messages.';
            return $sendMessage;
        } else {
            $sendMessage = 'Something went wrong. Please try again !';
            return $sendMessage;
        }
    }
}