<?php


namespace Task\SimpleClasses;


class Logger
{
    const LOGS_FILE_NAME = 'logs.txt';

    public function put(string $message) {
        $time = '['.date("Y-m-d H:i:s").']  ';
        $fp = fopen(self::LOGS_FILE_NAME, 'a');
        $message = $time.$message."\r\n";
        $test = fwrite($fp, $message);
        $status = 'Error during adding message to logs.';
        if ($test) $status = 'Successfully added to logs.';
        fclose($fp);
        return $status;
    }
}