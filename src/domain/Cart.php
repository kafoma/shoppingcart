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
    if (!$this->isItemInCart($item)) $this->items[$item->getId()] = CartLine::create($item,1);
    else {
      $itemLine = $this->items[$item->getId()];
      $itemLine->increaseQuantity(1);
    }
  }
  public function removeItem($itemId) {
    unset($this->items[$itemId]);
  }

  public function getItem($itemId) {
    if (isset($this->items[$itemId])) {
      $itemLine = $this->items[$itemId];
      return $itemLine->getItem();
    }
    throw new CartException("The item doesn't exists in cart");
  }

  public function getItemQuantity($itemId) {
    $itemLine = $this->items[$itemId];
    return $itemLine->getQuantity();
  }

  private function isItemInCart($item) {
    foreach($this->items as $itemInCart) {
      if ($itemInCart->getItem()->getId() == $item->getId()) {
        return true;
      }
    }
    return false;
  }

}