<?php

namespace Task\SimpleClasses;


use Task\AbstractClasses\ANotificationSender;

class Main
{
    public function run()
    {
        $logger = new Logger;
        $clients_file_name   = NotifyClient::CLIENTS_FILE_NAME;
        $purchases_file_name = NotifyClient::PURCHASES_FILE_NAME;
        begin:
        fwrite(STDOUT, PHP_EOL.'==================================='.PHP_EOL);
        fwrite(STDOUT, 'CHOSE OPERATION:'.PHP_EOL);
        fwrite(STDOUT, '(0) Show all clients and purchases '.PHP_EOL);
        fwrite(STDOUT, '(1) Create => [ (1) Client (2) Purchase ]'.PHP_EOL);
        fwrite(STDOUT, '(2) Update => [ (1) Client (2) Purchase ]'.PHP_EOL);
        fwrite(STDOUT, '(3) Delete => [ (1) Client (2) Purchase ]'.PHP_EOL);
        fwrite(STDOUT, '(4) Send notification => [ (1) SMS (2) Email ]'.PHP_EOL);
        fwrite(STDOUT, 'INPUT operation number '.PHP_EOL);
        $operation_number = trim(fgets(STDIN));
        $crud = new Crud;
        switch ($operation_number) {
            case 0:
                $getter = new Getter;
                fwrite(STDOUT, PHP_EOL.'==================================='.PHP_EOL);
                fwrite(STDOUT, 'Clients: '.PHP_EOL);
                $clients   = $getter->getAll($clients_file_name);
                $purchases = $getter->getAll($purchases_file_name);

                if ($clients == [])
                    fwrite(STDOUT, $clients_file_name.' file is empty.'.PHP_EOL);
                else
                    foreach ($clients as $index => $client)
                        fwrite(STDOUT, 'id : '.$index.', phone_number : '.$client['phone_number'].', email : '.$client['email'].PHP_EOL);

                fwrite(STDOUT, 'Purchases: '.PHP_EOL);
                if ($purchases == [])
                    fwrite(STDOUT, $purchases_file_name.' file is empty.'.PHP_EOL);
                else
                    foreach ($purchases as $index => $purchase)
                        fwrite(STDOUT, 'id : '.$index.', name : '.$purchase['name'].', price : '.$purchase['price'].PHP_EOL);
                goto begin;
            case 1:
                create_begin:
                fwrite(STDOUT, PHP_EOL.'==================================='.PHP_EOL);
                fwrite(STDOUT, '[1] CREATE :'.PHP_EOL);
                fwrite(STDOUT, '(1) Client '.PHP_EOL);
                fwrite(STDOUT, '(2) Purchase '.PHP_EOL);
                fwrite(STDOUT, 'INPUT create_type '.PHP_EOL);
                $create_type = trim(fgets(STDIN));
                switch ($create_type) {
                    case 1:
                        fwrite(STDOUT, '---------------------------'.PHP_EOL);
                        fwrite(STDOUT, 'Create client '.PHP_EOL);
                        fwrite(STDOUT, 'Phone number : ');
                        $client['phone_number'] = trim(fgets(STDIN));
                        fwrite(STDOUT, PHP_EOL.'Email : ');
                        $client['email'] = trim(fgets(STDIN));
                        $status = $crud->create($clients_file_name, $client);
                        $log_status = $logger->put($status);
                        fwrite(STDOUT, PHP_EOL.$status.'    '.$log_status.PHP_EOL);
                        goto begin;
                    case 2:
                        fwrite(STDOUT, '---------------------------'.PHP_EOL);
                        fwrite(STDOUT, 'Create purchase '.PHP_EOL);
                        fwrite(STDOUT, 'Name : ');
                        $purchase['name'] = trim(fgets(STDIN));
                        fwrite(STDOUT, PHP_EOL.'Price : ');
                        $purchase['price'] = trim(fgets(STDIN));
                        $status = $crud->create($purchases_file_name, $purchase);
                        $log_status = $logger->put($status);
                        fwrite(STDOUT, PHP_EOL.$status.'    '.$log_status.PHP_EOL);
                        goto begin;
                    default:
                        fwrite(STDOUT, 'Wrong create type!'.PHP_EOL);
                        goto create_begin;
                }
            case 2:
                update_begin:
                fwrite(STDOUT, PHP_EOL.'==================================='.PHP_EOL);
                fwrite(STDOUT, '[2] UPDATE :'.PHP_EOL);
                fwrite(STDOUT, '(1) Client '.PHP_EOL);
                fwrite(STDOUT, '(2) Purchase '.PHP_EOL);
                fwrite(STDOUT, 'INPUT update_type '.PHP_EOL);

                $update_type = trim(fgets(STDIN));
                switch ($update_type) {
                    case 1:
                        fwrite(STDOUT, '---------------------------'.PHP_EOL);
                        fwrite(STDOUT, 'Update client '.PHP_EOL);
                        fwrite(STDOUT, 'client_id : ');
                        $client_id = trim(fgets(STDIN));
                        fwrite(STDOUT, 'Phone number : ');
                        $client['phone_number'] = trim(fgets(STDIN));
                        fwrite(STDOUT, PHP_EOL.'Email : ');
                        $client['email'] = trim(fgets(STDIN));
                        $status = $crud->update($clients_file_name, $client_id,$client);
                        $log_status = $logger->put($status);
                        fwrite(STDOUT, PHP_EOL.$status.'    '.$log_status.PHP_EOL);
                        goto begin;
                    case 2:
                        fwrite(STDOUT, '---------------------------'.PHP_EOL);
                        fwrite(STDOUT, 'Update purchase '.PHP_EOL);
                        fwrite(STDOUT, 'purchase_id : ');
                        $purchase_id = trim(fgets(STDIN));
                        fwrite(STDOUT, 'Name : ');
                        $purchase['name'] = trim(fgets(STDIN));
                        fwrite(STDOUT, PHP_EOL.'Price : ');
                        $purchase['price'] = trim(fgets(STDIN));
                        $status = $crud->update($purchases_file_name, $purchase_id, $purchase);
                        $log_status = $logger->put($status);
                        fwrite(STDOUT, PHP_EOL.$status.'    '.$log_status.PHP_EOL);
                        goto begin;
                    default:
                        fwrite(STDOUT, 'Wrong update type!'.PHP_EOL);
                        goto update_begin;
                }
            case 3:
                delete_begin:
                fwrite(STDOUT, PHP_EOL.'==================================='.PHP_EOL);
                fwrite(STDOUT, '[3] DELETE :'.PHP_EOL);
                fwrite(STDOUT, '(1) Client '.PHP_EOL);
                fwrite(STDOUT, '(2) Purchase '.PHP_EOL);
                fwrite(STDOUT, 'INPUT delete_type '.PHP_EOL);

                $delete_type = trim(fgets(STDIN));
                switch ($delete_type) {
                    case 1:
                        fwrite(STDOUT, '---------------------------'.PHP_EOL);
                        fwrite(STDOUT, 'Delete client '.PHP_EOL);
                        fwrite(STDOUT, 'client_id : ');
                        $client_id = trim(fgets(STDIN));
                        $status = $crud->delete($clients_file_name, $client_id);
                        fwrite(STDOUT, PHP_EOL.$status.PHP_EOL);
                        goto begin;
                    case 2:
                        fwrite(STDOUT, '---------------------------'.PHP_EOL);
                        fwrite(STDOUT, 'Delete purchase '.PHP_EOL);
                        fwrite(STDOUT, 'purchase_id : ');
                        $purchase_id = trim(fgets(STDIN));
                        $status = $crud->delete($purchases_file_name, $purchase_id);
                        $log_status = $logger->put($status);
                        fwrite(STDOUT, PHP_EOL.$status.'    '.$log_status.PHP_EOL);
                        goto begin;
                    default:
                        fwrite(STDOUT, 'Wrong delete type!'.PHP_EOL);
                        goto delete_begin;
                }
            case 4:
                notification_begin:
                fwrite(STDOUT, PHP_EOL.'==================================='.PHP_EOL);
                fwrite(STDOUT, '[4] SEND NOTIFICATION:'.PHP_EOL);
                fwrite(STDOUT, '(1) SMS '.PHP_EOL);
                fwrite(STDOUT, '(2) EMAIL '.PHP_EOL);
                fwrite(STDOUT, 'INPUT notification_type '.PHP_EOL);
                $notification_type =  trim(fgets(STDIN));
                fwrite(STDOUT, 'client_id: '.PHP_EOL);
                $client_id =  trim(fgets(STDIN));
                fwrite(STDOUT, 'purchase_id: '.PHP_EOL);
                $purchase_id =  trim(fgets(STDIN));
                fwrite(STDOUT, 'Message: '.PHP_EOL);
                $message =  trim(fgets(STDIN));
                $notifier = new NotifyClient;
                if ( $notification_type == 1 ) {
                    fwrite(STDOUT, '------------------------------------'.PHP_EOL);
                    fwrite(STDOUT, 'SMS '.PHP_EOL);
                    $status = $notifier->process($client_id, $purchase_id, ANotificationSender::SMS_TYPE, $message);
                    $log_status = $logger->put($status);
                    fwrite(STDOUT, PHP_EOL.$status.'    '.$log_status.PHP_EOL);
                    goto begin;
                }
                elseif ( $notification_type == 2 ) {
                    fwrite(STDOUT, '------------------------------------'.PHP_EOL);
                    fwrite(STDOUT, 'EMAIL '.PHP_EOL);
                    $status = $notifier->process($client_id, $purchase_id, ANotificationSender::EMAIL_TYPE, $message);
                    $log_status = $logger->put($status);
                    fwrite(STDOUT, PHP_EOL.$status.'    '.$log_status.PHP_EOL);
                    goto begin;
                }
                else {
                    fwrite(STDOUT, 'Wrong notification type!'.PHP_EOL);
                    goto notification_begin;
                }
            default:
                fwrite(STDOUT, 'Wrong operation!'.PHP_EOL);
                goto begin;
        }
    }
}
