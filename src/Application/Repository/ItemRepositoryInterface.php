<?php

namespace malotor\shoppingcart\Application\Repository;

interface ItemRepositoryInterface {

  /**
   * @return malotor\shoppingcart\Item
   **/
  function get($nid);
} 