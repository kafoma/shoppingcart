<?php

namespace malotor\shoppingcart\Application;

interface ProductRepositoryInterface {

  /**
   * @return malotor\shoppingcart\Item
   **/
  function get($nid);
} 