<?php


namespace Task\Implementations;


use Task\AbstractClasses\ANotificationSender;

class EmailNotificationSender extends ANotificationSender
{
    /**
     * @param string $email
     * @param string $message
     * @return string
     */
    public function send(string $email, string $message) : string
    {
        if ( !$this->emailValidation($email) )
            return 'The given email is not valid.';

        if ( !$this->messageValidation($message) )
            return 'The given massage is not valid.';

        return 'Notification with given message : [ '.$message.' ] sent to email address : [ '.$email.' ]';
    }
}
