<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 14/01/15
 * Time: 13:38
 */

namespace malotor\shoppingcart\Domain;

class CartException extends \Exception {
  public function __construct($message = null, $code = 0, Exception $previous = null) {
    parent::__construct($message, $code, $previous);
  }
}