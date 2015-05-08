<?php

namespace malotor\shoppingcart\Application\Repository;

use malotor\shoppingcart\Domain\CartLineInterface;

interface CartLineRepositoryInterface {
  public function getAll();
  public function save(CartLineInterface $cartLine);
  public function removeAll();
}