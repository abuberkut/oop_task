<?php


namespace Task\Implementations;

use Task\AbstractClasses\ANotificationSender;

class SMSNotificationSender extends ANotificationSender
{
    /**
     * @param string $phone_number
     * @param string $message
     * @return string
     */
    public function send(string $phone_number, string $message) : string
    {
        if ( !$this->phoneNumberValidation($phone_number) )
            return 'The given phone number is not valid.';

        if ( !$this->messageValidation($message) )
            return 'The given massage is not valid.';

        return 'Notification with given message : [ '.$message.' ] sent to phone number : [ '.$phone_number.' ]';
    }
}
