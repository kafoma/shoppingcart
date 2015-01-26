<?php

namespace malotor\shoppingcart\Ports;

interface CartRepositoryInterface {

  /**
   * @return malotor\shoppingcart\Cart
   **/
  function get();

  function save($cart);

}