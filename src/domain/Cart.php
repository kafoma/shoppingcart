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

    $itemLine = [
      'item' => $item,
      'quantity' => 1
    ];

    $exists = false;
    foreach($this->items as $itemInCart) {
      if ($itemInCart['item']->getId() == $item->getId()) {
        $exists = true;
      }
    }

    if (!$exists) $this->items[$item->getId()] = $itemLine;
    else $this->items[$item->getId()]['quantity']++;
  }
  public function removeItem($itemId) {
    unset($this->items[$itemId]);
  }

  public function getItem($itemId) {
    if (isset($this->items[$itemId])) return $this->items[$itemId]['item'];
    throw new CartException("The item doesn't exists in cart");
  }

  public function getItemQuantity($itemId) {
    return $this->items[$itemId]['quantity'];
  }
}