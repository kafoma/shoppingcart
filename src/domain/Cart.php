<?php

namespace malotor\shoppingcart\domain;

class Cart {

  private $cartLines = [];

  public function countItem() {
    return count($this->cartLines);
  }

  public function addItem(Item $item) {
    if (!$this->isItemInCart($item)) $this->cartLines[$item->getId()] = CartLine::create($item,1);
    else {
      $itemLine = $this->cartLines[$item->getId()];
      $itemLine->increaseQuantity(1);
    }
  }

  public function removeItem($itemId) {
    unset($this->cartLines[$itemId]);
  }

  public function getItem($itemId) {
    if (isset($this->cartLines[$itemId])) {
      $cartLine = $this->cartLines[$itemId];
      return $cartLine->getItem();
    }
    throw new CartException("The item doesn't exists in cart");
  }

  public function getItemQuantity($itemId) {
    $itemLine = $this->cartLines[$itemId];
    return $itemLine->getQuantity();
  }

  private function isItemInCart(Item $item) {
    foreach($this->cartLines as $itemInCart) {
      if ($itemInCart->getItem()->getId() == $item->getId()) {
        return true;
      }
    }
    return false;
  }

  public function getTotalAmount() {
    $result = 0;
    foreach($this->cartLines as $itemInCart) {
      $result += $itemInCart->getAmount();
    }
    return $result;
  }

  public function getIterator() {
    return new \ArrayObject($this->cartLines);
  }

}