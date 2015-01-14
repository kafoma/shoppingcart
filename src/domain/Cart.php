<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 14/01/15
 * Time: 12:52
 */

namespace malotor\shoppingcart\domain;

class Cart {

  private $items = [];

  public function countItem() {
    return count($this->items);
  }
  public function addItem($item) {
    $this->items[$item->getId()] = $item;

  }
  public function removeItem($itemId) {
    unset($this->items[$itemId]);
  }

  public function getItem($itemId) {
    return $this->items[$itemId];
  }
}