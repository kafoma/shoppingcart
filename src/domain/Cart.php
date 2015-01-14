<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 14/01/15
 * Time: 12:52
 */

namespace malotor\shoppingcart\domain;

class Cart {
  private $counter = 0;
  private $items = [];

  public function countItem() {
    return $this->counter;
  }
  public function addItem($item) {
    $this->items[$item->getId()] = $item;
    return $this->counter++;
  }
  public function removeItem($itemId) {
    return $this->counter--;
  }

  public function getItem($itemId) {
    return $this->items[$itemId];
  }
}