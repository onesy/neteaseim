<?php

namespace NetEaseSdk\NEException;

class NEResponseFormatException extends NEException {
    public function __construct(string $message = "", int $code = 0, \Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}