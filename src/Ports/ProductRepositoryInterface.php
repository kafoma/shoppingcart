<?php

namespace malotor\shoppingcart\Ports;

interface ProductRepositoryInterface {

  /**
   * @return malotor\shoppingcart\Item
   **/
  function get($nid);
} 