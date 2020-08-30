<?php


namespace Task\SimpleClasses;

use Task\AbstractClasses\ANotificationSender;
use Task\Implementations\EmailNotificationSender;
use Task\Implementations\SMSNotificationSender;

class NotifyClient
{
    const CLIENTS_FILE_NAME   = 'clients.txt';
    const PURCHASES_FILE_NAME = 'purchases.txt';

    public function process(int $client_id, int $purchase_id, string $notification_type, string $message) {
        $getter = new Getter;
        $client   = $getter->getById(self::CLIENTS_FILE_NAME, $client_id);
        $purchase = $getter->getById(self::PURCHASES_FILE_NAME, $purchase_id);

        if ( $client == [] )
            return $this->notFoundError('client','id', $client_id);

        if ( $purchase == [] )
            return $this->notFoundError('purchase', 'id', $purchase_id);

        $message .= ' Purchase info [ id: '.$purchase_id.', name: '.$purchase['name'].', price: '.$purchase['price'].' ] ';
        if ( $notification_type == ANotificationSender::EMAIL_TYPE ) {
            return (new EmailNotificationSender())->send($client['email'], $message);
        }
        elseif ( $notification_type == ANotificationSender::SMS_TYPE ) {
            return (new SMSNotificationSender())->send($client['phone_number'], $message);
        }

        return $this->notFoundError('notification sender', 'type', $notification_type);
    }

    private function notFoundError(string $name, string $field_name, $value) : string {
        return 'Not found '.$name.' with given '.$field_name.' = '.$value;
    }
}
