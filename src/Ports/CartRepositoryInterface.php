<?php

namespace malotor\shoppingcart\Ports;

interface CartRepositoryInterface {

  /**
   * @return malotor\ecommerce\Cart
   **/
  function get();

  function save($cart);

}