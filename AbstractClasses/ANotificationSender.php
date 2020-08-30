<?php


namespace Task\AbstractClasses;

abstract class ANotificationSender
{
    const SMS_TYPE   = 'sms';
    const EMAIL_TYPE = 'email';

    /**
     * @param string $address
     * @param string $message
     * @return string
     */
    abstract public function send(string $address, string $message) : string;

    /**
     * @param string $email
     * @return bool
     */
    protected function emailValidation(string $email) : bool {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param string $phone_number
     * @return bool
     */
    protected function phoneNumberValidation(string $phone_number) : bool {
        return preg_match('/\+992[\d]{9}\b/', $phone_number);
    }

    /**
     * @param string $message
     * @return bool
     */
    protected function messageValidation(string $message) : bool {
        $message = trim($message);
        return mb_strlen($message) > 9 && mb_strlen($message) < 256;
    }
}
