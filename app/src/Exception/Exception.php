<?php
declare(strict_types=1);

namespace App\Exception;

use Cake\Core\Exception\Exception as CakeException;
use Cake\Log\Log;

class Exception extends CakeException {
  public function __construct($message = '', ?int $code = null, ?Throwable $previous = null) {
    parent::__construct($message, $code, $previous);

    Log::error(vsprintf('%s (%s)', [
      $this->getMessage(),
      json_encode([
        'file' => $this->getFile(),
        'line' => $this->getLine(),
      ]),
    ]));
  }
}

