<?php

namespace malotor\shoppingcart\Domain;

class Cart implements \IteratorAggregate {

  private $cartLines = [];


  public function __construct($cartLines = []) {
    $this->cartLines = new Collection();
  }

  public function countItem() {
    return $this->cartLines->count();
  }

  public function addItem($item, $quantity = 1) {
    $cartLine = new CartLine($item, $quantity);

    if (!$this->cartLines->contains($item->getId()))
      $this->cartLines->add($item->getId(), $cartLine);
    else
      $this->increaseItemQuantity($item->getId(), $quantity);
  }

  public function increaseItemQuantity($itemId, $quantity) {
    $existentCartLine = $this->cartLines->get($itemId);
    $existentCartLine->increaseQuantity($quantity);
  }

  public function removeItem($itemId) {
    $this->cartLines->remove($itemId);
  }

  public function getItem($itemId) {
    if (!$this->cartLines->contains($itemId))
      throw new CartException("The item doesn't exists in cart");
    $cartLine = $this->cartLines->get($itemId);
    return $cartLine->getItem();
  }


  public function getItemQuantity($itemId) {
    $cartLine = $this->cartLines->get($itemId);
    return $cartLine->getQuantity();
  }


  public function getTotalAmount() {
    $result = 0;
    foreach($this->cartLines as $itemInCart) {
      $result += $itemInCart->getAmount();
    }
    return $result;
  }

  public function getIterator() {
    return $this->cartLines;
  }

}