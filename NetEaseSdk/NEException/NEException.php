<?php
namespace NetEaseSdk\NEException;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
class NEException extends \RuntimeException
{
    private static $log_dir;
    
    public function __construct(string $message = "", int $code = 0, \Throwable $previous = null) {
        self::$log_dir = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "log" . DIRECTORY_SEPARATOR;
        $logger = new Logger($message, [new \Monolog\Handler\StreamHandler(self::$log_dir . "e.log", Logger::ERROR)]);
        $logger->error($message);
        parent::__construct($message, $code, $previous);
    }
}