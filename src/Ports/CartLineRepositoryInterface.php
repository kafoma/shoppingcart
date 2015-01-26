<?php

namespace malotor\shoppingcart\Ports;


interface CartLineRepositoryInterface {
  public function getAll();
  public function save($cartLine);
}