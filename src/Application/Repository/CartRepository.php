<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 03/02/15
 * Time: 23:31
 */

namespace malotor\shoppingcart\Application;

use malotor\shoppingcart\Domain\Cart;

class CartRepository {
  public function __construct($cartLineRepository) {
    $this->cartLineRepository = $cartLineRepository;
  }
  public function get() {
    $carLines = $this->cartLineRepository->getAll();
    $cart = new Cart(new Collection($carLines));
    return $cart;
  }

  public function save($cart) {
    $this->cartLineRepository->removeAll();
    foreach($cart->getIterator() as $cartLine) {
      $this->cartLineRepository->save($cartLine);
    }
  }
} 