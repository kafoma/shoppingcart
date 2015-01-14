<?php

namespace malotor\shoppingcart\domain;

class Cart {

  private $items = [];

  public function countItem() {
    return count($this->items);
  }

  public function addItem(Item $item) {
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

  private function isItemInCart(Item $item) {
    foreach($this->items as $itemInCart) {
      if ($itemInCart->getItem()->getId() == $item->getId()) {
        return true;
      }
    }
    return false;
  }

  public function getTotalAmount() {
    $result = 0;
    foreach($this->items as $itemInCart) {
      $result += $itemInCart->getAmount();
    }
    return $result;
  }

}