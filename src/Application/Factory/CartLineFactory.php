<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 27/01/15
 * Time: 22:52
 */

namespace malotor\shoppingcart\Application\Factory;


use malotor\shoppingcart\Domain\CartLine;

class CartLineFactory {
  static public function create($product, $quantity) {
    return new CartLine($product, $quantity);
  }
} 