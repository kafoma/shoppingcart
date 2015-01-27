<?php

namespace malotor\shoppingcart\Application;

interface ItemRepositoryInterface {

  /**
   * @return malotor\shoppingcart\Item
   **/
  function get($nid);
} 