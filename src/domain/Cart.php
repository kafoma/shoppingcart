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

    $itemLineObject = new CartLine($item,1);
    $exists = false;
    foreach($this->items as $itemInCart) {
      if ($itemInCart->getItem()->getId() == $item->getId()) {
        $exists = true;
      }
    }

    if (!$exists) $this->items[$item->getId()] = $itemLineObject;
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



}