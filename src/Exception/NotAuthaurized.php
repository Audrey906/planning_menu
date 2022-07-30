<?php

namespace App\Exception;

class NotAuthaurized extends \Exception
{
    public function __construct($message, $code = 401, \Throwable $previous = null) {

        parent::__construct($message, $code, $previous);
      }
}
